<?php

use App\Http\Controllers\C_Akun;
use App\Http\Controllers\C_Lelang;
use App\Http\Controllers\C_Penawaran;
use Illuminate\Support\Facades\Route;

// Landing & Autentikasi
Route::get('/', [C_Akun::class, 'landing'])->name('landing');
Route::get('/daftar', [C_Akun::class, 'formDaftar'])->name('daftar');
Route::post('/daftar', [C_Akun::class, 'daftar']);
Route::get('/masuk', [C_Akun::class, 'formMasuk'])->name('masuk');
Route::post('/masuk', [C_Akun::class, 'masuk']);

// Lupa Password
Route::get('/lupa-password', [C_Akun::class, 'formLupaPassword'])->name('lupa.password');
Route::post('/lupa-password', [C_Akun::class, 'kirimOTP'])->name('lupa.password.submit');
Route::get('/verifikasi-otp', [C_Akun::class, 'formVerifikasiOTP'])->name('verifikasi.otp');
Route::post('/verifikasi-otp', [C_Akun::class, 'verifikasiOTP'])->name('verifikasi.otp.submit');
Route::get('/ubah-password', [C_Akun::class, 'formUbahPassword'])->name('ubah.password');
Route::post('/ubah-password', [C_Akun::class, 'ubahPassword'])->name('ubah.password.submit');

// Group dengan middleware login
Route::middleware(['cekLogin'])->group(function () {
    Route::post('/keluar', [C_Akun::class, 'keluar'])->name('keluar');
    Route::get('/akun', [C_Akun::class, 'akun'])->name('akun');
    Route::post('/akun/update', [C_Akun::class, 'updateProfil'])->name('akun.update');

    Route::get('/lelang-umum', [C_Lelang::class, 'umum'])->name('lelang.umum');
    Route::get('/lelang-pribadi', [C_Lelang::class, 'pribadi'])->name('lelang.pribadi');
    Route::get('/lelang/buat', [C_Lelang::class, 'formBuat'])->name('lelang.buat');
    Route::post('/lelang/simpan', [C_Lelang::class, 'simpanLelang'])->name('lelang.simpan');
    Route::post('/lelang/{id}/batalkan', [C_Lelang::class, 'batalkan'])->name('lelang.batalkan');

    // AJAX endpoint
    Route::post('/penawaran/{lelangId}', [C_Penawaran::class, 'buatPenawaran'])->name('penawaran.buat');
});
