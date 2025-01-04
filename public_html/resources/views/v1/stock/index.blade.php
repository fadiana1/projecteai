@extends('layouts.backend.master')

@section('title')
    Rantai Pasok
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
                                    <a href="{{ route('admin.stock') }}"
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
                                <th>Pemasok</th>
                                <th>Total Item</th>
                                <th>Jumlah Seluruh</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td>{{ $item['item'] }} Items</td>
                                    <td>{{ $item['jumlah'] }}</td>

                                    <td class="d-flex">
                                        <a href="{{ route('admin.stock.show', $item['id']) }}"
                                            class="btn btn-outline-primary waves-effect shadow-sm me-3">
                                            <span class="ti ti-eye me-2"></span> Kelola Stok
                                        </a>

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
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
