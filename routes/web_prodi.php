<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prodi\DashboardController;
use App\Http\Controllers\Prodi\SetWaktuTAController;
use App\Http\Controllers\Prodi\BimbinganController;
use App\Http\Controllers\Prodi\PengajuanController;

Route::prefix('prodi')->name('prodi.')->group(function() {

Route::controller(DashboardController::class)->group(function() {
    Route::get('/', 'index')->name('index');
});

Route::controller(PengajuanController::class)->group(function() {
    Route::get('/pengajuan', 'index')->name('pengajuan');
    Route::get('/pengajuan/get-data', 'getData')->name('get-data');
    Route::put('/pengajuan/acc/{id?}', 'acc')->name('acc');
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


});