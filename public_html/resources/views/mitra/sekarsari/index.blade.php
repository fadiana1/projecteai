@extends('layouts.frontend.master')
@section('title')
    Selamat Datang di Sekarsari
@endsection

@section('content')
    <main>
        <section class="layanan">
            <div class="container">
                <div class="text-center">
                    <div class="title">
                        <h2>Product Sekarsari</h2>
                        <p>Rekomendasi Product Terkini</p>
                    </div>
                </div>
                <div class="row mb-5">
                    @forelse ($data as $item)
                        <div class="col-md-3 col-11" data-aos="zoom-in">
                            <div class="card p-3 shadow-nih">
                                <img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->title }}">
                                <h3>{{ $item->title }}</h3>
                                <div class="d-flex justify-content-between">
                                    <div class="detail">
                                        <p class="mb-0">Rp {{ number_format($item->harga) }}</p>
                                        <small class="fw-bold text-success">Tersisa {{ $item->stock }}</small>
                                    </div>
                                    <a href="{{ route('sekarsari.detail', $item->slug) }}"
                                        class="btn btn-layanan btn-outline-primary rounded-15">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="25" height="25"
                                            viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="10" cy="20.5" r="1"></circle>
                                            <circle cx="18" cy="20.5" r="1"></circle>
                                            <path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="d-flex justify-content-center">
                    {!! $data->links() !!}
                </div>
            </div>
        </section>

        <section class="mitra">
            <div class="container">
                <div class="partner shadow-nih">
                    <h2 class="text-center">Ekspedisi Pengiriman</h2>
                    <p class="text-center">List Pengiriman Melalui Ekspedisi</p>
                    <div class="d-flex justify-content-center mitra-img">
                        <img data-aos="zoom-out-down"
                            src="https://upload.wikimedia.org/wikipedia/commons/9/92/New_Logo_JNE.png" alt="">
                        <img data-aos="zoom-out-down"
                            src="https://www.nuwori.com/wp-content/uploads/2017/10/logo-sicepat.png" alt="">
                        <img data-aos="zoom-out-down"
                            src="https://www.nuwori.com/wp-content/uploads/2019/02/logo-jnt-png-merah.png" alt="">
                        <img data-aos="zoom-out-down"
                            src="https://blog.ninjaxpress.co/wp-content/uploads/2022/05/full-colour-ninjaxpress-logo-on-white_S.png"
                            alt="">
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
