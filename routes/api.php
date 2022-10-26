<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth

Route::post('bisnis-umkm-login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::post('bisnis-umkm-login-penjual', [App\Http\Controllers\Auth\LoginController::class, 'login_penjual'])->name('login_penjual');

Route::post('bisnis-umkm-register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

Route::post('bisnis-umkm-register-penjual', [App\Http\Controllers\RegisterPenjual::class, 'register_penjual'])->name('register_penjual');


// Produsen

Route::get('bisnis-umkm-get-produsen', [App\Http\Controllers\ProdusenController::class,'getProdusen']);


// Penjualan

// Route::get('get-detail-produsen', [App\Http\Controllers\ProdusenController::class,'getDetailProdusen']);

// Route::get('get-detail-penjual', [App\Http\Controllers\PenjualController::class,'getDetailPenjual']);

Route::get('bisnis-umkm-get-penjual', [App\Http\Controllers\PenjualController::class,'getPenjual']);

Route::get('bisnis-umkm-get-toko', [App\Http\Controllers\PenjualController::class,'getToko']);


// Request

Route::get('bisnis-umkm-get-detail-produsen-request', [App\Http\Controllers\RequestProdusenController::class,'getDetailProdusenRequest'])->middleware('auth:api');

Route::post('bisnis-umkm-set-detail-produsen_request', [App\Http\Controllers\RequestProdusenController::class,'setDetailProdusenRequest'])->middleware('auth:api');

Route::get('bisnis-umkm-get-all-detail_produsen-request', [App\Http\Controllers\RequestProdusenController::class,'getAllDetailProdusenRequest']);

Route::get('bisnis-umkm-get-specific-detail_produsen-request', [App\Http\Controllers\RequestProdusenController::class,'getSpesifictDetailProdusenRequest']);

Route::get('bisnis-umkm-update-detail-produsen-request', [App\Http\Controllers\RequestProdusenController::class,'updateProdusenRequest']);

Route::get('bisnis-umkm-delete-produsen-request', [App\Http\Controllers\RequestProdusenController::class,'deleteProdusenRequest']);


// Laporan

Route::post('bisnis-umkm-set-laporan', [App\Http\Controllers\LaporanController::class,'setLaporan']);

Route::get('bisnis-umkm-get-laporan-produsen', [App\Http\Controllers\LaporanController::class,'getLaporanProdusen']);

Route::get('bisnis-umkm-get-laporan-penjual', [App\Http\Controllers\LaporanController::class,'getLaporanPenjual']);
