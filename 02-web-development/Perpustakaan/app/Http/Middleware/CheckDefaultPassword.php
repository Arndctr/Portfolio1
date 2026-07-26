<?php

namespace App\Http\Middleware;

use Closure;

class CheckDefaultPassword
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // ✅ Bypass untuk akun seeder
        $whitelistedEmails = [
            'guru@example.com',
            'siswa@example.com',
        ];

        if (in_array($user->email, $whitelistedEmails)) {
            return $next($request); // Lewati pengecekan
        }

        // Cek relasi anggota
        $user->loadMissing('anggota');

        if (!$user->anggota) {
            \Log::warning('User tanpa anggota: '.$user->id);
            return redirect()->route('setup.password');
        }

        // Cek apakah plain_password masih ada
        if ($user->anggota->plain_password !== null && $user->anggota->plain_password !== '') {
            return redirect()->route('setup.password');
        }

        return $next($request);
    }
}
