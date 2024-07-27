<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaController;
use App\Http\Controllers\Admin\TesisController;
use App\Http\Controllers\Admin\DashboardController;

Route::prefix('admin')->name('admin.')->group(function() {

    Route::controller(DashboardController::class)->group(function() {
        Route::get('/', 'index')->name('index');
        Route::put('profile', 'updateProfile')->name('profile.update');
        Route::delete('profile', 'deleteProfile')->name('profile.delete');
    });
    Route::controller(TesisController::class)->group(function() {
        Route::get('/tesis', 'index')->name('tesis.index');
        Route::get('/tesis/get', 'getData')->name('tesis.getdata');
    });
    Route::controller(TaController::class)->group(function() {
        Route::get('/ta', 'index')->name('ta.index');
        Route::get('/ta/get', 'getData')->name('ta.getdata');
        Route::post('/ta/updatestatus', 'updateStatus')->name('ta.updatestatus');
        Route::get('/ta/gettanggal', [TaController::class, 'getTanggalTa'])->name('ta.gettanggal');
    });
});