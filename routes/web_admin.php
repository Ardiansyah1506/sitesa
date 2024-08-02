<?php

use App\Http\Controllers\Admin\DosenPembimbingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaController;
use App\Http\Controllers\Admin\TesisController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\PengajuanTAController;
use App\Http\Controllers\Admin\AkademikMhsController;

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
        Route::post('ta/updatestatusta', 'updateSelesaiTA')->name('ta.updateSelesaiTa');
        Route::get('ta/gettanggal/{tanggalDaftar?}', 'getTanggalTa')->name('ta.gettanggal');
    });

    Route::controller(PengajuanController::class)->group(function() {
        Route::get('/pengajuan', 'index')->name('pengajuan');
        Route::get('/pengajuan/get-data', 'getData')->name('get-data');
        Route::get('/pengajuan/get-data-detail/{id?}', 'getDataDetail')->name('get-data-detail');
        Route::put('/pengajuan/acc/{id?}', 'acc')->name('acc');
        Route::get('/pengajuan/detail-bimbingan/{id?}', 'detailDosenBimbingan')->name('detail-bimbingan');
    });

    Route::controller(MahasiswaController::class)->group(function() {
        Route::get('/mahasiswa', 'index')->name('mahasiswa');
        Route::get('/mahasiswa/get-data', 'getData')->name('get-data');
        Route::post('/mahasiswa/store', 'tambahMhs')->name('mahasiswa.store');
        Route::get('/mahasiswa/get-data-detail/{id?}', 'getDataDetail')->name('get-mahasiswa-detail');
        Route::get('/mahasiswa/edit/{id?}', 'edit')->name('edit-mhs');
        Route::put('/mahasiswa/update-mhs', 'updateMhs')->name('update-mhs');
        // Route::get('/mahasiswa/detail-bimbingan/{id?}', 'detailDosenBimbingan')->name('detail-bimbingan');
    });

    Route::controller(DosenPembimbingController::class)->group(function() {
        Route::get('/dosen', 'index')->name('dosen.index');
        Route::get('/dosen/get-data', 'getData')->name('dosen.getData');
        Route::get('/dosen/list', 'listDosen')->name('dosen.listDosen');
        Route::get('/dosen/getListDosen', 'getListDosen')->name('dosen.getListData');
        Route::post('/dosen/accDosen', 'accDosen')->name('dosen.accDosen');
        Route::get('/dosen/{nip}/edit' ,'edit')->name('dosen.edit');
        Route::post('/dosen/update-kuota' ,'updateKuota')->name('dosen.updateKuota');   
     });

    Route::controller(AkademikMhsController::class)->group(function() {
        Route::get('/akademik-mhs', 'index')->name('index-akademik-mhs');
        Route::get('/akademik-mhs/get-data', 'getData')->name('get-data-akademik-mhs');
        Route::get('/akademik-mhs/detail/{id?}', 'detailAkademikMhs')->name('detail-akademik-mhs');
        Route::get('/akademik-mhs/ujian-proposal/{nim?}', 'ujianProposal')->name('ujian-proposal');
        Route::get('/akademik-mhs/nota-pembimbing/{nim?}', 'notaPembimbing')->name('nota-pembimbing');
        Route::get('/akademik-mhs/lembar-pengesahan/{nim?}', 'lembarPengesahan')->name('lembar-pengesahan');
    });


});