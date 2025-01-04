@extends('layouts.frontend.master')

@section('title')
    Lacak Pembayaran
@endsection

@section('content')
    <main>
        <section class="auth" style="margin-top: 20px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card p-3 rounded-15 shadow-nih">
                            <div class="text-center">
                                <h2>Lacak Order</h2>
                                <p class="desc">Lacak Orderan</p>
                            </div>
                            <hr>
                            @if (empty($data))
                                <form class="mt-3" method="get" action="">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Invoice</label>
                                        <input type="text"
                                            class="form-control @error('inv') is-invalid @enderror text-center"
                                            name="inv" id="inv" placeholder="#inv1231">
                                        @error('inv')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-form mb-3">Submit</button>
                                    </div>
                                </form>
                            @else
                                <img src="https://barcodeapi.org/api/128/{{ $data->inv }}"
                                    style=" width: 100%; height: 140px; margin-top: 20px; margin-bottom: 20px;">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td>Invoice Number</td>
                                            <td>:</td>
                                            <td>{{ $data->inv }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah</td>
                                            <td>:</td>
                                            <td>{{ $data->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Product</td>
                                            <td>:</td>
                                            <td>{{ $data->product->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($data->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Transfer Ke</td>
                                            <td>:</td>
                                            <td>{{ $data->pembayaran }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pembayaran</td>
                                            <td>:</td>
                                            <td>
                                                @php
                                                    $payment = $data->payment;
                                                    switch ($payment) {
                                                        case 'pending':
                                                            # code...
                                                            echo '<span class="badge bg-warning bg-glow">PENDING</span>';
                                                            break;
                                                        case 'aprove':
                                                            # code...
                                                            echo '<span class="badge bg-success bg-glow">Di Setujui</span>';
                                                            break;
                                                        default:
                                                            # code...
                                                            echo '<span class="badge bg-info bg-glow">Tidak Sesuai</span>';
                                                            break;
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status Order</td>
                                            <td>:</td>
                                            <td>
                                                @php
                                                    $status = $data->status;
                                                    switch ($status) {
                                                        case 'pending':
                                                            # code...
                                                            echo '<span class="badge bg-danger bg-glow">PENDING</span>';
                                                            break;
                                                        case 'proses':
                                                            # code...
                                                            echo '<span class="badge bg-warning bg-glow">SEDANG PROSES</span>';
                                                            break;
                                                        case 'mengirim':
                                                            # code...
                                                            echo '<span class="badge bg-info bg-glow">Sedang Mengirim</span>';
                                                            break;
                                                        default:
                                                            # code...
                                                            echo '<span class="badge bg-success bg-glow">SELESAI</span>';
                                                            break;
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="{{ route('lacak') }}" style="padding-top:12px; "
                                    class="btn btn-primary btn-form mb-3">Cek Lagi</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
