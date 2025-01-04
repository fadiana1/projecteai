<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Product;
use App\Models\V1\Tani;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public static function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage;
        $itemstoshow = array_slice($items, $offset, $perPage);


        return new LengthAwarePaginator(
            $itemstoshow,
            $total,
            $perPage,
            $page,
            ['path' => route('admin.stock')]
        );
    }

    public function index()
    {
        $gudang = Tani::with('item')->get();
        $data = [];
        foreach ($gudang as $key => $value) {
            # code...
            $data[] = [
                'id' => $value->id,
                'title' => $value->title,
                'item' => count($value->item),
                'jumlah' => Product::where('tani_id', $value->id)->sum('stock')
            ];
        }
        $data = $this->paginate($data);
        // dd($data);
        return view('v1.stock.index', compact('data'));
    }

    public function show($id, Request $request)
    {
        $data = Tani::find($id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Product Tidak Ada');
        }

        $gudang = Tani::all();

        if ($request->ajax()) {
            # code...
            $item = Product::with('tani')->where('tani_id', $data->id)->get();
            return DataTables::of($item)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button"  data-id="' . $row->id . '" class="btn btn-outline-primary waves-effect shadow-sm me-3 editProduct">
                                            <span class="ti ti-box me-2"></span> Pindah Gudang / Suplier
                                        </button>';
                    return $btn;
                })
                ->addColumn('gudang', function ($row) {
                    return $row->tani->title;
                })
                ->rawColumns(['action', 'gudang'])
                ->make(true);
        }
        return view('v1.stock.detail', compact('data', 'gudang'));
    }

    public function store($id, Request $request)
    {
        if (empty($request->product_id)) {
            # code...
            return back()->with('galat', 'Error Saat Pemindahaan Data');
        }

        $data = Product::find($request->product_id);
        if (empty($data)) {
            # code...
            return back()->with('galat', 'Error Saat Pemindahaan Data');
        }

        $data->update([
            'tani_id' => $request->tani,
            'stock' => $request->stock ?? $data->stock
        ]);

        return back()->with('success', 'Berhasil Ubah Rantai Pasok');
    }
}
