<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Cek apakah akun ini dari seeder (berdasarkan email atau nis_nip)
        $whitelistedSeederEmails = [
            'admin_perpustakaan@smp12yk.sch.id',
            'guru@example.com',
            'siswa@example.com',
        ];

        if (in_array($user->email, $whitelistedSeederEmails)) {
            // Redirect ke dashboard sesuai peran
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // User non-seeder → ikuti prosedur lengkap
        if ($user->is_default_password) {
            return redirect()->route('setup.password');
        }

        if (! $user->hasVerifiedEmail()) {
            return redirect()->route('setup.verify-email');
        }

        // Setelah lolos validasi
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('guru') || $user->hasRole('siswa')) {
            return redirect()->route('user.dashboard');
        }

        abort(403, 'Unauthorized. You do not have the required role.');
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
