<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prodi\DashboardController;

Route::prefix('prodi')->name('prodi.')->group(function() {

Route::controller(DashboardController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::put('profile', 'updateProfile')->name('profile.update');
    Route::delete('profile', 'deleteProfile')->name('profile.delete');
});
});