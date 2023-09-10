<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
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
Route::get('/dashboard', [DashboardController::class, 'dashboard_admin'])->middleware('auth');

Route::get('/supplier', [SupplierController::class, 'index'])->middleware('auth');
Route::get('/supplier/create', [SupplierController::class, 'create'])->middleware('auth');
Route::post('/supplier/store', [SupplierController::class, 'store'])->middleware('auth');
Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->middleware('auth');
Route::put('/supplier/{id}', [SupplierController::class, 'update'])->middleware('auth');
Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->middleware('auth');

Route::get('/kategori', [KategoriController::class, 'index'])->middleware('auth');
Route::get('/kategori/create', [KategoriController::class, 'create'])->middleware('auth');
Route::post('/kategori/store', [KategoriController::class, 'store'])->middleware('auth');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->middleware('auth');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->middleware('auth');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->middleware('auth');

Route::get('/satuan', [SatuanController::class, 'index'])->middleware('auth');
Route::get('/satuan/create', [SatuanController::class, 'create'])->middleware('auth');
Route::post('/satuan/store', [SatuanController::class, 'store'])->middleware('auth');
Route::get('/satuan/{id}/edit', [SatuanController::class, 'edit'])->middleware('auth');
Route::put('/satuan/{id}', [SatuanController::class, 'update'])->middleware('auth');
Route::delete('/satuan/{id}', [SatuanController::class, 'destroy'])->middleware('auth');

Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::get('/barang/create', [BarangController::class, 'create'])->middleware('auth');
Route::post('/barang/store', [BarangController::class, 'store'])->middleware('auth');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->middleware('auth');
Route::put('/barang/{id}', [BarangController::class, 'update'])->middleware('auth');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->middleware('auth');

Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->middleware('auth',);
Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->middleware('auth',);
Route::post('/barang-masuk/store', [BarangMasukController::class, 'store'])->middleware('auth',);




Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [UserController::class, 'action_register'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'action_login'])->middleware('guest');
Route::get('/logout', [UserController::class, 'action_logout'])->middleware('guest');
