<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SlipgajiController;

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

Route::group(['middleware' => ['logged']], function(){
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('dashboard/ambilData', [DashboardController::class, 'ambilData']);

    // pegawai
    Route::get('pegawai', [PegawaiController::class, 'index']);
    Route::get('pegawai/detail/{id}', [PegawaiController::class, 'detail']);
    Route::post('pegawai/tambah', [PegawaiController::class, 'tambahPegawai']);
    Route::post('pegawai/edit/{id}', [PegawaiController::class, 'editPegawai']);
    Route::delete('pegawai/hapus/{id}', [PegawaiController::class, 'hapusPegawai']);

    // jabatan
    Route::get('jabatan', [JabatanController::class, 'index']);
    Route::post('jabatan/tambah', [JabatanController::class, 'tambahJabatan']);
    Route::get('jabatan/detail/{id}', [JabatanController::class, 'detail']);
    Route::post('jabatan/edit/{id}', [JabatanController::class, 'editJabatan']);
    Route::delete('jabatan/hapus/{id}', [JabatanController::class, 'hapusJabatan']);

    // golongan
    Route::get('golongan', [GolonganController::class, 'index']);
    Route::get('golongan/detail/{id}', [GolonganController::class, 'detail']);
    Route::post('golongan/tambah', [GolonganController::class, 'tambahGolongan']);
    Route::post('golongan/edit/{id}', [GolonganController::class, 'editGolongan']);
    Route::delete('golongan/hapus/{id}', [GolonganController::class, 'hapusGolongan']);

    // kehadiran
    Route::get('kehadiran', [KehadiranController::class, 'index']);
    Route::get('kehadiran/cari', [KehadiranController::class, 'cariKehadiran']);
    Route::get('kehadiran/detail/{id}', [KehadiranController::class, 'detailKehadiran']);
    Route::post('kehadiran/edit/{id}', [KehadiranController::class, 'editKehadiran']);
    Route::get('kehadiran-input', [KehadiranController::class, 'inputKehadiran']);
    Route::get('kehadiran-input/generate', [KehadiranController::class, 'generateKehadiran']);
    Route::post('kehadiran-input/tambah', [KehadiranController::class, 'inputDataKehadiran']);

    // slip gaji
    Route::get('slip-gaji', [SlipgajiController::class, 'index']);
    Route::get('slip-gaji/cari', [SlipgajiController::class, 'cari']);
    Route::get('slip-gaji/detail/{id}', [SlipgajiController::class, 'detail']);

    // logout
    Route::get('logout', [AuthController::class, 'logout']);
});
