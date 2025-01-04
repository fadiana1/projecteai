@extends('layouts.frontend.master')
@section('title')
    Selamat Datang di xx - Market Tani Digital
@endsection

@section('content')
    <main>
        <section class="layanan">
            <div class="container">
                <div class="text-center">
                    <div class="title">
                        <h2>Product Terlaris</h2>
                        <p>Rekomendasi Product Terkini</p>
                    </div>
                </div>
                <div class="row">
                    @forelse ($data as $item)
                        <div class="col-md-3 col-11" data-aos="zoom-in">
                            <div class="card p-3 shadow-nih">
                                <img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->title }}">
                                <h3>Kangkung Laut</h3>
                                <div class="d-flex justify-content-between">
                                    <div class="detail">
                                        <p class="mb-0">Rp {{ number_format($item->harga) }}</p>
                                        <small class="fw-bold text-success">Tersisa {{ $item->stock }}</small>
                                    </div>
                                    <a href="{{ route('produk.detail', $item->slug) }}"
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
            </div>
        </section>
    </main>
@endsection
