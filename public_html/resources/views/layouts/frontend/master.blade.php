<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- iconfont -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css"
        integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('assets/fe/css/style.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @yield('styles')
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
                            viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"
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

    @yield('content')

    <!-- footer -->
    <footer class="text-center text-lg-start text-muted">
        <div class="container">
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Mari Terhubung Dengan Sosial Media Kami</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section>
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-10 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <img src="assets/fe/img/logo.png" width="200" height="50" alt="">
                            <p class="mt-3">
                                SiPentas [Sistem Informasi Petani Tanaman Hias] merupakan E-commerce tanaman hias pada
                                dua paguyuban yang berlokasi di Magelang Jawa Tengah
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Usefull Link
                            </h6>
                            <p>
                                <a href="#" class="text-reset">Categories</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">Product</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">Coupon</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">Term Of Service</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-10 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Usefull Link
                            </h6>
                            <p>
                                <a href="#" class="text-reset">Categories</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">Product</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">Coupon</a>
                            </p>
                            <p>
                                <a href="#" class="text-reset">Term Of Service</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Content -->
                            <img src="https://pmb.ittelkom-pwt.ac.id/wp-content/uploads/2021/03/LOGO-ITTP.png"
                                width="200" height="50" alt="">
                            <p class="mt-3">
                                Merupakan perguruan tinggi swasta yang
                                fokus pada pengembangan ilmu pengetahuan berbasis teknologi informasi pada bidang
                                Healthcare, Agro-Industry, Tourism, dan Small Medium Enterprise (HATS).
                            </p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

        </div>
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            <div class="d-flex justify-content-between">
                Copyright ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                <div class="cr">
                    <img src="https://www.kemdikbud.go.id/main/files/large/83790f2b43f00be" alt=""
                        width="40"> <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Logo_ITTelkom_Purwokerto.png/800px-Logo_ITTelkom_Purwokerto.png"
                        alt="" height="30">
                </div>
            </div>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- js jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/fe/js/scripts.js') }}"></script>
    @if (session('success'))
        <script type="text/javascript">
            Swal.fire({
                title: 'Terima Kasih',
                text: '{{ session("success") }}',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tutup'
            });
        </script>
    @endif
    @if (session('galat'))
        <script type="text/javascript">
            Swal.fire({
                title: 'Mohon Maaf',
                text: '{{ session("galat") }}',
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tutup'
            });
        </script>
    @endif
    @yield('scripts')
    <script>
        AOS.init();
    </script>
</body>

</html>
