@extends('layouts.frontend.master')
@section('title')
    {{ $data->title }}
@endsection

@section('content')
    <main>
        <section class="detail">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->slug }}</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3 shadow-nih rounded-15">
                            <img src="{{ asset('img/' . $data->image) }}" alt="" class="img-fluid rounded-15">
                        </div>
                    </div>
                    <div class="col-md-5 desc-mobile">
                        <h2>{{ $data->title }}</h2>
                        <h4>Rp {{ number_format($data->harga) }}</h4>
                        <hr>
                        <small class="text-success">Detail Product</small>
                        <div class="long-text">
                            <div class="text show-more-height">
                                {!! $data->body !!}
                            </div>
                            <div class="show-more btn btn-primary w-100">Baca Selengkapnya</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 rounded-15 shadow-nih">
                            <h3>Atur Jumlah dan Catatan</h3>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-primary kurang"><i class="fas fa-minus"></i></button>
                                <input type="number" min="1" readonly class="form-control text-center me-3 ms-3"
                                    value="1" name="jumlah" id="jumlah">
                                <button class="btn btn-primary tambah"><i class="fas fa-plus"></i></button>
                            </div>
                            <small class="catatan" id="buka-catatan"><i class="fas fa-pen me-1"></i>Tambah
                                Catatan</small>
                            <div class="tampil d-none">
                                <hr>
                                <!-- <input type="text" class="form-control mt-2" name="catatan" id="isi-catatan"> -->
                                <textarea name="catatan" id="isi-catatan" rows="2" class="form-control mt-2"></textarea>
                                <small class="catatan text-center mt-2" id="batal">Batalkan Catatan</small>
                            </div>
                            <hr class="mb-0">
                            <div class="d-flex justify-content-between">
                                <p class="text-muted">Sub Total</p>
                                <p class="fw-bold" id="sub-text">Rp {{ number_format($data->harga) }}</p>
                                <input type="number" id="subtotal" value="{{ $data->harga }}" hidden>
                            </div>
                            <form action="{{ route('addtocart') }}" method="GET">
                                <input type="text" hidden name="no" value="{{ $data->id }}">
                                <button type="submit" class="btn btn-outline-primary btn-beli mt-2 w-100">Beli
                                    Sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
