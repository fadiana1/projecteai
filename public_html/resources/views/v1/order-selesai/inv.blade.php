@extends('layouts.backend.master')

@section('title')
    Print Invoice : {{ $data->inv }}
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview justify-content-center">
            <!-- Invoice -->
            <div class="col-xl-8 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card" id="DivIdToPrint">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
                            <div class="mb-xl-0 mb-4">
                                <img src="{{ asset('assets/fe/img/logo.png') }}" width="150" class="mb-3" alt="">
                                <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                                <p class="mb-1">San Diego County, CA 91905, USA</p>
                                <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                            <div>
                                <h4>Invoice #{{ $data->inv }}</h4>
                                <div class="mb-2">
                                    <span class="me-1">Order Date</span>
                                    <span class="fw-medium">{{ $data->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="me-1">Order Time</span>
                                    <span class="fw-medium">{{ $data->created_at->format('H:s') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                <h6 class="pb-2">Customer Detail</h6>
                                <p class="mb-1">{{ $data->name }}</p>
                                <p class="mb-1">{{ $data->phone }}</p>
                                <p class="mb-1">{{ $data->email }}</p>
                                <p class="mb-1">{{ $data->alamat }}</p>
                                <p class="mb-1">Indonesia</p>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                                <h6 class="pb-2">Order Detail</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-3">Pengiriman :</td>
                                            <td>$12,110.55</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">Pembayaran :</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">Expedisi :</td>
                                            <td>United States</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-top m-0">
                            <thead>
                                <tr>
                                    <th colspan="3">Product</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap" colspan="3">{{ $data->product->title }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>Rp {{ number_format($data->harga) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="align-top px-4 py-5">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $data->inv }}"
                                            alt="">
                                    </td>
                                    <td class="text-end px-4 py-5">
                                        <p class="mb-2">Subtotal:</p>
                                        <p class="mb-0">Total:</p>
                                    </td>
                                    <td class="px-4 py-5">
                                        <p class="fw-medium mb-2">$154.25</p>
                                        <p class="fw-medium mb-0">$204.25</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span>Teruntuk konsumen yang kami hormati. Terima banyak atas pembelian yang telah kamu
                                    lakukan. Sungguh 1 pesanan Anda, berarti banyak bagi perkembangan bisnis kami. Selamat
                                    menikmati.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->
        </div>
    </div>
@endsection

@section('sripts')
    <script>
        $('.buttonId').on('click', function() {
            displayTheData();
        })

        function displayTheData() {
            $(document).ready(function() {
                $("#DivIdToPrint").html($("#printThisDivIdOnButtonClick").html());
            });
        }
    </script>
@endsection
