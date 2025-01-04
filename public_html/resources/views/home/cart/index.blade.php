@extends('layouts.frontend.master')

@section('title')
Keranjang Belanja Anda
@endsection

@section('content')
<main>
    <section class="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card rounded-15 p-3">
                        <img src="{{ asset('img/' . $data->image) }}" class="img-fluid rounded-15" alt="">
                        <h2>{{ $data->title }}</h2>

                         <!-- <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-primary kurang"><i class="fas fa-minus"></i></button>
                            <input type="number" min="1" readonly class="form-control text-center me-3 ms-3"
                                value="1" name="jumlah" id="jumlah">
                            <button type="button" class="btn btn-primary tambah"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <p class="text-muted">Sub Total</p>
                            <p class="fw-bold" id="sub-text">Rp {{ number_format($data->harga) }}</p>

                            @if (session('success'))
                            @php
                            $potongan = (intval($data->harga) * session('potongan')) / 100;
                            $sub_total = intval($data->harga) - intval($potongan);
                            @endphp
                            <input type="number" id="subtotal" value="{{ $sub_total }}" hidden>
                            @else
                            <input type="number" id="subtotal" value="{{ $data->harga }}" hidden>
                            @endif
                        </div> -->

			<!--disini nambah "{{ number_format($data->harga) }}"-->
                        <div class="d-flex justify-content-between">
                            <h4 class="fw-bold">Total</h4>
                            <p class="fw-bold" id="total-text">Rp {{ number_format($data->harga) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Pesanan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data->title }}</li>
                        </ol>
                    </nav>

                    <div class="card p-3 rounded-15">
                        <h3 class="fw-bold mb-3 text-center">Rincian Pembayaran</h3>
                        <form action="{{ route('payment') }}" method="POST">
                            @csrf
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                placeholder="Full Name" autocomplete="off">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Telepon</td>
                                        <td>:</td>
                                        <td>
                                            <input type="phone"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                placeholder="Eg 0819xxx" autocomplete="off">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Item Pesanan</td>
                                        <td>:</td>
                                        <td>{{ $data->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pengiriman</td>
                                        <td>:</td>
                                        <td>
                                            <select class="form-select @error('pengiriman') is-invalid @enderror"
                                                name="pengiriman" id="pengiriman" aria-label="Default select example">
                                                <option value="">-- Pilih --</option>
                                                <option value="cod">Cast On Delivery</option>
                                                <option value="ekspedisi">Ekspedisi</option>
                                            </select>
                                            @error('pengiriman')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
					
					<!--// nambah id="jumlah"-->
                                    <tr>
                                        <td>Jumlah Pesanan</td>
                                        <td>:</td>
                                        <td>
                                            <input name="jumlah" type="number" id="jumlah" class="form-control  @error('jumlah') is-invalid @enderror" />
                                            @error('jumlah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td>Alamat Lengkap</td>
                                        <td>:</td>
                                        <td>
                                            <textarea name="alamat" class="form-control  @error('alamat') is-invalid @enderror"></textarea>
                                            @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <div class="text-center">
                                <small class="text-muted fw-bold">Semua pembayaran akan direcord untuk mencegah hal
                                    tidak ingin terjadi</small>
                                <br>
                                <small class="text-muted fw-bold">Your IP Address : {{ $secure['IP'] }} and User Agent :
                                    {{ $secure['agent'] }}</small>
                            </div>
                            <hr>
                            <input type="text" hidden name="product_id" value="{{ $data->id }}">

                            <!-- Checkout Button -->
                            <button type="submit" id="checkout-button" class="btn btn-primary btn-bayar w-100">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

</main>


// Ini yang ditambahin

<script>
    // Pastikan harga ada
    const harga = <?php echo json_encode($data->harga); ?>;

    // Fungsi untuk menghitung total
    function updateTotal() {
        const jumlah = document.getElementById('jumlah').value || 1; // Ambil nilai jumlah, jika kosong set 1
        const total = jumlah * harga;
        document.getElementById('total-text').innerText = `Rp ${total.toLocaleString('id-ID')}`;
    }

    // Tambahkan event listener untuk input jumlah
    document.getElementById('jumlah').addEventListener('input', updateTotal);

    // Panggil updateTotal() pertama kali untuk menampilkan total awal
    updateTotal();
</script>




@endsection


