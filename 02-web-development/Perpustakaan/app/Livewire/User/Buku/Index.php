<?php

namespace App\Livewire\User\Buku;

use App\Models\Buku;
use Livewire\Component;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;


class Index extends Component
{
    public $books = [];
    public $search = '';
    public $kategori = 'semua';
    public $kategoriList = [];
    public $sortField = 'judul';
    public $sortDirection = 'asc';
    public $bookId;

    public function mount()
    {
        $this->kategoriList = Buku::select('kategori')->distinct()->pluck('kategori')->toArray();
        $this->loadBooks();
    }

    public function updatedSearch()
    {
        $this->loadBooks();
    }

    public function updatedKategori()
    { 
        $this->loadBooks();
    }
    

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->loadBooks();
    }

    public function loadBooks()
    {
        $query = Buku::query();

        if ($this->kategori !== 'semua') {
            $query->where('kategori', $this->kategori);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('penulis', 'like', '%' . $this->search . '%')
                  ->orWhere('penerbit', 'like', '%' . $this->search . '%')
                  ->orWhere('isbn', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);
        $this->books = $query->get();
    }

    public function pinjam($bookId)
    {
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk meminjam buku.');
            return;
        }

        // Ambil anggota berdasarkan relasi nis_nip
        $anggota = $user->anggota; // Relasi sudah kita definisikan: hasOne(Anggota::class, 'nis_nip', 'nis_nip')

        if (!$anggota) {
            session()->flash('error', 'Profil anggota tidak ditemukan.');
            return;
        }

        $book = Buku::find($bookId);

        if ($book && $book->jumlah_stok > 0) {
            // Kurangi stok buku
            $book->jumlah_stok -= 1;
            $book->save();

            $tanggalPinjam = now();
        

            // Cek apakah anggota punya NIP atau NIS
            if (!empty($anggota->nip)) {
                $lamaPeminjaman = 14; // Dosen/staf
            } elseif (!empty($anggota->nis)) {
                $lamaPeminjaman = 7;  // Siswa
            } else {
                session()->flash('error', 'Data NIP/NIS tidak ditemukan.');
                return;
            }

            $tanggalKembali = $tanggalPinjam->copy()->addDays($lamaPeminjaman); 


            Peminjaman::create([
                'anggota_id' => $anggota->id,
                'buku_id' => $book->id,
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_kembali' => $tanggalKembali,
                'status' => 'booking',
            ]);


            session()->flash('message', 'Berhasil meminjam buku: ' . $book->judul);
            $this->loadBooks();
            // return redirect()->to('peminjaman');
             // kalau kamu punya method untuk reload data buku
        } else {
            session()->flash('error', 'Stok buku tidak cukup.');
        }
    }

    public function render()
    {
        return view('livewire.user.buku.index')
            ->layout('layouts.user'); 
    }
}
