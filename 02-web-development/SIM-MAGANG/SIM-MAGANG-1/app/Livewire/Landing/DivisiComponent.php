<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\Batch;
use App\Models\Divisi;

class DivisiComponent extends Component
{
    public $divisis;

    public function mount()
    {
        $activeBatch = Batch::with('divisi')->active()->first();
        if ($activeBatch) {
            $this->divisis = $activeBatch->divisi;
        } else {
            $this->divisis = collect();
        }
    }

    public function render()
    {
        return view('livewire.landing.divisi')->layout('layouts.landing');
    }
}
