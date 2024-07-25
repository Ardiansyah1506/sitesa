<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('mhs.index');
});

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['roleAccess:admin'])->group(function () {
    include_once('web_admin.php'); 
});

Route::middleware(['roleAccess:auditor'])->group(function () {
    include_once('web_progdi.php'); 
});

Route::middleware(['roleAccess:auditee'])->group(function () {
    include_once('web_dosbim.php'); 
});

Route::middleware(['roleAccess:auditee'])->group(function () {
    include_once('web_mhs.php'); 
});

// Tambahkan rute umum lainnya di sini
Route::post('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'logout'])->name('logout');