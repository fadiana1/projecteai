@extends('layouts.auth')
@section('title')
    Login Account
@endsection

@section('content')
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="text-center">
                <img src="https://www.kemdikbud.go.id/main/files/large/83790f2b43f00be" alt="" width="40"> <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Logo_ITTelkom_Purwokerto.png/800px-Logo_ITTelkom_Purwokerto.png"
                    alt="" height="30">
            </div>
            <div class="app-brand mb-4" style="justify-content: center;">
                <a href="/" class="app-brand-link gap-2">
                    <img src="{{ asset('assets/fe/img/logo.png') }}" width="300" alt="">
                </a>
            </div>
            <!-- /Logo -->
            <div class="text-center">
                <h3 class="mb-1 fw-bold">Welcome 👋</h3>
                <p class="mb-4">Please sign-in to your account and start the adventure</p>
            </div>

            <form id="formAuthentication" class="mb-3" action="{{ route('masuk.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror"
                        name="username" value="{{ old('username') }}" autocomplete="off" placeholder="jhon@example.com"
                        autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        <a href="auth-forgot-password-cover.html">
                            <small>Forgot Password?</small>
                        </a>
                    </div>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" autocomplete="off" placeholder="***">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
            </form>
        </div>
    </div>
@endsection
