<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peminjaman;
use App\Mail\PengingatKembaliMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class KirimPengingatPeminjaman extends Command
{
    protected $signature = 'pengingat:kembali';
    protected $description = 'Kirim email pengingat H-3 ke pengguna yang meminjam buku';

    public function handle()
    {
        $targetDate = Carbon::now()->addDays(3)->toDateString();

        $peminjamanList = Peminjaman::with(['anggota.user', 'buku'])
            ->where('status', 'dipinjam')
            ->whereDate('tanggal_kembali', $targetDate)
            ->get();

        $count = 0;

        foreach ($peminjamanList as $peminjaman) {
            $user = $peminjaman->anggota->user;
            if ($user && $user->email) {
                try {
                    Mail::to($user->email)->send(new PengingatKembaliMail($peminjaman));
                    $count++;
                } catch (\Exception $e) {
                    \Log::error("Gagal kirim email ke {$user->email}: " . $e->getMessage());
                }
            }
        }

        $this->info("Pengingat dikirim ke {$count} pengguna.");
    }
}
