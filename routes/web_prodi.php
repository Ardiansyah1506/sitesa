<?php

use App\Http\Controllers\Prodi\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prodi\DashboardController;
use App\Http\Controllers\Prodi\SetWaktuTAController;

Route::prefix('prodi')->name('prodi.')->group(function() {

Route::controller(DashboardController::class)->group(function() {
    Route::get('/', 'index')->name('index');
});

Route::controller(PengajuanController::class)->group(function() {
    Route::get('/pengajuan', 'index')->name('pengajuan');
    Route::get('/pengajuan/get-data', 'getData')->name('get-data');
    Route::put('/pengajuan/acc/{id?}', 'acc')->name('acc');
});


});