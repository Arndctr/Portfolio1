<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Pengunjung;

class UserObserver
{
    public function loggedIn(User $user)
    {
        // Catat pengunjung setelah login
        Pengunjung::create([
            'user_id' => $user->id,
            'tanggal' => now(),
        ]);
    }
}
