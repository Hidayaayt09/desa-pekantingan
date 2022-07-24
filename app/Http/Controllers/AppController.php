<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
        ];

        return view('landing.home', $data);
    }
}
