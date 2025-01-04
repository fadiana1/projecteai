@extends('layouts.frontend.master')

@section('title')
    Cek Ongkir Pengiriman
@endsection

@section('content')
    <main>
        <section class="auth" style="margin-top: 20px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card p-3 rounded-15 shadow-nih">
                            <div class="text-center">
                                <h2>Cek Ongkir</h2>
                                <p class="desc">Cek Harga Pengiriman Kelokasi Anda</p>
                            </div>
                            <hr>
                            <form class="mt-3" method="post" action="{{ route('ongkir.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Kota / Kecamatan</label>
                                            <select
                                                class="form-select select2 mb-3 provinsi @error('provinsi') is-invalid @enderror"
                                                id="provinsi" aria-label="Default select example" name="provinsi">
                                            </select>
                                            @error('provinsi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-form mb-3">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if (!empty($data))
                            <h2 class="mt-4 text-center mb-2">Hasil Ekspedisi</h2>
                            <p class="desc text-center">Berikut Ekspedisi Yang Kami Sediakan</p>
                            <div class="row mt-4">
                                @foreach ($data as $key => $item)
                                    <div class="col-md-12">
                                        <div class="card p-3 rounded-15 shadow-nih {{ $key > 0 ? 'mt-3' : null }}">
                                            <div class="d-flex">
                                                <div class="icons" style="display:grid;">
                                                    <img src="https://www.hitoko.co.id/blog/wp-content/uploads/2022/12/kenali-joni-jne-untuk-bisnis-1.jpg"
                                                        width="120" height="100" alt="">
                                                    <small
                                                        style="margin-left: 32px;margin-top: 5px;">{{ $item['estimasi'] }}</small>
                                                </div>
                                                <div class="ringkasan">
                                                    <h2 style="font-size: 20px; margin-bottom: 10px;">{{ $item['title'] }}
                                                    </h2>
                                                    <p class="desc mb-0"><i class="fas fa-truck-loading"></i> Dari Magelang
                                                    </p>
                                                    <p class="desc mb-0"><i class="fas fa-truck"></i> Ke
                                                        {{ $item['tujuan'] }}</p>
                                                    <p class="desc mb-0"><i class="fas fa-money-bill-wave-alt"></i> Harga :
                                                        {{ $item['harga'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('styles')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('scripts')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            const url = "{{ route('ongkir') }}";

            $('.provinsi').select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: url, // Ganti dengan URL API Anda
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(response) {
                        // console.log(response);
                        return {
                            results: $.map(response, function(item) {
                                // console.log(item);
                                // return item
                                return {
                                    text: item.text,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3
            });
        });
    </script>
@endsection
