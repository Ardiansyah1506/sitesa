<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/process-login', [AuthController::class, 'login'])->name('process-login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['roleAccess:1'])->group(function () {
    @include_once('web_admin.php'); 
});

Route::middleware(['roleAccess:2'])->group(function () {
    @include_once('web_prodi.php'); 
});

Route::middleware(['roleAccess:3'])->group(function () {
    @include_once('web_dosbim.php'); 
});

Route::middleware(['roleAccess:4'])->group(function () {
    @include_once('web_mhs.php'); 
});