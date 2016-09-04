<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function showWelcome()
    {
        $data = [
        'authCheck' => Auth::check()
    ];

    return view('welcome', $data);
    }
}