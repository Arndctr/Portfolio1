<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use App\Models\User;

class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $nis_nip = '';

    #[Validate('required|string|min:8')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    public function authenticate(): array
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('nis_nip', $this->nis_nip)->first();

        if (!$user || !Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.nis_nip' => 'NIS/NIP atau password salah.',
            ]);
        }

        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'form.nis_nip' => 'Akun Anda tidak aktif.',
            ]);
        }

        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());

        // ✅ Whitelist akun seeder (bisa pakai email atau nis_nip)
        $whitelisted = [
            'guru@example.com',
            'siswa@example.com',
            // atau pakai nis_nip:
            '198506012023051002',
            '2023123456',
        ];

        $bypassPassword = in_array($user->email, $whitelisted) || in_array($user->nis_nip, $whitelisted);

        return [
            'should_change_password' => $bypassPassword ? false : $user->is_default_password,
            'role' => $user->getRoleNames()->first()
        ];
    }


    protected function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.nis_nip' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->nis_nip) . '|' . request()->ip());
    }
}
