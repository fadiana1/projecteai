<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Konfirmasi;
use App\Models\V1\Order;
use Illuminate\Http\Request;

class KonfirmasiController extends Controller
{
    public function index()
    {
        return view('home.konfirmasi.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'inv' => 'required',
            'name' => 'required',
            'bank' => 'required',
            'tanggal' => 'required',
            'image' => 'required|image|mimes:png,jpg'
        ], [
            'inv' => 'Masukan Nomor Inv pembelian anda',
            'name' => 'Masukan Nama Lengkap',
            'bank' => 'Masukan Nama Bank',
            'tanggal' => 'Isi Tanggal Transfer',
            'image.required' => 'Upload Bukti',
            'image.image' => 'Upload Bukti Berupa Gambar',
            'image.mimes' => 'Upload Bukti gambar format jpg',
        ]);

        $data = Order::where('inv', $request->inv)->first();
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Inv Tidak Ada');
        }

        $check = Konfirmasi::where('order_id', $data->id)->first();
        if ($check) {
            # code...
            return back()->with('galat', 'Anda Sudah Mengirimkan Sebelumnya');
        }

        $imageName = time() . '.' . $request->image->extension();
        Konfirmasi::create([
            'order_id' => $data->id,
            'name' => $request->name,
            'tanggal' => $request->tanggal,
            'bank' => $request->bank,
            'image' => $imageName
        ]);

        $request->image->move(public_path('bukti/'), $imageName);
        return back()->with('success', 'Konfirmasi Pembayaran sukses, silahkan lacak secara berkala');
    }
}
