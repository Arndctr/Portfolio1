<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        $credentials = ['email' => $this->email, 'password' => $this->password];
        
        if (Auth::guard('admin')->attempt($credentials)) {
            session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        session()->flash('error', 'Email atau password salah');
    }

    public function render()
    {
        return view('livewire.admin.auth.login')
            ->layout('layouts.admin');
    }
}
