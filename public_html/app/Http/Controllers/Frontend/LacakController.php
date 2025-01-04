<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Order;
use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        $data = null;
        if ($request->inv) {
            # code...
            
            $data = Order::with('product')->where('inv', $request->inv)->first();
            if (empty($data)) {
                # code...
                return back()->with('galat', 'Pembelian Tidak Ada');
            }
        }
    
        return view('home.lacak.index', compact('data'));
    }
}
