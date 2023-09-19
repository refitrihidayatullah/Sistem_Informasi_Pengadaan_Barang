<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RiwayatTransaksi;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

// admin dan karyawan
Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard_admin']);
    // barang
    Route::get('/barang', [BarangController::class, 'index']);
    // change password
    Route::get('/change-password', [UserController::class, 'change_password']);
    Route::post('/change-password', [UserController::class, 'action_change_password']);
});

// middleware role admin
Route::middleware(['auth', 'admin-auth'])->group(function () {
    // supplier
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier', 'index');
        Route::get('/supplier/create',  'create');
        Route::post('/supplier/store',  'store');
        Route::get('/supplier/{id}/edit',  'edit');
        Route::put('/supplier/{id}',  'update');
        Route::delete('/supplier/{id}',  'destroy');
    });

    // kategori
    Route::controller(KategoriController::class)->group(function () {

        Route::get('/kategori', 'index');
        Route::get('/kategori/create', 'create');
        Route::post('/kategori/store', 'store');
        Route::get('/kategori/{id}/edit', 'edit');
        Route::put('/kategori/{id}', 'update');
        Route::delete('/kategori/{id}', 'destroy');
    });
    //satuan
    Route::controller(SatuanController::class)->group(function () {
        Route::get('/satuan',  'index');
        Route::get('/satuan/create',  'create');
        Route::post('/satuan/store',  'store');
        Route::get('/satuan/{id}/edit',  'edit');
        Route::put('/satuan/{id}',  'update');
        Route::delete('/satuan/{id}',  'destroy');
    });
    //barang
    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang/create', 'create');
        Route::post('/barang/store', 'store');
        Route::get('/barang/{id}/edit', 'edit');
        Route::put('/barang/{id}', 'update');
        Route::delete('/barang/{id}', 'destroy');
    });
    // barang-masuk
    Route::controller(BarangMasukController::class)->group(function () {
        Route::get('/barang-masuk',  'index');
        Route::get('/barang-masuk/create',  'create');
        Route::post('/barang-masuk/store',  'store');
        Route::delete('/barang-masuk/{id}',  'destroy');
    });
    //laporan 
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporan-barang-masuk', 'laporan_barang_masuk');
        Route::get('/laporan-barang-masuk/export', 'export_barang_masuk');
        Route::get('/laporan-barang-keluar', 'laporan_barang_keluar');
        Route::get('/laporan-barang-keluar/export', 'export_barang_keluar');
    });
    // data users
    Route::controller(UserController::class)->group(function () {
        Route::get('/data-users', 'data_users');
        Route::delete('/data-users/{id}', 'delete_user');
    });
});

//middleware role karyawan
Route::middleware(['auth', 'karyawan-auth'])->group(function () {
    Route::controller(BarangKeluarController::class)->group(function () {
        Route::get('/barang-keluar', 'index');
        Route::post('/barang-keluar', 'store');
        Route::post('/barang-keluar/{id}', 'insertTrBarang');
        Route::delete('/barang-keluar/{id}', 'destroy');
        Route::get('/barang-keluar/{id}', 'reset');
    });

    Route::controller(RiwayatTransaksi::class)->group(function () {
        Route::get('/riwayat-transaksi', 'index');
        Route::get('/invoice/{id}', 'cetakTransaksi');
        Route::delete('/riwayat-transaksi/{id}', 'deleteTransaksi');
    });
});


















Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [UserController::class, 'action_register'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'action_login']);
Route::get('/logout', [UserController::class, 'action_logout'])->middleware('auth');
