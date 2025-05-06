<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\GuruAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Guru\DashboardGuruController;
use App\Http\Controllers\Admin\DashboardAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'guru/login');


Route::middleware('admin.guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('post.admin.login');
});

Route::middleware('guru.guest')->group(function () {
    Route::get('/guru/login', [GuruAuthController::class, 'showLoginForm'])->name('guru.login');
    Route::post('/guru/login', [GuruAuthController::class, 'login']);
});

// Dashboard
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/guru', [App\Http\Controllers\Admin\GuruController::class, 'index'])->name('admin.guru.index');
});

Route::middleware('auth:guru')->group(function () {
    Route::get('/guru/dashboard', [DashboardGuruController::class, 'index'])->name('guru.dashboard');
    Route::post('/guru/logout', [GuruAuthController::class, 'logout'])->name('guru.logout');
});


Route::prefix('admin')
    ->middleware('auth:admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('guru', App\Http\Controllers\Admin\GuruController::class);
        Route::get('/guru/excel/import', [App\Http\Controllers\Admin\GuruController::class, 'ViewImport'])->name('guru.import.view');
        Route::post('/guru/data/import', [App\Http\Controllers\Admin\GuruController::class, 'import'])->name('guru.import');
        Route::resource('peserta-didik', App\Http\Controllers\Admin\PesertaDidikController::class);
        Route::get('/peserta-didik/excel/import', [App\Http\Controllers\Admin\PesertaDidikController::class, 'ViewImport'])->name('peserta-didik.import.view');
        Route::post('/peserta-didik/data/import', [App\Http\Controllers\Admin\PesertaDidikController::class, 'import'])->name('peserta-didik.import');
        Route::resource('kelas', \App\Http\Controllers\Admin\KelasController::class);
        Route::resource('muatan-pelajaran', App\Http\Controllers\Admin\MuatanPelajaranController::class);
        Route::get('profile', [\App\Http\Controllers\Admin\PengaturanController::class, 'editProfile'])->name('profile.edit');
        Route::post('profile', [\App\Http\Controllers\Admin\PengaturanController::class, 'updateProfile'])->name('profile.update');

    });

    Route::prefix('guru')
    ->middleware('auth:guru')
    ->name('guru.')
    ->group(function () {
        Route::resource('nilai', \App\Http\Controllers\Guru\NilaiController::class);
        Route::resource('eraport', \App\Http\Controllers\Guru\EraportController::class);
        Route::get('cetak-eraport', [\App\Http\Controllers\Guru\EraportCetakController::class,'index'])->name('cetak.eraport');
        Route::get('cetak-eraport/detail/{id}', [\App\Http\Controllers\Guru\EraportCetakController::class, 'detail'])->name('eraport.detail');
        Route::get('cetak-eraport/print/{id}', [\App\Http\Controllers\Guru\EraportCetakController::class, 'cetakPdf'])->name('eraport.print');

        Route::get('profile', [\App\Http\Controllers\Guru\PengaturanController::class, 'editProfile'])->name('profile.edit');
        Route::post('profile', [\App\Http\Controllers\Guru\PengaturanController::class, 'updateProfile'])->name('profile.update');
    });


include __DIR__.'/auth.php';
include __DIR__.'/my.php';
