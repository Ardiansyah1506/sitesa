<?php

use App\Http\Controllers\Mhs\BimbinganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mhs\TesisMhsController;
use App\Http\Controllers\Mhs\DashboardController;
use App\Http\Controllers\Mhs\PembimbingController;

Route::prefix('mahasiswa')->name('mhs.')->group(function() {

Route::controller(TesisMhsController::class)->group(function() {
        Route::get('/',  'index')->name('index');
        Route::get('/getdata',  'getData')->name('tesis.getdata');
        Route::post('/cekplagiasi',  'CekPlagiasi')->name('tesis.cekplagiasi');
        Route::post('/daftartesis',  'DaftarTesis')->name('tesis.daftartesis');
        Route::get('/checkPaymentStatus','checkPaymentStatus')->name('checkPaymentStatus');
        Route::get('/checkTesis','checkTesis')->name('checkTesis');
    });

Route::controller(PembimbingController::class)->group(function() {
    Route::get('/pembimbing', 'index')->name('pembimbing.index');
    Route::get('/getDataPembimbing', 'getDataPembimbing')->name('pembimbing.getDataPembimbing');
    Route::post('/pengajuanpembimbing', 'PengajuanBimbingan')->name('pembimbing.PengajuanBimbingan');
    });

Route::controller(BimbinganController::class)->group(function() {
    Route::get('/bimbingan',  'index')->name('bimbingan.index');
    Route::get('/bimbingan/data/{id_kategori}',  'getData')->name('bimbingan.getDataBimbingan');
    Route::post('/bimbingan/upload/{id_kategori}',  'uploadBab')->name('bimbingan.uploadBab');
    });
    
});
