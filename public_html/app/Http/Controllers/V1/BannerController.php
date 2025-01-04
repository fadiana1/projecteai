<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::latest()->get();
        return view('v1.banner.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg'
        ], [
            'image.required' => 'Pilih Gambar',
            'image.image' => 'Wajib berupa gambar',
            'image.mimes' => 'Gambar wajib JPG atau PNG'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        Banner::create([
            'image' => $imageName
        ]);

        $request->image->move(public_path('img/banner/'), $imageName);

        return redirect()->route('admin.banner.index')->with('success', 'Banner Berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = Banner::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Gambar Tidak Tersedia');
        }

        unlink(public_path('img/banner/' . $data->image));
        $data->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Banner Berhasil dihapus');
    }
}
