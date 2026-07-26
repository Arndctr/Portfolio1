<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SetupEmailVerify extends Component
{
    public $email;
    public $message = '';

    public function mount()
    {
        $this->email = Auth::user()->email;
    }

    public function resendVerificationEmail()
    {
        $user = Auth::user();

        $this->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($user) {
            // Update email user jika berbeda
            if ($user->email !== $this->email) {
                $user->email = $this->email;
                $user->email_verified_at = null; // reset status verified
                $user->save();
            }

            if (!$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
                $this->message = 'Link verifikasi telah dikirim ulang ke email Anda.';
            } else {
                $this->message = 'Email sudah diverifikasi.';
            }
        } else {
            $this->message = 'User tidak ditemukan.';
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.setup-email-verify')->layout('layouts.guest');
    }
}
