<?php

use Illuminate\Support\Facades\Route;

Route::get('/auditee/dashboard', 'AuditeeController@index')->name('auditee.dashboard');
