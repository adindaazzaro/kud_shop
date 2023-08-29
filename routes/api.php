<?php

use App\Http\Controllers\Api\AlamatKustomerController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KeranjangController;
use App\Http\Controllers\Api\ObatController;
use App\Http\Controllers\Api\TransaksiController;
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
//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
Route::get('/obat', [ObatController::class, 'obat']);
Route::get('/detail-obat', [ObatController::class, 'detailObat']);
Route::get('/search-obat', [ObatController::class, 'search_obat']);
Route::post('/alamat-list', [AlamatKustomerController::class, 'list']);
Route::post('/tambah-transaksi', [TransaksiController::class, 'create']);
Route::post('/upload-bukti-transfer', [TransaksiController::class, 'uploadBuktiTransfer']);
Route::get('/list-transaksi', [TransaksiController::class, 'listTransaksiPelanggan']);
Route::get('/detail-transaksi', [TransaksiController::class, 'detailTransaksiPelanggan']);
Route::get('/kategori-obat', [ObatController::class, 'kategoriObat']);

Route::prefix('keranjang')
->name('keranjang.')
->controller(KeranjangController::class)
->group(function () {
    Route::post('list','list');
    Route::post('store','store');
    Route::post('store-one','storeOne');
    Route::post('delete','delete');
    Route::post('check-uncheck','checkUnCheck');
    Route::post('tambah-kurang','tambahKurang');
});
