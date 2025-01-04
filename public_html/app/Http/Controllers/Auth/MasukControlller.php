<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MasukControlller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            # code...
            return redirect()->route('dashboard')->with('success', 'Selamat Datang Kembali');
        } else {
            return view('auth.login');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            if (auth()->user()->role != "admin" && auth()->user()->role != "tani") {
                # code...
                auth()->logout();
                Session::flush();
                return redirect()->route('masuk')->with('galat', 'Akun Anda Tidak Tersedia, Hubungi Admin');
            } else {
                # code...
                return redirect()->route('dashboard')->with('success', 'Selamat Datang');
            }
        }

        return redirect()->route('masuk')->with('galat', 'Username atau Password Salah');
    }
}
