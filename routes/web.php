<?php

use App\Http\Controllers\pelanggan\LoginPelangganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PenggunaanController;   
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController;

use Illuminate\Support\Facades\Route;

//Route::get('/', [LoginPelangganController::class, 'index'])->name('login');
//Route::post('/login', [LoginPelangganController::class, 'autheticate'])->name('login.proses');
//Route::get('/logout', [LoginPelangganController::class, 'logout'])->name('logout');

//admin dan petugas
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'autheticate'])->name('login.proses');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', [AuthController::class, 'admin'])->name('admin.index');
//tarif CRUD
Route::get('/admin/tarif', [TarifController::class, 'tarif'])->name('admin.tarif.tarif');
Route::get('/admin/tarif/create', [TarifController::class, 'create'])->name('admin.tarif.create');
Route::post('/admin/tarif/store', [TarifController::class, 'store'])->name('admin.tarif.store');
Route::get('/admin/tarif/edit/{id}', [TarifController::class, 'edit'])->name('admin.tarif.edit');
Route::put('/admin/tarif/update/{id}', [TarifController::class, 'update'])->name('admin.tarif.update');
Route::delete('/admin/tarif/delete/{id}', [TarifController::class, 'delete'])->name('admin.tarif.delete');
//pelanggan CRUD
Route::get('/admin/pelanggan', [PelangganController::class, 'pelanggan'])->name('admin.pelanggan.pelanggan');
Route::get('/admin/pelanggan/create', [PelangganController::class, 'create'])->name('admin.pelanggan.create');
Route::post('/admin/pelanggan/store', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
Route::get('/admin/pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('admin.pelanggan.edit');
Route::put('/admin/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
Route::delete('/admin/pelanggan/delete/{id}', [PelangganController::class, 'delete'])->name('admin.pelanggan.delete');
//pengunaan CRUD
Route::get('/admin/penggunaan', [PenggunaanController::class, 'penggunaan'])->name('admin.penggunaan.penggunaan');
Route::get('/admin/penggunaan/create', [PenggunaanController::class, 'create'])->name('admin.penggunaan.create');
Route::post('/admin/penggunaan/store', [PenggunaanController::class, 'store'])->name('admin.penggunaan.store');
Route::get('/admin/penggunaan/edit/{id}', [PenggunaanController::class, 'edit'])->name('admin.penggunaan.edit');
Route::put('/admin/penggunaan/update/{id}', [PenggunaanController::class, 'update'])->name('admin.penggunaan.update');
Route::delete('/admin/penggunaan/delete/{id}', [PenggunaanController::class, 'delete'])->name('admin.penggunaan.delete');
//tagihan 
Route::get('/admin/tagihan', [TagihanController::class, 'tagihan'])->name('admin.tagihan.tagihan');
Route::get('/admin/tagihan/generate', [TagihanController::class, 'generate'])->name('admin.tagihan.generate');
Route::get('/admin/tagihan/{id}', [TagihanController::class, 'show'])->name('admin.tagihan.show');
Route::put('/admin/tagihan/update-status/{id}', [TagihanController::class, 'updateStatus'])->name('admin.tagihan.updateStatus');
Route::delete('/admin/tagihan/delete/{id}', [TagihanController::class, 'delete'])->name('admin.tagihan.delete');
//pembayaran
Route::get('/admin/pembayaran', [PembayaranController::class, 'pembayaran'])->name('admin.pembayaran.pembayaran');
Route::get('/admin/pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
Route::post('/admin/pembayaran/store', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
Route::delete('/admin/pembayaran/delete/{id}', [PembayaranController::class, 'delete'])->name('admin.pembayaran.delete');


Route::get('/petugas', [AuthController::class, 'petugas'])->name('petugas.index');
