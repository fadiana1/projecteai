@extends('layouts.frontend.mitra.theme')
@section('title')
    Product {{ $data->title }} - Magersari
@endsection

@section('content')
    <div class="welcome">
        <img src="{{ asset('assets/fe/img/logo.png') }}" alt="">
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="product">
                <div class="d-flex mb-3">
                    <a href="/" class="btn btn-primary btn-back"><i class="fas fa-arrow-left"></i></a>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb"
                            style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);">
                            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('magersari') }}">Product</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card" data-aos="flip-up">
                            <img src="{{ asset('img/' . $data->image) }}">
                            <h3>{{ $data->title }}</h3>
                            <div class="detail">
                                <div class="d-flex justify-content-between">
                                    <p>Rp. {{ number_format($data->harga) }}</p>
                                    <p>{{ $data->stock }} Stock</p>
                                </div>
                            </div>
                            <hr>
                            <p class="text-start">
                                {!! $data->body !!}
                            </p>

                            <hr>
                            <h4 class="fw-bold mb-0 mt-0">Ulasan Video</h4>
                            <hr>
                            <div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{{ $data->video }}"></div>

                            <a href="{{ route('addtocart', 'no=' . $data->id) }}"
                                class="btn btn-primary w-100 btn-beli mt-4">Beli
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.0.7/plyr.css" />
@endsection
@section('scripts')
    <script src="https://cdn.plyr.io/3.0.7/plyr.js"></script>
    <script>
        const player = new Plyr('#player', {
            controls: ['play-large', 'play', 'progress', 'current-time'],
            autoplay: true,
            volume: true,
        });
    </script>
@endsection
