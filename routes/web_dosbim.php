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
        Route::get('/bimbingan/detail/{id?}', 'detail')->name('detail-bimbingan');

        Route::post('/bimbingan/catatan-1/store', 'storeCatatanBab1')->name('store-catatan-bab-1');
        Route::post('/bimbingan/catatan-2/store', 'storeCatatanBab1')->name('store-catatan-bab-2');
        Route::post('/bimbingan/catatan-3/store', 'storeCatatanBab1')->name('store-catatan-bab-3');
        Route::post('/bimbingan/catatan-4/store', 'storeCatatanBab1')->name('store-catatan-bab-4');
        Route::post('/bimbingan/catatan-5/store', 'storeCatatanBab1')->name('store-catatan-bab-5');
        Route::post('/bimbingan/catatan-6/store', 'storeCatatanBab1')->name('store-catatan-bab-6');
        Route::put('/bimbingan/acc-bab', 'accBab')->name('acc-bab');
    });

    Route::controller(PengajuanController::class)->group(function() {
        Route::get('/pengajuan', 'index')->name('pengajuan');
        Route::get('/pengajuan/get-data', 'getData')->name('get-data');
        Route::put('/pengajuan/acc/{id?}', 'acc')->name('acc');
    });


    });
