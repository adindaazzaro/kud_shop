<?php

use App\Http\Controllers\CAdmin;
use App\Http\Controllers\CAlamatKustomerController;
use App\Http\Controllers\CDataTable;
use App\Http\Controllers\CHTransaksi;
use App\Http\Controllers\CKategori;
use App\Http\Controllers\CLogin;
use App\Http\Controllers\CObat;
use App\Http\Controllers\CPelanggan;
use App\Http\Controllers\CSettingApp;
use App\Http\Controllers\CUser;
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

Route::get('/admin',[CLogin::class,'index'])->middleware('guest');
Route::post('/auth',[CLogin::class,'auth']);

Route::middleware(['auth'])->group(function ()
{
    Route::name('admin.')->prefix('/admin')->group(function ()
    {
        Route::get('/home', [CAdmin::class, 'index']);

        Route::resource('pengguna',CUser::class);
        Route::resource('kategori-obat',CKategori::class);
        Route::resource('pelanggan',CPelanggan::class);
        Route::resource('obat',CObat::class);
        Route::post('obat/update-save/{id}',[CObat::class,'update']);
        Route::get('htransaksi',[CHTransaksi::class,'index'])->name('transaksi');
        Route::get('htransaksi/{id_transaksi}',[CHTransaksi::class,'destroy'])->name('transaksi.destroy');
        Route::get('alamat_pelanggan/{id_kustomer}',[CAlamatKustomerController::class,'index'])->name('alamat.pelanggan');
        Route::get('alamat_pelanggan_create/{id_kustomer}',[CAlamatKustomerController::class,'create'])->name('alamat.pelanggan.create');
        Route::post('alamat_pelanggan_save',[CAlamatKustomerController::class,'save'])->name('alamat.pelanggan.save');
        Route::get('alamat_pelanggan_edit/{id_kustomer}/{id_alamat}',[CAlamatKustomerController::class,'edit'])->name('alamat.pelanggan.edit');
        Route::get('alamat_pelanggan_delete/{id_kustomer}/{id_alamat}',[CAlamatKustomerController::class,'delete'])->name('alamat.pelanggan.delete');
        Route::get('/pengaturan', [CSettingApp::class, 'index']);

        Route::post('/pengaturan-update', [CSettingApp::class, 'saveUpdate']);
        Route::get('/logout', [CLogin::class, 'logout']);
    });
    Route::prefix('/datatable')->group(function ()
    {

        Route::get('/obat', [CDataTable::class, 'obat']);
        Route::get('/pengguna', [CDataTable::class, 'pengguna']);
        Route::get('/kategori-obat', [CDataTable::class, 'kategoriobat']);
        Route::get('/pelanggan', [CDataTable::class, 'pelanggan']);
        Route::get('/htransaksi', [CDataTable::class, 'htransaksi']);

    });
});
