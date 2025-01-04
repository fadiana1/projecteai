@extends('layouts.backend.master')

@section('title')
    Galery
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @forelse ($data as $item)
                        <div class="col-md-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset('img/galery/' . $item->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <form action="{{ route('admin.galery.destroy', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-label-danger waves-effect shadow-sm w-100 fw-bold">
                                            <span class="ti ti-trash"></span> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg">
                            <div class="alert alert-danger" role="alert">
                                Silahkan Upload Gambar dahulu
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded shadow-sm">
                    <div class="card-header">
                        <h5 class="text-center">Tambah Gambar</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.galery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <img src="{{ asset('assets/no-image.jpeg') }}" class="img-fluid shadow-sm"
                                    style="border-radius: 14px;" id="blah">
                                <div class="mt-3">
                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <div>
                                            Gambar hanya JPG dan PNG serta Maks Size 2 MB
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Masukan Gambar</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" autocomplete="off" id="imgInp">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-primary w-100">Simpan Gambar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
