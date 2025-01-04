@extends('layouts.backend.master')

@section('title')
    Orderan Selesai
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header">
                <div class="head-label text-center">
                    <h5 class="card-title mb-4">@yield('title')</h5>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="GET">
                    <div class="row">
                        <div class="mb-3 col-md-2">
                            <label for="defaultSelect" class="form-label">Filter Bulan Ke</label>
                            <input type="text" class="form-control from" placeholder="Cari disini" autocomplete="off"
                                name="from">
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="defaultSelect" class="form-label">Sampai Bulan Ke</label>
                            <input type="text" class="form-control to" placeholder="Cari disini" autocomplete="off"
                                name="to">
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="defaultSelect" class="form-label">Filter Tahun</label>
                            <input type="text" class="form-control tahun" placeholder="Cari disini" autocomplete="off"
                                name="tahun">
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="defaultSelect" class="form-label">Filter Pengiriman</label>
                            <select id="defaultSelect" class="form-select" name="pengiriman">
                                <option value="">-- Pilih --</option>
                                <option value="cod">Cash On Delivery</option>
                                <option value="expedisi">Ekspedisi</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="defaultSelect" class="form-label">Filter Harga</label>
                            <select id="defaultSelect" class="form-select" name="harga">
                                <option value="">-- Pilih --</option>
                                <option value="asc">Terendah - Tertinggi ( ASC )</option>
                                <option value="desc">Tertinggi - Terendahr ( DESC )</option>
                            </select>
                        </div>

                        <div class="mb-0 col-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-label-primary shadow-sm waves-effect w-100">
                                        Export Ke Excel
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.order-selesai') }}"
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
                                        <span class="badge bg-success bg-glow">SELESAI</span>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.order-selesai.detail', $item->inv) }}"
                                            class="btn btn-success waves-effect shadow-sm me-3">
                                            <span class="ti ti-file me-2"></span> Cetak Inv
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
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(".from").datepicker({
            format: "mm",
            startView: "months",
            minViewMode: "months",
            orientation: "auto bottom"
        });
        $(".tahun").datepicker({
            format: "yyyy",
            startView: "years",
            minViewMode: "years",
            orientation: "auto bottom"
        });

        $(".to").datepicker({
            format: "mm",
            startView: "months",
            minViewMode: "months",
            orientation: "auto bottom"
        });
    </script>
@endsection
