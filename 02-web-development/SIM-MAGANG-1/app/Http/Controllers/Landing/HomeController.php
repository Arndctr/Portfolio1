<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private const CACHE_KEY = 'landing.home.batch-data';
    private const CACHE_TTL = 600;

    public function __invoke()
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

        return view('landing.home', [
            'batch' => $data['activeBatch'] ?? $data['currentBatch'] ?? $data['upcomingBatch'] ?? null,
            'status' => $data['registrationStatus'],
        ]);
    }
}
