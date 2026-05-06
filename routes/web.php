<?php

use App\Http\Controllers\pelanggan\LoginPelangganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\PelangganController;

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

Route::get('/petugas', [AuthController::class, 'petugas'])->name('petugas.index');
