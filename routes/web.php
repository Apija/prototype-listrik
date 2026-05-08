<?php
//admin
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PenggunaanController;   
use App\Http\Controllers\Admin\TagihanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\UserController;

//petugas
use App\Http\Controllers\Petugas\PetugasPelangganController;
use App\Http\Controllers\Petugas\PetugasPenggunaanController;
use App\Http\Controllers\Petugas\PetugasTagihanController;
use App\Http\Controllers\Petugas\PetugasPembayaranController;

//pelanggan
use App\Http\Controllers\pelanggan\LoginPelangganController;
use App\Http\Controllers\pelanggan\ProfilePelangganController;



use Illuminate\Support\Facades\Route;
//pelangan
Route::get('/', [LoginPelangganController::class, 'index'])->name('pelanggan.login');
Route::post('/pelanggan/login', [LoginPelangganController::class, 'autheticate'])->name('pelanggan.login.autheticate');
Route::get('/pelanggan/logout', [LoginPelangganController::class, 'logout'])->name('pelanggan.logout');
Route::get('/pelanggan/dashboard', [ProfilePelangganController::class, 'dashboard'])->name('pelanggan.dashboard');
Route::get('/pelanggan/profil', [ProfilePelangganController::class, 'profil'])->name('pelanggan.profil');

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
Route::get('/admin/pembayaran/show/{id}', [PembayaranController::class, 'show'])->name('admin.pembayaran.show');
//admin user CRUD
Route::get('/admin/user', [UserController::class, 'user'])->name('admin.user.user');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
Route::get('/admin/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::delete('/admin/user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

Route::get('/petugas', [AuthController::class, 'petugas'])->name('petugas.index');
//pelanggan petugas
Route::get('/petugas/pelanggan', [PetugasPelangganController::class, 'pelanggan'])->name('petugas.pelanggan.pelanggan');
Route::get('/petugas/pelanggan/show/{id}', [PetugasPelangganController::class, 'show'])->name('petugas.pelanggan.show');
//penggunaan petugas
Route::get('/petugas/penggunaan', [PetugasPenggunaanController::class, 'penggunaan'])->name('petugas.penggunaan.penggunaan');
Route::get('/petugas/penggunaan/create', [PetugasPenggunaanController::class, 'create'])->name('petugas.penggunaan.create');
Route::post('/petugas/penggunaan/store', [PetugasPenggunaanController::class, 'store'])->name('petugas.penggunaan.store');
Route::get('/petugas/penggunaan/edit/{id}', [PetugasPenggunaanController::class, 'edit'])->name('petugas.penggunaan.edit');
Route::put('/petugas/penggunaan/update/{id}', [PetugasPenggunaanController::class, 'update'])->name('petugas.penggunaan.update');
Route::delete('/petugas/penggunaan/delete/{id}', [PetugasPenggunaanController::class, 'delete'])->name('petugas.penggunaan.delete');
//tagihan petugas
Route::get('/petugas/tagihan', [PetugasTagihanController::class, 'tagihan'])->name('petugas.tagihan.tagihan');
Route::get('/petugas/tagihan/show/{id}', [PetugasTagihanController::class, 'show'])->name('petugas.tagihan.show');
//pembayaran petugas
Route::get('/petugas/pembayaran', [PetugasPembayaranController::class, 'pembayaran'])->name('petugas.pembayaran.pembayaran');
Route::get('/petugas/pembayaran/show/{id}', [PetugasPembayaranController::class, 'show'])->name('petugas.pembayaran.show');
Route::get('/petugas/pembayaran/create', [PetugasPembayaranController::class, 'create'])->name('petugas.pembayaran.create');
Route::post('/petugas/pembayaran/store', [PetugasPembayaranController::class, 'store'])->name('petugas.pembayaran.store');
Route::delete('/petugas/pembayaran/delete/{id}', [PetugasPembayaranController::class, 'delete'])->name('petugas.pembayaran.delete');