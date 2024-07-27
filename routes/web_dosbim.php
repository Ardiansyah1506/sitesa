<?php

use App\Http\Controllers\Dosbim\BimbinganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosbim\DashboardController;
use App\Http\Controllers\Dosbim\PengajuanController;

Route::prefix('dosen-pembimbing')->name('dosbim.')->group(function() {

    Route::controller(DashboardController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(BimbinganController::class)->group(function() {
        Route::get('/bimbingan', 'index')->name('bimbingan');
        Route::get('/bimbingan/get-data', 'getData')->name('get-data');
    });

    Route::controller(PengajuanController::class)->group(function() {
        Route::get('/pengajuan', 'index')->name('pengajuan');
        Route::get('/pengajuan/get-data', 'getData')->name('get-data');
        Route::put('/pengajuan/acc/{id?}', 'acc')->name('acc');
    });


    });
