<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Order;
use Illuminate\Http\Request;

class OrdermasukController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $pengiriman = $request->pengiriman;
        $pembayaran = $request->pembayaran;
        $q = $request->q;

        if (auth()->user()->role == 'tani') {
            # code...
            $user = auth()->user()->suplier->id;
            $data = Order::query()
                ->when($status, function ($q) use ($status) {
                    return $q->where('status', $status);
                })
                ->when($pengiriman, function ($q) use ($pengiriman) {
                    return $q->where('pengiriman', $pengiriman);
                })
                ->when($pembayaran, function ($q) use ($pembayaran) {
                    return $q->where('payment', $pembayaran);
                })
                ->when($q, function ($query) use ($q) {
                    return $query->where('inv', 'like', '%' . $q . '%');
                })->with('product')
                ->whereHas('product', function ($query) use ($user) {
                    $query->where('tani_id', $user);
                })
                ->whereNotIn('status', ['selesai'])->paginate(5);
        } else {
            # code...
            $data = Order::query()
                ->when($status, function ($q) use ($status) {
                    return $q->where('status', $status);
                })
                ->when($pengiriman, function ($q) use ($pengiriman) {
                    return $q->where('pengiriman', $pengiriman);
                })
                ->when($pembayaran, function ($q) use ($pembayaran) {
                    return $q->where('payment', $pembayaran);
                })
                ->when($q, function ($query) use ($q) {
                    return $query->where('inv', 'like', '%' . $q . '%');
                })->with('product')->whereNotIn('status', ['selesai'])->paginate(5);
        }


        // dd($data);
        return view('v1.order-masuk.index', compact('data'));
    }

    public function detail($inv)
    {
        $data = Order::with('bukti', 'product')->where('inv', $inv)->first();
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Orderan Tidak Ada');
        }

        return view('v1.order-masuk.detail', compact('data'));
    }

    public function update(Request $request, $inv)
    {
        $data = Order::where('inv', $inv)->first();
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Orderan Tidak Ada');
        }

        $data->update([
            'status' => $request->status,
            'payment' => $request->pembayaran
        ]);

        return redirect()->route('admin.order-masuk.detail', $data->inv)->with('success', 'Order Berhasil diupdate');
    }

    public function destroy($inv)
    {
        $data = Order::where('inv', $inv)->first();
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Orderan Tidak Ada');
        }

        if (!empty($data->image)) {
            # code...
            unlink(public_path('bukti/' . $data->image));
        }

        $data->delete();
        return redirect()->route('admin.order-masuk')->with('success', 'Order Berhasil dihapus');
    }
}
