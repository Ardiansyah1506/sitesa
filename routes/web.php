<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('mhs.index');
});

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');
