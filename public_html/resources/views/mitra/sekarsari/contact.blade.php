@extends('layouts.frontend.master')
@section('title')
    Contact US
@endsection

@section('content')
    <main>
        <section class="detail">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="product">
                            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                                </ol>
                            </nav>

                            <div class="card p-3" data-aos="flip-up">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2708044739697!2d109.24651767532734!3d-7.43525777325474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ea49d9f9885%3A0x62be0b6159700ec9!2sInstitut%20Teknologi%20Telkom%20Purwokerto!5e0!3m2!1sid!2sid!4v1693669720217!5m2!1sid!2sid"
                                    class="w-10 mb-5" height="300" style="border-radius:15px;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                <h3 class="text-center">Contact Us</h3>
                                <p class="text-center mb-4">Hubungi kami segera jika ada kritik dan saran, kami mempersilahkan untuk bekerja sama,
                                    silahkan
                                    hubungi dibawah ini</p>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card bg-white">
                                            <i class="fas text-center fa-map-marker-alt fa-2x mb-3"></i>
                                            <p class="text-center">Jln Griya Karang Pucung</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-white">
                                            <i class="fas text-center fa-phone fa-2x mb-3"></i>
                                            <p class="text-center">Jln Griya Karang Pucung</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-white">
                                            <i class="fas text-center fa-envelope fa-2x mb-3"></i>
                                            <p class="text-center">Jln Griya Karang Pucung</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
