<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function index()
    {
        $data = Galery::latest()->get();
        return view('v1.galery.index', compact('data'));
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

        Galery::create([
            'image' => $imageName
        ]);

        $request->image->move(public_path('img/galery/'), $imageName);

        return redirect()->route('admin.galery.index')->with('success', 'Galery Berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = Galery::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Gambar Tidak Tersedia');
        }

        unlink(public_path('img/galery/' . $data->image));
        $data->delete();

        return redirect()->route('admin.galery.index')->with('success', 'Galery Berhasil dihapus');
    }
}
