<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Pengunjung;

class RecordPengunjungListener
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // Catat pengunjung ke tabel pengunjung
        Pengunjung::create([
            'user_id' => $event->user->id,
            'tanggal' => now(),
        ]);
    }
}


