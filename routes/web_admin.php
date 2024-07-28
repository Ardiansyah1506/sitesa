<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaController;
use App\Http\Controllers\Admin\TesisController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManajemenUserController;

Route::prefix('admin/')->name('admin.')->group(function() {

    Route::controller(DashboardController::class)->group(function() {
        Route::get('', 'index')->name('index');
        Route::put('profile', 'updateProfile')->name('profile.update');
        Route::delete('profile', 'deleteProfile')->name('profile.delete');
    });

    Route::controller(ManajemenUserController::class)->group(function() {
        Route::get('user', 'index')->name('user.index');
        Route::get('user/getdata', 'getData')->name('user.getdata');
        Route::get('user/edit/{id}','getDataEdit')->name('admin.user.edit');
        Route::post('users/create', 'create')->name('user.create');
        Route::post('user/update/{id}',  'update');
        Route::delete('user/delete/{id}',  'delete');
        Route::get('users/nim', 'getNim')->name('user.nim');
        Route::get('users/nip', 'getNip')->name('user.nip');
    });

    Route::controller(TesisController::class)->group(function() {
        Route::get('tesis', 'index')->name('tesis.index');
        Route::get('/tesis/get', 'getData')->name('tesis.getdata');
    });
    Route::controller(TaController::class)->group(function() {
        Route::get('ta', 'index')->name('ta.index');
        Route::get('ta/get', 'getData')->name('ta.getdata');
        Route::post('ta/updatestatus', 'updateStatus')->name('ta.updatestatus');
        Route::get('ta/gettanggal', [TaController::class, 'getTanggalTa'])->name('ta.gettanggal');
    });
});