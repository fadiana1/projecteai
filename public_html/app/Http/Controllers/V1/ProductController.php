<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\HistoryStock;
use App\Models\V1\Product;
use App\Models\V1\Tani;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function storeProductByTani($request)
    {
        $request->validate([
            'title' => 'required',
            'harga' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:png,jpg',
        ]);

        # membuat variabel baru untuk penamaan file image kita menggunakan time() agar unique tidak sama dengan gambar lain
        $imageName = time() . '.' . $request->image->extension();

        # gunakan query untuk update data baru kedalam database dengan memanggil model product

        # awal query
        $product = Product::create([
            'title' => $request->title,
            'tani_id' => auth()->user()->suplier->id,
            'harga' => $request->harga,
            'status' => $request->status,
            'stock' => $request->stock,
            'slug' => str_replace(' ', '-', $request->title),
            'image' => $imageName,
            'body' => $request->body,
        ]);

        HistoryStock::create([
            'tani_id' => auth()->user()->suplier->id,
            'product_id' => $product->id,
            'stock_awal' => $request->stock,
            'stock_akhir' => $request->stock,
        ]);
        # akhir query

        # menentukan folder mana yang akan menyimpan gambar hasil upload kita
        $request->image->move(public_path('img/'), $imageName);
        # kita akan menyimpan gambar pada folder public/storage/img/namafile.png

        // balikan ke halaman list product
        return redirect()->route('admin.product.index')->with('success', 'Product Berhasil di tambahkan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mitra = $request->mitra;
        $q = $request->q;

        if (auth()->user()->role == 'tani') {
            # code...
            $data = Product::query()
                ->when($q, function ($query) use ($q) {
                    return $query->where('inv', 'like', '%' . $q . '%');
                })
                ->when($mitra, function ($query) use ($mitra) {
                    return $query->where('tani_id', $mitra);
                })
                ->with('tani')->where('tani_id', auth()->user()->tani_id)->paginate(5);
        } else {
            $data = Product::query()
                ->when($q, function ($query) use ($q) {
                    return $query->where('title', 'like', '%' . $q . '%');
                })
                ->when($mitra, function ($query) use ($mitra) {
                    return $query->where('tani_id', $mitra);
                })->with('tani')->paginate(5);
        }

        $mitra = Tani::all();
        return view('v1.product.index', compact('data', 'mitra'));
    }

    private function linkToEmbed($request)
    {
        // URL YouTube yang ingin Anda ambil parameter "v"-nya
        $youtube_url = $request->video;

        // Mengurai URL untuk mendapatkan query string
        $query_string = parse_url($youtube_url, PHP_URL_QUERY);

        // Mengurai query string untuk mendapatkan nilai dari parameter "v"
        parse_str($query_string, $query_params);

        // // Mendapatkan nilai parameter "v" dari hasil penguraian
        if (isset($query_params['v'])) {
            $video_id = $query_params['v'];
            return $video_id;
        } else {
            return null;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Tani::all();
        return view('v1.product.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role == 'tani') {
            # code...
            $this->storeProductByTani($request);
        } else {
            $request->validate([
                'title' => 'required',
                'tani' => 'required',
                'harga' => 'required|numeric',
                'status' => 'required',
                'body' => 'required',
                'image' => 'required|image|mimes:png,jpg',
            ]);

            # membuat variabel baru untuk penamaan file image kita menggunakan time() agar unique tidak sama dengan gambar lain
            $imageName = time() . '.' . $request->image->extension();

            # gunakan query untuk update data baru kedalam database dengan memanggil model product

            # awal query
            $product = Product::create([
                'title' => $request->title,
                'tani_id' => $request->tani,
                'harga' => $request->harga,
                'status' => $request->status,
                'stock' => $request->stock,
                'video' => $this->linkToEmbed($request),
                'image' => $imageName,
                'body' => $request->body,
            ]);

            HistoryStock::create([
                'tani_id' => $request->tani,
                'product_id' => $product->id,
                'stock_awal' => $request->stock,
                'stock_akhir' => $request->stock,
            ]);
            # akhir query

            # menentukan folder mana yang akan menyimpan gambar hasil upload kita
            $request->image->move(public_path('img/'), $imageName);
            # kita akan menyimpan gambar pada folder public/storage/img/namafile.png

            // balikan ke halaman list product
            return redirect()->route('admin.product.index')->with('success', 'Product Berhasil di tambahkan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);
        $tani = Tani::all();
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Product Tidak Ada');
        }

        return view('v1.product.edit', compact('data', 'tani'));
    }

    private function updateProductByTani($request, $id)
    {
        # membuat variabel untuk cek apakah id tersebut ada atau tidak menggunakan find / where by id 
        $data = Product::find($id);

        # membuat if satu kondisi dimana jika kosong data tersebut akan di kembalikan
        if (empty($data)) {
            # kembalikan ke halaman list product dengan notifikasi with
            return redirect()->route('admin.product.index')->with('galat', 'product not found');
        }

        # membuat validasi kembali dari request yang didapatkan dari form update
        $request->validate([
            'title' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:png,jpg',
        ]);

        # membuat if 2 kondisi dimana jika ada request pergantian thumbnail atau gambar maka
        if ($request->image) {
            # jika da request image / thumbnail maka system akan mengganti gambar tersebut

            # gunakan fitur unlink untuk menghapus gambar pada folder penyimpanan kita sesuai dengan nama file pada database
            unlink(public_path('img/' . $data->image));

            # jika sudah berhasil menghapus maka kita buat persiapan untuk gambar baru

            # membuat variabel baru untuk penamaan file image kita menggunakan time() agar unique tidak sama dengan gambar lain
            $imageName = time() . '.' . $request->image->extension();

            # gunakan query untuk update data baru kedalam database dengan memanggil model product

            # awal query
            $data->update([
                'title' => $request->title,
                'harga' => $request->harga,
                'status' => $request->status,
                'video' => $this->linkToEmbed($request),
                'image' => $imageName,
                'body' => $request->body,
            ]);
            # akhir query

            # menentukan folder mana yang akan menyimpan gambar hasil upload kita
            $request->image->move(public_path('fe/img/'), $imageName);
            # kita akan menyimpan gambar pada folder public/fe/img/namafile.png

            return redirect()->route('admin.product.index')->with(
                'success',
                'product Berhasil di Update'
            );
        } else {
            # jika tidak ada request image maka memanggil query update dengan model

            # awal query
            $data->update([
                'title' => $request->title,
                'harga' => $request->harga,
                'status' => $request->status,
                'video' => $this->linkToEmbed($request),
                'body' => $request->body,
            ]);
            # akhir query

            return redirect()->route('admin.product.index')->with('success', 'product Berhasil di Update');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role == 'tani') {
            # code...
            $this->updateProductByTani($request, $id);
            // dd('tani');
        } else {
            # membuat variabel untuk cek apakah id tersebut ada atau tidak menggunakan find / where by id 
            // dd('admin');
            $data = Product::find($id);

            # membuat if satu kondisi dimana jika kosong data tersebut akan di kembalikan
            if (empty($data)) {
                # kembalikan ke halaman list product dengan notifikasi with
                return redirect()->route('admin.product.index')->with('galat', 'product not found');
            }

            # membuat validasi kembali dari request yang didapatkan dari form update
            $request->validate([
                'title' => 'required',
                'tani' => 'required',
                'harga' => 'required|numeric',
                'status' => 'required',
                'body' => 'required',
                'image' => 'image|mimes:png,jpg',
            ]);

            # membuat if 2 kondisi dimana jika ada request pergantian thumbnail atau gambar maka
            if ($request->image) {
                # jika da request image / thumbnail maka system akan mengganti gambar tersebut

                # gunakan fitur unlink untuk menghapus gambar pada folder penyimpanan kita sesuai dengan nama file pada database
                unlink(public_path('img/' . $data->image));

                # jika sudah berhasil menghapus maka kita buat persiapan untuk gambar baru

                # membuat variabel baru untuk penamaan file image kita menggunakan time() agar unique tidak sama dengan gambar lain
                $imageName = time() . '.' . $request->image->extension();

                # gunakan query untuk update data baru kedalam database dengan memanggil model product

                # awal query
                $data->update([
                    'title' => $request->title,
                    'tani_id' => $request->tani,
                    'harga' => $request->harga,
                    'status' => $request->status,
                    'video' => $this->linkToEmbed($request),
                    'image' => $imageName,
                    'body' => $request->body,
                ]);
                # akhir query

                # menentukan folder mana yang akan menyimpan gambar hasil upload kita
                $request->image->move(public_path('fe/img/'), $imageName);
                # kita akan menyimpan gambar pada folder public/fe/img/namafile.png

                return redirect()->route('admin.product.index')->with(
                    'success',
                    'product Berhasil di Update'
                );
            } else {
                # jika tidak ada request image maka memanggil query update dengan model

                # awal query
                $data->update([
                    'title' => $request->title,
                    'tani_id' => $request->tani,
                    'harga' => $request->harga,
                    'status' => $request->status,
                    'video' => $this->linkToEmbed($request),
                    'body' => $request->body,
                ]);
                # akhir query

                return redirect()->route('admin.product.index')->with('success', 'product Berhasil di Update');
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'product Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        # membuat variabel untuk cek apakah id tersebut ada atau tidak menggunakan find / where by id 
        $data = Product::find($id);

        # membuat if satu kondisi dimana jika kosong data tersebut akan di kembalikan
        if (empty($data)) {
            # kembalikan ke halaman list product dengan notifikasi with
            return redirect()->route('admin.product.index')->with('galat', 'product not found');
        }

        # gunakan fitur unlink untuk menghapus gambar pada folder penyimpanan kita sesuai dengan nama file pada database
        unlink(public_path('img/' . $data->image));
        $data->delete();

        return redirect()->route('admin.product.index')->with('success', 'product berhasil dihapus');
    }
}
