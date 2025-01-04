@extends('layouts.backend.master')

@section('title')
    Kelola Product
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0">@yield('title')</h5>
                </div>
                <a class="btn btn-primary" href="{{ route('admin.product.create') }}"><i class="ti ti-plus me-sm-1"></i>
                    Tambah Baru</a>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="defaultSelect" class="form-label">Filter Mitra</label>
                            <select id="defaultSelect" class="form-select" name="mitra">
                                <option value="">-- Pilih --</option>
                                @foreach ($mitra as $tani)
                                    <option value="{{ $tani->id }}">{{ $tani->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="defaultSelect" class="form-label">Cari Product</label>
                            <input type="text" class="form-control" placeholder="Cari disini" autocomplete="off"
                                name="q">
                        </div>

                        <div class="mb-0 col-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-label-primary shadow-sm waves-effect w-100">
                                        Mulai Filter Tabel
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.product.index') }}"
                                        class="btn btn-label-danger shadow-sm waves-effect w-100">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Tani</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->tani->title }}</td>
                                    <td>{{ $item->stock }} Stock</td>
                                    <td>
                                        <span
                                            class="badge {{ $item->status == 'publish' ? 'bg-label-success' : 'bg-label-danger' }} me-1">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.product.edit', $item->id) }}"
                                            class="btn btn-icon btn-label-warning waves-effect shadow-sm me-3">
                                            <span class="ti ti-edit"></span>
                                        </a>
                                        <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-label-danger waves-effect shadow-sm">
                                                <span class="ti ti-trash"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data Not Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4 mx-auto pagination justify-content-center">
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group mb-3">
                            <label for="name" class="control-label mb-3">Title</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
