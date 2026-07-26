<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        if (!$anggota) {
            return redirect()->back()->with('error', 'Profil anggota tidak ditemukan.');
        }

        $peminjaman = Peminjaman::with('buku')
            ->where('anggota_id', $anggota->id)
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }
}
