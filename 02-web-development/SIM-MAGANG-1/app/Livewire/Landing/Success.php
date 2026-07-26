<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\Batch;

class Success extends Component
{
    public $activeBatch;

    public function mount()
    {
        $this->activeBatch = Batch::active()->first();
    }

    public function render()
    {
        return view('livewire.landing.success')->layout('layouts.landing');
    }
}
