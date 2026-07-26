<?php

namespace App\Livewire\User\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Index extends Component
{
    public $peminjaman, $anggota_id, $nis_nip, $buku_id, $tanggal_pinjam, $tanggal_kembali;
    public $isEdit = false, $showModal = false;
    public $peminjamanId = null;
    public $status;
    public $anggota, $buku;

    protected $rules = [
        'anggota_id' => 'required|integer',
        // 'nis_nip' => 'required|integer',
        'buku_id' => 'required|integer',
        'tanggal_pinjam' => 'required|date',
        'status' => 'required|in:booking,dipinjam,dikembalikan',

    ];

    public function openModal()
    {
        $this->resetForm();
         // default setiap buka modal
        $this->showModal = true;
        $this->isEdit = false;
    }


    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['anggota_id', 'nis_nip', 'buku_id', 'tanggal_pinjam', 'tanggal_kembali', 'peminjamanId','status']); // set default setiap form dibuka
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        $tanggalPinjam = Carbon::parse($this->tanggal_pinjam);

        $anggota = Anggota::find($this->anggota_id);

        if (!$anggota) {
            session()->flash('error', 'Data anggota tidak ditemukan.');
            return;
        }

        if (isset($anggota->nip) && trim($anggota->nip) !== '') {
        $lama_peminjaman = 14;
        } elseif (isset($anggota->nis) && trim($anggota->nis) !== '') {
            $lama_peminjaman = 7;
        } else {
            session()->flash('error', 'Anggota tidak memiliki NIS atau NIP.');
            return;
        }

        $tanggalKembali = $tanggalPinjam->copy()->addDays($lama_peminjaman);

        // Optional: dump untuk debugging
        // dd($tanggalPinjam, $tanggalKembali, $lama_peminjaman);

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $this->buku_id,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_kembali' => $tanggalKembali,
            'status' => 'booking',
        ]);

        session()->flash('success', 'Peminjaman berhasil dibuat.');
        $this->closeModal();
    }

    public function render()
    {
        $user = Auth::user();
        $anggotaId = $user->anggota->id ?? null;

        return view('livewire.user.peminjaman.index', [
            'listPeminjaman' => Peminjaman::with(['anggota', 'buku'])
                ->where('anggota_id', $anggotaId)
                ->latest()
                ->get(),
            'anggotaList' => Anggota::all(),
            'bukuList' => Buku::all(),
        ])->layout('layouts.user');
    }

    

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

}
