<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Order;
use Illuminate\Http\Request;

class OrderselesaiController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $tahun = $request->tahun;
        $ekspedisi = $request->expedisi;
        $harga = $request->harga;

        $data = Order::query()
            ->when($ekspedisi, function ($query) use ($ekspedisi) {
                return $query->where('pengiriman', $ekspedisi);
            })
            ->with('product')->where('status', 'selesai')
            ->latest()->paginate(5);

        return view('v1.order-selesai.index', compact('data'));
    }

    public function detail($inv)
    {
        $data = Order::with('product')->where([
            'status' => 'selesai',
            'inv' => $inv
        ])->first();

        return view('v1.order-selesai.inv', compact('data'));
    }
}
