<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Product;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function magersari()
    {
        $data = Product::with('tani')->whereHas('tani', function ($query) {
            return $query->where('title', 'magersari');
        })->paginate(6);

        return view('mitra.magersari.index', compact('data'));
    }

    public function magersariDetail($slug)
    {
        $data = Product::with('tani')->whereHas('tani', function ($query) {
            return $query->where('title', 'magersari');
        })->where('slug', $slug)->first();

        if (empty($data)) {
            # code...
            abort(404);
        }

        return view('mitra.magersari.detail', compact('data'));
    }

    public function sekarsari()
    {
        $data = Product::with('tani')->whereHas('tani', function ($query) {
            return $query->where('title', 'sekarsari');
        })->paginate(8);

        return view('mitra.sekarsari.index', compact('data'));
    }

    public function contactMagersari()
    {
        return view('mitra.magersari.contact');
    }

    public function contactSekarsari()
    {
        return view('mitra.sekarsari.contact');
    }

    public function sekarsariDetail($slug)
    {
        $data = Product::with('tani')->whereHas('tani', function ($query) {
            return $query->where('title', 'sekarsari');
        })->where('slug', $slug)->first();

        if (empty($data)) {
            # code...
            abort(404);
        }

        return view('home.product.detail', compact('data'));
    }
}
