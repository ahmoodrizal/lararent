<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $courts = Court::orderBy('type')->get();

        return view('user.welcome', compact('courts'));
    }
}
