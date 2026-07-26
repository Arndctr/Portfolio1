<?php
namespace App\Livewire\Landing;

use Livewire\Component;

class Alur extends Component
{
    public function render()
    {
        return view('livewire.landing.alur')
            ->layout('layouts.landing');
    }
}