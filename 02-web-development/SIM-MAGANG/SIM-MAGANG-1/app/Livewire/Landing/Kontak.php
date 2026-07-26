<?php
namespace App\Livewire\Landing;

use Livewire\Component;

class Kontak extends Component
{
    public function render()
    {
        return view('livewire.landing.kontak')
            ->layout('layouts.landing');
    }
}