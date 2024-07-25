<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function() {

Route::controller(DashboardController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::put('profile', 'updateProfile')->name('profile.update');
    Route::delete('profile', 'deleteProfile')->name('profile.delete');
});
});
