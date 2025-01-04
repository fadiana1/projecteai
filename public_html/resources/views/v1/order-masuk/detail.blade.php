@extends('layouts.backend.master')
@section('title')
    Orders #{{ $data->inv }}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    #{{ $data->inv }}
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
                            default:
                                # code...
                                echo '<span class="badge bg-info bg-glow">SEDANG PENGIRIMAN</span>';
                                break;
                        }
                    @endphp
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Detail Order</h5>
                <form action="{{ route('admin.order-masuk.update', $data->inv) }}" method="POST">
                    @csrf
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td>
                                    {{ $data->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>:</td>
                                <td>
                                    {{ $data->phone }}
                                </td>
                            </tr>
                            <tr>
                                <td>Item Pesanan</td>
                                <td>:</td>
                                <td>{{ $data->product->title }}</td>
                            </tr>
                            <tr>
                                <td>Pembayaran</td>
                                <td>:</td>
                                <td>
                                    {{ $data->pembayaran }}
                                </td>
                            </tr>
                            <tr>
                                <td>Pengiriman</td>
                                <td>:</td>
                                <td>
                                    {{ $data->pengiriman }} Melalui {{ $data->expedisi ?? null }}
                                </td>
                            </tr>
                            <tr>
                                <td>Jumlah Pesanan</td>
                                <td>:</td>
                                <td>{{ $data->jumlah }}</td>
                            </tr>
                            <tr>
                                <td>Alamat Lengkap</td>
                                <td>:</td>
                                <td>
                                    {{ $data->alamat }}
                                </td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>:</td>
                                <td class="d-flex">
                                    <select class="form-select @error('pembayaran') is-invalid @enderror w-50"
                                        name="pembayaran" id="pembayaran" aria-label="Default select example">
                                        <option {{ $data->payment == 'pending' ? 'selected' : null }} value="pending">
                                            Pending</option>
                                        <option {{ $data->payment == 'aprove' ? 'selected' : null }} value="aprove">Aprove
                                        </option>
                                        <option {{ $data->payment == 'gagal' ? 'selected' : null }} value="gagal">Gagal
                                        </option>
                                    </select>
                                    @error('pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <button type="button"
                                        class="btn btn-primary waves-effect waves-light w-50 ms-2 {{ $data->bukti == null ? 'kosong' : 'muncul' }}"
                                        style="border: none;">Lihat
                                        Bukti Pembayaran</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Status Orders</td>
                                <td>:</td>
                                <td>
                                    <select class="form-select @error('status') is-invalid @enderror w-50" name="status"
                                        id="status" aria-label="Default select example">
                                        <option {{ $data->status == 'pending' ? 'selected' : null }} value="pending">
                                            Pending</option>
                                        <option {{ $data->status == 'proses' ? 'selected' : null }} value="proses">Proses
                                        </option>
                                        <option {{ $data->status == 'mengirim' ? 'selected' : null }} value="mengirim">
                                            Mengirim
                                        </option>
                                        <option {{ $data->status == 'selesai' ? 'selected' : null }} value="selesai">
                                            Selesai
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary waves-effect waves-light mt-4 w-100">Update Progress
                        Order</button>
                </form>
            </div>
            <div class="card-footer text-muted">
                <div class="d-flex justify-content-between">
                    Order Date
                    <p>{{ $data->created_at }}</p>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($data->bukti))
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Bukti Pembayaran #{{ $data->inv }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('bukti/' . $data->bukti->image) }}" class="img-fluid" alt="">
                        <table class="table table-striped mt-3">
                            <tbody>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->bukti->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bank Pengirim</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->bukti->bank }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pengiriman</td>
                                    <td>:</td>
                                    <td>
                                        {{ $data->bukti->tanggal }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".kosong").click(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Mohon Maaf',
                    text: 'Pembeli Belum Melakukan Upload Bukti Pembayaran',
                });
            });
        });

        $(document).ready(function() {
            $(".muncul").click(function() {
                $('#modalCenter').modal('show');
            });
        });
    </script>
@endsection
