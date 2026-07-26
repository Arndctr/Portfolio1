<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Livewire\Volt\Volt;
use App\Http\Controllers\WelcomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Livewire\Pages\Auth\SetupPassword;
use App\Livewire\Pages\Auth\SetupEmailVerify;

// Admin
use App\Livewire\Admin\Dashboard\Index as DashboardIndex;
use App\Livewire\Admin\Anggota\Index as AnggotaIndex;
use App\Livewire\Admin\Anggota\Siswa;
use App\Livewire\Admin\Anggota\Guru;
use App\Livewire\Admin\Buku\Index as BukuIndexAdmin;
use App\Livewire\Admin\Peminjaman\Index as PeminjamanIndex;
use App\Livewire\Admin\Anggota\Export;
use App\Livewire\Admin\Broadcast\Index as BroadcastIndex;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Admin\Profile\Index as ProfileIndex;

// User
use App\Livewire\User\Dashboard\Index as DashboardIndexUser;
use App\Livewire\User\Buku\Index as BukuIndexUser;
use App\Livewire\User\Peminjaman\Index as PeminjamanIndexUser;
use App\Livewire\User\Profile\Index as ProfileIndexUser;



Route::get('/test-email', function () {
    $peminjaman = App\Models\Peminjaman::with(['anggota.user'])->latest()->first();
    Mail::to($peminjaman->anggota->user->email)->send(new App\Mail\PengingatKembaliMail($peminjaman));
    return 'Email test terkirim';
});

// di routes/web.php
Route::get('/cek-waktu', function () {
    return now()->toDateTimeString();
});

// Public welcome
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Auth routes (login, register, forgot password, etc)
require __DIR__.'/auth.php';

// ===== SETUP ACCOUNT FLOW UNTUK SISWA/GURU =====
Route::middleware(['auth'])->group(function () {

    // Step 1: Ganti password
    Route::get('/setup-password', SetupPassword::class)->name('setup.password');

    // Step 2: Verifikasi email
    Route::get('/setup-verify-email', SetupEmailVerify::class)->name('setup.verify-email');

    // Tangani klik link verifikasi dari email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('user.dashboard');
    })->middleware(['signed'])->name('verification.verify');

    // Kirim ulang email verifikasi
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim!');
    })->middleware(['throttle:6,1'])->name('verification.send');
    
});

// Admin routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard-admin', DashboardIndex::class)->name('admin.dashboard');
    Route::get('/anggota', AnggotaIndex::class)->name('admin.anggota.index');
    Route::get('/anggota/export/siswa', fn() => Excel::download(new Export('siswa'), 'daftar_siswa.xlsx'))->name('export.siswa');
    Route::get('/anggota/export/guru', fn() => Excel::download(new Export('guru'), 'daftar_guru.xlsx'))->name('export.guru');
    Route::get('/anggota/siswa', Siswa::class)->name('anggota.siswa');
    Route::get('/anggota/guru', Guru::class)->name('anggota.guru');
    Route::get('/buku', BukuIndexAdmin::class)->name('admin.buku.index');
    Route::get('/peminjaman', PeminjamanIndex::class)->name('admin.peminjaman.index');
    Route::get('/broadcast', BroadcastIndex::class)->name('admin.broadcast.index');
    Route::get('/profile', ProfileIndex::class)->name('admin.profile');
});

// User routes
Route::middleware(['auth', 'role:siswa,guru', 'check.default.password', 'ensure.email.verified'])
    ->group(function () {
        Route::get('/dashboard', DashboardIndexUser::class)->name('user.dashboard');
        Route::get('/buku', BukuIndexUser::class)->name('user.buku.index');
        Route::get('/peminjaman', PeminjamanIndexUser::class)->name('user.peminjaman.index');
        Route::get('/profile', ProfileIndexUser::class)->name('user.profile');
});



Route::get('/test-email-brevo', function () {
    Mail::raw('Tes email via Brevo SMTP', function ($message) {
        $message->to('roynashruddin18@gmail.com') // ganti dengan email tujuanmu
                ->subject('Tes dari Laravel + Brevo');
    });

    return 'Email sedang dikirim...';
});

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {Auth::logout(); request()->session()->invalidate(); request()->session()->regenerateToken(); return redirect('/');
})->name('logout');