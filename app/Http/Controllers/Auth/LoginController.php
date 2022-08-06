<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => "Login"
        ];

        if (Session::get('penduduk')) {
            return redirect('penduduk');
        } else {
            return view('auth.login', $data);
        }
    }

    public function proccess(Request $request)
    {
        $validate = $request->validate([
            'nik' => 'required|min:16|max:16'
        ]);

        $penduduk = Penduduk::where('nik', $validate['nik'])->first();

        if ($penduduk) {
            Session::put('penduduk', $penduduk);
            return redirect('penduduk');
        } else {
            return back()->with('message', '<div class="alert alert-danger">Anda belum terdaftar!</div>');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}