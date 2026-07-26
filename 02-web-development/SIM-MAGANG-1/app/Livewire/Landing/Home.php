<?php

namespace App\Livewire\Landing;

use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Home extends Component
{
    private const CACHE_KEY = 'landing.home.batch-data';
    private const CACHE_TTL = 600;

    public $activeBatch;
    public $currentBatch;
    public $upcomingBatch;
    public $expiredBatch;
    public $registrationStatus = 'closed';

    public function mount()
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $today = Carbon::today();
            $currentBatch = Batch::with('divisi')->withCount('peserta')->active()->first();
            $activeBatch = $currentBatch && !$currentBatch->isQuotaFull()
                ? $currentBatch
                : null;
            $upcomingBatch = null;
            $registrationStatus = 'closed';

            if ($activeBatch) {
                $registrationStatus = 'open';
            } elseif ($currentBatch && $currentBatch->isQuotaFull()) {
                $registrationStatus = 'quota_full';
            } elseif (!$currentBatch) {
                $upcomingBatch = Batch::where('tanggal_mulai', '>', $today)
                    ->orderBy('tanggal_mulai', 'asc')
                    ->first();

                if ($upcomingBatch) {
                    $registrationStatus = 'upcoming';
                }
            }

            return [
                'activeBatch' => $activeBatch,
                'currentBatch' => $currentBatch,
                'upcomingBatch' => $upcomingBatch,
                'registrationStatus' => $registrationStatus,
            ];
        });

        $this->activeBatch = $data['activeBatch'];
        $this->currentBatch = $data['currentBatch'];
        $this->upcomingBatch = $data['upcomingBatch'];
        $this->registrationStatus = $data['registrationStatus'];
    }

    public function render()
    {
        $batch = $this->activeBatch ?? $this->currentBatch ?? $this->upcomingBatch ?? null;

        return view('livewire.landing.home', [
            'batch' => $batch,
            'status' => $this->registrationStatus,
        ])->layout('layouts.landing');
    }
}
