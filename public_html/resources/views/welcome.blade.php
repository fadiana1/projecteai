<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di website SIPentas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- iconfont -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
        integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/fe/css/mitra.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.0.7/plyr.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/fe/img/logo.png') }}" alt="Bootstrap" width="200" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Mitra
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('sekarsari') }}">Sekarsari</a></li>
                            <li><a class="dropdown-item" href="{{ route('magersari') }}">Magersari</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('ongkir') }}">Cek Ongkir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('konfirmasi') }}">Konfirmasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('lacak') }}">Lacak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('history') }}">History</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Contact Us
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('sekarsari.contact') }}">Contact Sekarsari</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('magersari.contact') }}">Contact Magersari</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="action">
                    <a href="{{ route('masuk') }}" class="btn btn-primary btn-auth">
                        <svg xmlns="http://www.w3.org/2000/svg" class="me-1" width="25" height="25"
                            viewBox="0 0 24 24" fill="none" stroke="#283c63" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3" />
                            <circle cx="12" cy="10" r="3" />
                            <circle cx="12" cy="12" r="10" />
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @if (!empty($banner[0]))
        <header>
            <div class="container">
                <div class="card p-3 h-auto" data-aos="flip-down">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($banner as $key => $img)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('img/banner/' . $img->image) }}" style="border-radius: 15px; "
                                        class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
    @endif

    <main class="awal">
        <div class="container">
            <div class="title mt-1">
                <h1 data-aos="fade-up">Selamat Datang</h1>
                <p data-aos="fade-down">
                    SiPentas [Sistem Informasi Petani Tanaman Hias] merupakan E-commerce tanaman hias pada dua paguyuban
                    yang berlokasi di Magelang Jawa Tengah
                </p>
            </div>

            <div class="pilihan">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card" data-aos="flip-up">
                            <h2>{{ $magersari }} Product</h2>
                            <h3>Magersari</h3>

                            <a href="{{ route('magersari') }}" class="btn btn-primary">Lihat Toko</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" data-aos="flip-down">
                            <h2>{{ $sekarsari }} Product</h2>
                            <h3>Sekarsari</h3>

                            <a href="{{ route('sekarsari') }}" class="btn btn-primary">Lihat Toko</a>
                        </div>
                    </div>
                </div>

                <div class="title mt-5">
                    <h1 data-aos="fade-up" class="mb-1">Our Galery</h1>
                    <p data-aos="fade-down">
                        Berikut galery tanaman hias kami
                    </p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row mt-3 galery">
                            @forelse ($galery as $item)
                                <div class="col-md-6">
                                    <div class="card p-3 mb-4">
                                        <img src="{{ asset('img/galery/' . $item->image) }}" alt="">
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning" role="alert">
                                        Gambar Masih Belum Tersedia
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container">
        <footer class="text-center text-lg-start text-muted w-100 h-100">
            <!-- Section: Links  -->
            <section>
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">
                        <div class="col-md-3 col-lg-4 col-xl-3">
                            <h6 class="text-uppercase fw-bold mb-4">SiPentas</h6>
                            <p>
                                SiPentas adalah platform informasi mengenai tanaman hias dan toko-toko petani tanaman
                                hias yang tersebar di Magelang.
                            </p>
                        </div>

                        <div class="col-md-2 col-lg-2 col-xl-2">
                            <h6 class="text-uppercase fw-bold mb-4">About</h6>
                            <p>
                                <a href="/" class="text-reset">Home</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">About Us</a>
                            </p>
                        </div>

                        <div class="col-md-3 col-lg-2 col-xl-2">
                            <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>
                            <p>
                                <a href="{{ route('sekarsari.contact') }}" class="text-reset">Sekarsari</a>
                            </p>
                            <p>
                                <a href="{{ route('magersari.contact') }}" class="text-reset">Magersari</a>
                            </p>
                        </div>

                        <div class="col-md-4 col-lg-3 col-xl-3">
                            <h6 class="text-uppercase fw-bold mb-4">Follow Us</h6>
                            <p>
                                <a href="#" class="text-reset"><i class="fab fa-facebook"></i> Facebook</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset"><i class="fab fa-instagram"></i> Instagram</a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-IQsoBXf4iHvnRe3uGEKnttv55gIp4iyjRPbgZGjl7ksmf5z04ee2qosw2v82crth"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
