<?php

namespace App\Livewire\Admin\Broadcast;

use Livewire\Component;
use App\Models\Broadcast;
use App\Models\User;
use App\Mail\BroadcastMail;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    public $judul, $isi;

    protected $rules = [
        'judul' => 'required',
        'isi' => 'required',
    ];

    public function store()
    {
        $this->validate();

        // Simpan ke database
        Broadcast::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
        ]);

        // Kirim email ke semua user yang punya email
        $users = User::whereNotNull('email')->where('email', '!=', '')->get();
        foreach ($users as $user) {
            // Mail::to($user->email)->queue(new BroadcastMail($this->judul, $this->isi));
            Mail::to($user->email)->send(new BroadcastMail($this->judul, $this->isi));
        }

        // Reset form
        $this->reset();

        // Flash message suksesA
        session()->flash('message', 'Broadcast berhasil dikirim ke semua pengguna.');
    }

    public function render()
    {
        return view('livewire.admin.broadcast.index', [
            'broadcast' => Broadcast::latest()->get()
        ]);
    }
}
