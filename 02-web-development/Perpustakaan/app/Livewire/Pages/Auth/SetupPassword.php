<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class SetupPassword extends Component
{
    public $new_password;
    public $confirm_password;
    public $message = '';

    public function updatePassword()
    {
        $this->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'same:new_password',
        ]);

        $user = auth()->user();
        $user->is_default_password = false;
        $user->password = Hash::make($this->new_password);
        $user->save();

        // Kosongkan kolom plain_password di tabel anggota
        if ($user->anggota) {
            $user->anggota->update([
                'plain_password' => null,
            ]);
        }

        return redirect()->route('setup.verify-email')->with('success', 'Password berhasil diubah. Silakan untuk verifikasi email.');
    }


    public function render()
    {
        return view('livewire.pages.auth.setup-password')->layout('layouts.guest');
    }
}
