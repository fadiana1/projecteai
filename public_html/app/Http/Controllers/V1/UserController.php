<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\V1\Tani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = User::with('suplier')->where('role', 'tani')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning waves-effect waves-light editProduct">Edit</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger waves-effect waves-light deleteProduct">Delete</a>';
                    return $btn;
                })
                ->addColumn('suplier', function ($row) {
                    return $row->suplier->title;
                })
                ->rawColumns(['action', 'suplier'])
                ->make(true);
        }

        $data = Tani::latest()->get();
        return view('v1.user.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::updateOrCreate(
            [
                'id' => $request->product_id
            ],
            [
                'username' => $request->username,
                'name' => $request->name,
                'password' => Hash::make('123456'),
                'role' => 'tani',
                'tani_id' => $request->tani,
            ]
        );

        return response()->json(['success' => 'Berhasil disimpan']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = User::find($id);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success' => 'Berhasil dihapus']);
    }
}
