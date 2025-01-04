<?php

namespace App\Http\Controllers;

use App\Models\V1\Banner;
use App\Models\V1\Galery;
use App\Models\V1\Product;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $magersari = Product::with('tani')->whereHas('tani', function ($query) {
            return $query->where('title', 'magersari');
        })->count();
        $sekarsari = Product::with('tani')->whereHas('tani', function ($query) {
            return $query->where('title', 'sekarsari');
        })->count();

        $galery = Galery::latest()->get();

        $banner = Banner::latest()->get();

        return view('welcome', compact('magersari', 'sekarsari', 'galery', 'banner'));
    }

    public function katalok()
    {
        $data = Product::where('status', 'publish')->get();
        return view('home.product.index', compact('data'));
    }

    public function detail($slug)
    {
        $data = Product::where('slug', $slug)->first();
        if (empty($data)) {
            # code...
            return redirect()->route('index')->with('galat', 'Product Tidak ditemukan');
        }

        return view('home.product.detail', compact('data'));
    }
}
