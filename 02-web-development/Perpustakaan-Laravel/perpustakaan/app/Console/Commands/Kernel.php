<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\KirimPengingatPeminjaman;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        KirimPengingatPeminjaman::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pengingat:kembali')->everyMinute(); // testing

        }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
