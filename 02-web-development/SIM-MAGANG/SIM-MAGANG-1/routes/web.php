<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Public Landing Pages
|--------------------------------------------------------------------------
*/

use App\Livewire\Landing\Daftar;
use App\Livewire\Landing\CekPendaftar;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\PageController;

Route::get('/', HomeController::class)->name('home');
Route::get('/informasi', [PageController::class, 'informasi'])->name('informasi');
Route::get('/alur', [PageController::class, 'alur'])->name('alur');
Route::get('/divisi', [PageController::class, 'divisi'])->name('divisi');
Route::get('/daftar', Daftar::class)->name('daftar');
Route::get('/daftar/success', [PageController::class, 'success'])->name('daftar.success');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::get('/cek-pendaftar', CekPendaftar::class)->name('cek-pendaftar');


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

use App\Livewire\Admin\Auth\Login;

Route::get('/admin/login', Login::class)->name('admin.login');


/*
|--------------------------------------------------------------------------
| Admin Area (Protected)
|--------------------------------------------------------------------------
*/

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Batch\Index as BatchIndex;
use App\Livewire\Admin\Peserta\Index as PesertaIndex;
use App\Livewire\Admin\Peserta\Detail as PesertaDetail;
use App\Http\Controllers\Admin\ExportController;


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {

    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Batch
    Route::get('/batch', BatchIndex::class)->name('batch.index');

    // Peserta
    Route::get('/peserta', PesertaIndex::class)->name('peserta.index');
    Route::get('/peserta/{id}', PesertaDetail::class)->name('peserta.detail');
    

    // Export
    Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export.excel');

});
