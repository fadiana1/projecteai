<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Ekspedisi;
use App\Models\V1\Order;
use App\Models\V1\Product;
use Illuminate\Http\Request as HttpRequest;
use Request;
use App\Models\DokuModels;
use App\Http\Controllers\V1\DokuController;

class CartController extends Controller
{

    public function keranjang(HttpRequest $request)
    {
        $data = Product::find($request->no);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Product Tidak Tersedia');
        }

        if (intval($data->stock) <= 0) {
            # code...
            return back()->with('galat', 'Stock Sedang Habis');
        }

        $secure = [
            'IP' => $request->ip(),
            'agent' => $request->header('user-agent')
        ];

        $ekspedisi = Ekspedisi::all();
        // Jika permintaan ingin JSON
        if ($request->wantsJson()) {
            return response()->json([
                'data' => $data,
                'secure' => $secure,
                'ekspedisi' => $ekspedisi
            ]);
        }



        return view('home.cart.index', compact('data', 'secure', 'ekspedisi'));
    }

    public function bayar(HttpRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'alamat' => 'required',
            'pengiriman' => 'required|in:cod,ekspedisi',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $data = Product::find($request->product_id);

        // Data untuk order
        $kodeUnik = rand(1000, 9999);
        $orderData = [
            'product_id' => $request->product_id,
            'inv' => 'inv-' . $kodeUnik,
            'name' => $request->name,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'jumlah' => $request->jumlah,
            'harga' => $data->harga * $request->jumlah,
        ];

        // Detail produk
        $orderDetails = [
            [
                "name" => $data->title,
                "price" => $data->harga,
                "quantity" => $request->jumlah
            ]
        ];

        // Proses checkout ke DOKU
        $doku = new DokuModels();
        $response = $doku->checkoutWithCurl($orderData, $orderDetails);

        // dd($response);

        // Periksa apakah respons berisi URL pembayaran
        if ($response['status_code'] == 200) {
            $paymentUrl = $response['response']['response']['payment']['url'];

            // Simpan order ke database
            Order::create(array_merge($orderData, [
                'pembayaran' => 'DOKU',
                'payment' => 'approve',
                'status' => 'approve',
                'expedisi' => $request->ekspedisi ?? null
            ]));

            // Kurangi stok produk
            $data->update([
                'stock' => $data->stock - $request->jumlah
            ]);

            // Jika permintaan ingin JSON
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Pesanan berhasil dibuat, silakan selesaikan pembayaran.',
                    'payment_url' => $paymentUrl
                ]);
            }

            // Redirect ke URL pembayaran DOKU
            return redirect($paymentUrl)->with('success', 'Silakan selesaikan pembayaran Anda.');
        }
    }
}
