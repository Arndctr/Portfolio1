<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailVerified
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // ✅ Bypass verifikasi email untuk akun seeder
        $whitelistedEmails = [
            'guru@example.com',
            'siswa@example.com',
        ];

        if ($user && in_array($user->email, $whitelistedEmails)) {
            return $next($request); // Langsung lolos
        }

        // Cek email terverifikasi
        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->route('setup.verify-email');
        }

        return $next($request);
    }
}
