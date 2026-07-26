<?php
namespace App\Livewire\Landing;

use Livewire\Component;

class Informasi extends Component
{
    public function render()
    {
        return view('livewire.landing.informasi')
            ->layout('layouts.landing');
    }
}