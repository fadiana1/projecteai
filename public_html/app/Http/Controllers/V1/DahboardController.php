<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DahboardController extends Controller
{
    public function index()
    {
        return view('v1.dashboard');
    }
}
