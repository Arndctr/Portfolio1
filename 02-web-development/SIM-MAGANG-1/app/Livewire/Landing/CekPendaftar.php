<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\Batch;
use App\Models\Peserta;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;

class CekPendaftar extends Component
{
    use WithPagination;

    private const ACTIVE_BATCH_CACHE_KEY = 'landing.active-batch';
    private const ACTIVE_BATCH_CACHE_TTL = 600;

    public $limit = null; // Default to null for full page
    protected $paginationTheme = 'tailwind';

    public function mount($limit = null)
    {
        $this->limit = $limit;
    }

    public function render()
    {
        $activeBatch = Cache::remember(self::ACTIVE_BATCH_CACHE_KEY, self::ACTIVE_BATCH_CACHE_TTL, function () {
            return Batch::active()->first();
        });
        
        $peserta = collect();
        if ($activeBatch) {
            $query = Peserta::where('batch_id', $activeBatch->id)
                ->select(['id', 'nama', 'prodi', 'universitas', 'created_at'])
                ->orderBy('created_at', 'desc');
            
            if ($this->limit) {
                $peserta = $query->limit($this->limit)->get();
            } else {
                $peserta = $query->paginate(25);
            }
        }

        return view('livewire.landing.cek-pendaftar', [
            'activeBatch' => $activeBatch,
            'peserta' => $peserta
        ])->layout('layouts.landing');
    }
}
