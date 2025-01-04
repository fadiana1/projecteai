@extends('layouts.backend.master')

@section('title')
    Orderan Masuk
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header">
                <div class="head-label text-center">
                    <h5 class="card-title mb-4">@yield('title')</h5>
                </div>
                <form action="" method="GET">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Order</label>
                            <select id="defaultSelect" class="form-select" name="status">
                                <option value="">-- Pilih --</option>
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="mengirim">Mengirim</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Pembayaran</label>
                            <select id="defaultSelect" class="form-select" name="pembayaran">
                                <option value="">-- Pilih --</option>
                                <option value="pending">Pending</option>
                                <option value="aprove">Aprove</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Pengiriman</label>
                            <select id="defaultSelect" class="form-select" name="pengiriman">
                                <option value="">-- Pilih --</option>
                                <option value="cod">COD</option>
                                <option value="expedisi">Ekspedisi</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Pengiriman</label>
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
                                    <a href="{{ route('admin.order-masuk') }}"
                                        class="btn btn-label-danger shadow-sm waves-effect w-100">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>INV</th>
                                <th>Product</th>
                                <th>Jumlah</th>
                                <th>Pengiriman</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->inv }}</td>
                                    <td>{{ $item->product->title }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ $item->pengiriman }}</td>
                                    <td>
                                        @php
                                            $status = $item->status;
                                            switch ($status) {
                                                case 'pending':
                                                    # code...
                                                    echo '<span class="badge bg-danger bg-glow">PENDING</span>';
                                                    break;
                                                case 'proses':
                                                    # code...
                                                    echo '<span class="badge bg-warning bg-glow">SEDANG PROSES</span>';
                                                    break;
                                                default:
                                                    # code...
                                                    echo '<span class="badge bg-info bg-glow">SEDANG PENGIRIMAN</span>';
                                                    break;
                                            }
                                        @endphp
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.order-masuk.detail', $item->inv) }}"
                                            class="btn btn-icon btn-info waves-effect shadow-sm me-3">
                                            <span class="ti ti-eye"></span>
                                        </a>
                                        <form action="{{ route('admin.order-masuk.destroy', $item->inv) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger waves-effect shadow-sm">
                                                <span class="ti ti-trash"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data Not Found</td>
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
