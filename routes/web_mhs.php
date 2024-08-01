<?php

use App\Http\Controllers\Mhs\AkademikController;
use App\Http\Controllers\Mhs\TaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mhs\TesisMhsController;
use App\Http\Controllers\Mhs\BimbinganController;
use App\Http\Controllers\Mhs\DashboardController;
use App\Http\Controllers\Mhs\DokumenController;
use App\Http\Controllers\Mhs\PembimbingController;
use App\Http\Controllers\Prodi\SetWaktuTAController;

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
    Route::get('/cekPengajuan', 'cekPengajuan')->name('pembimbing.cekPengajuan');
    });

Route::controller(BimbinganController::class)->group(function() {
    Route::get('/bimbingan',  'index')->name('bimbingan.index');
    Route::get('/bimbingan/data/{id_kategori}',  'getData')->name('bimbingan.getDataBimbingan');
    Route::post('/bimbingan/upload/{id_kategori}',  'uploadBab')->name('bimbingan.uploadBab');
    });
    Route::controller(TaController::class)->group(function() {
        Route::get('/ta', 'index')->name('ta.waktu');
        Route::get('/waktu-ta/get-data', 'getData')->name('ta.getData');
        Route::post('/ta/pengajuan', 'createPengajuan')->name('ta.createPengajuan');
    });
    Route::controller(DokumenController::class)->group(function() {
        Route::get('/dokumen', 'index')->name('dokumen.index');
        Route::get('/dokumen/proposal', 'lembarProposalPdf')->name('dokumen.lembarProposal');
    });
    // Route::controller(AkademikController::class)->group(function() {
    //     Route::get('/dokumen', 'index')->name('dokumen.index');
    // });
});
