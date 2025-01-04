@extends('layouts.backend.master')

@section('title')
    Rantai Pasok
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header">
                <div class="head-label text-center">
                    <h5 class="card-title mb-4">@yield('title')</h5>
                </div>
                <form action="" method="GET">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Order</label>
                            <select id="defaultSelect" class="form-select" name="status">
                                <option value="">-- Pilih --</option>
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="mengirim">Mengirim</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Pembayaran</label>
                            <select id="defaultSelect" class="form-select" name="pembayaran">
                                <option value="">-- Pilih --</option>
                                <option value="pending">Pending</option>
                                <option value="aprove">Aprove</option>
                                <option value="gagal">Gagal</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Pengiriman</label>
                            <select id="defaultSelect" class="form-select" name="pengiriman">
                                <option value="">-- Pilih --</option>
                                <option value="cod">COD</option>
                                <option value="expedisi">Ekspedisi</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="defaultSelect" class="form-label">Status Pengiriman</label>
                            <input type="text" class="form-control" placeholder="Cari disini" autocomplete="off"
                                name="q">
                        </div>

                        <div class="mb-0 col-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-label-primary shadow-sm waves-effect w-100">
                                        Mulai Filter Tabel
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('admin.order-masuk') }}"
                                        class="btn btn-label-danger shadow-sm waves-effect w-100">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="data-table table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pemasok</th>
                                <th>Produck</th>
                                <th>Sisa Stok</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        {{-- change --}}
        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Pindah Kelompok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.stock.store', $data->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameBasic" class="form-label">Pilih Kelompok Tani</label>
                                    <select class="form-select" name="tani" aria-label="Default select example">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($gudang as $suplier)
                                            <option value="{{ $suplier->id }}">{{ $suplier->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" name="product_id" id="product_id" hidden>
                                <div class="col mb-0">
                                    <label for="emailBasic" class="form-label">Tambah Stock</label>
                                    <input type="number" name="stock" class="form-control" placeholder="1"
                                        min="1">
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-primary waves-effect waves-light mt-4 w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
             --------------------------------------------
             Pass Header Token
             --------------------------------------------
             --------------------------------------------*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            Render DataTable
            --------------------------------------------
            --------------------------------------------*/
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.stock.show', $data->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'gudang',
                        name: 'gudang'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            /*------------------------------------------
            --------------------------------------------
            Click to Edit Button
            --------------------------------------------
            --------------------------------------------*/
            $('body').on('click', '.editProduct', function() {
                var id = $(this).data('id');
                $('#product_id').val(id);
                $('#basicModal').modal('show');
            });
        });
    </script>
@endsection
