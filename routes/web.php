<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('mhs.index');
});

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
