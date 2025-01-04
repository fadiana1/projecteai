@extends('layouts.backend.master')
@section('title')
    Edit Product
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>@yield('title')</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.product.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PATCH')
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="{{ asset('img/' . $data->image) }}" class="img-fluid shadow-sm"
                                        style="border-radius: 14px;" id="blah">
                                    <div class="mt-3">
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <div>
                                                Gambar hanya JPG dan PNG serta Maks Size 2 MB
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Product</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ $data->title }}" autocomplete="off">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Masukan Harga</label>
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                            name="harga" value="{{ $data->harga }}" autocomplete="off">
                                        @error('harga')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status Product</label>
                                                <fieldset class="form-group">
                                                    <select class="form-select @error('status') is-invalid @enderror"
                                                        id="basicSelect" name="status">
                                                        <option value="">-- Pilih --</option>
                                                        <option {{ $data->status == 'publish' ? 'selected' : '' }}
                                                            value="publish">
                                                            publish</option>
                                                        <option {{ $data->status == 'draft' ? 'selected' : '' }}
                                                            value="draft">
                                                            draft</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                @if (auth()->user()->role == 'tani')
                                                    <label class="form-label">Kelompok Tani</label>
                                                    <input type="text" class="form-control" readonly disabled
                                                        value="{{ auth()->user()->suplier->title }}">
                                                @else
                                                    <label class="form-label">Kelompok Tani</label>
                                                    <fieldset class="form-group">
                                                        <select class="form-select @error('tani') is-invalid @enderror"
                                                            id="basicSelect" name="tani">
                                                            <option value="">-- Pilih --</option>
                                                            @foreach ($tani as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ $data->tani_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('tani')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </fieldset>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Stok</label>
                                                <input type="number" class="form-control" value="{{ $data->stock }}"
                                                    readonly disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Masukan Foto Armada Bus</label>
                                                <input type="file"
                                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                                    autocomplete="off" id="imgInp">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Youtube Link Review</label>
                                        <input type="text" class="form-control @error('video') is-invalid @enderror"
                                            name="video" value="{{ $data->video }}" autocomplete="off">
                                        @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Deskripsi Product</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body"
                                        placeholder="Hi, Do you have a moment to talk Joe?" id="summernote">{!! $data->body !!}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                <button type="reset" class="btn btn-outline-secondary me-1 mb-1">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        /* Summernote Additional CSS */
        .note-editable {
            background: #fff;
        }

        .note-btn.dropdown-toggle:after {
            content: none;
        }

        .note-btn[aria-label="Help"] {
            display: none;
        }

        .note-editor .note-toolbar .note-color-all .note-dropdown-menu,
        .note-popover .popover-content .note-color-all .note-dropdown-menu {
            min-width: 185px;
        }

        /* Customize Summernote editor */
        .note-editor {
            /* Your custom styles here */
        }

        .note-editable {
            /* Your custom styles here */
        }

        /* Toolbar customization */
        .note-toolbar {
            /* Your custom styles here */
        }

        /* Buttons customization */
        .note-btn {
            /* Your custom styles here */
        }
    </style>
@endsection

@section('scripts')
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 5',
            tabsize: 2,
            height: 400
        });
    </script>
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
