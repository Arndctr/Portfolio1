<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use App\Models\User;
use App\Mail\BroadcastMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BroadcastController extends Controller
{
    public function index()
    {
        $broadcasts = Broadcast::all();
        return view('pages.broadcast.index', compact('broadcasts'));
    }

    public function create()
    {
        return view('pages.broadcast.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        // Simpan ke database
        $broadcast = Broadcast::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
        ]);

        // Kirim ke semua user
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new BroadcastMail($validated['judul'], $validated['isi']));
        }

        return redirect()->route('broadcast.index')->with('message', 'Broadcast berhasil dikirim ke semua pengguna.');
    }
}
