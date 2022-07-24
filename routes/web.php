<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendudukController;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AppController::class, 'index']);

Route::middleware(['guest'])->group(function () {
    Route::get('auth', [LoginController::class, 'login']);
    Route::get('auth/login', [LoginController::class, 'login']);
    Route::post('auth/login', [LoginController::class, 'proses']);
});

Route::get('berita', [BeritaController::class, 'showAll']);
Route::get('berita/{slug}', [BeritaController::class, 'show']);

Route::get('formulir/{tipe}', [FormulirController::class, 'index']);
Route::post('formulir/{tipe}', [FormulirController::class, 'store']);

Route::prefix('tentang')->group(function () {
    Route::get('visi-misi', function () {
        $data = [
            'title' => 'Visi Misi',
            'title1' => 'Home',
        ];

        return view('landing.tentang.visi-misi', $data);
    });

    Route::get('profil-wilayah', function () {
        $data = [
            'title' => 'Profil Wilayah',
            'title1' => 'Home',
        ];

        return view('landing.tentang.profil-wilayah', $data);
    });

    Route::get('map', function () {
        $data = [
            'title' => 'Maps',
            'title1' => 'Home',
        ];

        return view('landing.tentang.map', $data);
    });
});

Route::middleware(['autentikasi'])->group(function () {
    Route::prefix('api/v1/')->group(function () {
        Route::get('image/{id}', [FormulirController::class, 'showImage']);
    });

    Route::get('auth/logout', [LoginController::class, 'logout']);

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::resource('akun', AkunController::class);

        Route::get('surat/{tipe}', [FormulirController::class, 'show']);
        Route::get('surat/cetak/{tipe}/{id}', [FormulirController::class, 'cetak']);
        Route::delete('surat/{tipe}/{id}', [FormulirController::class, 'destroy']);

        Route::resource('berita', BeritaController::class);

        Route::post('kependudukan/upload', [PendudukController::class, 'import']);
        Route::get('kependudukan/download', [PendudukController::class, 'export']);
        Route::resource('kependudukan', PendudukController::class);
    });
});
