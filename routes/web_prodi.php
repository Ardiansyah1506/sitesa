<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prodi\DashboardController;
use App\Http\Controllers\Prodi\SetWaktuTAController;
use App\Http\Controllers\Prodi\BimbinganController;
use App\Http\Controllers\Prodi\DosenController;
use App\Http\Controllers\Prodi\KuotaPembimbingController;
use App\Http\Controllers\Prodi\PengajuanController;

Route::prefix('prodi')->name('prodi.')->group(function() {

Route::controller(DashboardController::class)->group(function() {
    Route::get('/', 'index')->name('index');
});

Route::controller(PengajuanController::class)->group(function() {
    Route::get('/pengajuan', 'index')->name('pengajuan');
    Route::get('/pengajuan/get-data', 'getData')->name('get-data');
    Route::get('/pengajuan/get-data-detail/{id?}', 'getDataDetail')->name('get-data-detail');
    Route::put('/pengajuan/acc/{id?}', 'acc')->name('acc');
    Route::get('/pengajuan/detail-bimbingan/{id?}', 'detailDosenBimbingan')->name('detail-bimbingan');
});

Route::controller(BimbinganController::class)->group(function() {
    Route::get('/bimbingan', 'index')->name('bimbingan');
    Route::get('/bimbingan/get-data', 'getData')->name('get-data');
});

Route::controller(SetWaktuTAController::class)->group(function() {
    Route::get('/waktu-ta', 'index')->name('waktu-ta');
    Route::get('/waktu-ta/get-data', 'getData')->name('get-data');
    // Route::post('/waktu-ta/store', 'store')->name('store-waktu-ta');
    Route::get('/waktu-ta/edit/{id?}', 'edit')->name('edit-ta');
    Route::put('/waktu-ta/update', 'update')->name('update-waktu-ta');
    Route::delete('/waktu-ta/{id?}', 'delete')->name('delete-waktu-ta');
});

Route::controller(KuotaPembimbingController::class)->group(function() {
    Route::get('/kuota-pembimbing', 'index')->name('kuota-pembimbing');
    Route::get('/kuota-pembimbing/get-data', 'getData')->name('kuota.getDataKuota');
});

Route::controller(DosenController::class)->group(function() {
    Route::get('dosen', 'index')->name('dosen.index');
    Route::get('/dosen/get-data', 'getData')->name('dosen.getDataKuota');
    Route::get('/dosen/edit/{id?}', 'edit')->name('dosen.edit-dosen');
    Route::post('/dosen/update', 'store')->name('dosen.updateKuotaPembimbing');
});


});