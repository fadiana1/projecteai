@extends('layouts.frontend.mitra.theme')
@section('title')
    Selamat Datang di Magersari
@endsection

@section('content')
    <div class="welcome">
        <img src="{{ asset('assets/fe/img/logo.png') }}" alt="">
        <h1 data-aos="fade-up">Paguyuban Magersari</h1>
        <p data-aos="fade-down">
            Hasil product tanaman hias oleh para masyarakat paguyuran magersari, Kab Magelang, Jawa Tengah
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="product">
                <div class="row justify-content-center">
                    @forelse ($data as $item)
                        <div class="col-md-6">
                            <a href="{{ route('magersari.detail', $item->slug) }}">
                                <div class="card" data-aos="flip-up">
                                    <img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->title }}">
                                    <h3>{{ $item->title }}</h3>
                                    <div class="detail">
                                        <div class="d-flex justify-content-between">
                                            <p>Rp. {{ number_format($item->harga) }}</p>
                                            <p>{{ $item->stock }} Stock</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-lg">

                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center">
                    {!! $data->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
