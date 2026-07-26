<?php

namespace App\Livewire\Admin\Buku;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $judul, $kategori, $penulis, $penerbit, $tahun_terbit, $isbn, $cover, $deskripsi, $jumlah_stok, $lokasi_rak;
    public $bukuId;
    public $existingCover;

    public $isEdit = false;
    public $showModal = false;

    public $search = '';
    public $filterKategori = 'semua';
    public $filterTahun = 'semua';
    public $sortField = 'judul';
    public $sortDirection = 'asc';

    public $kategoriList = [];
    public $tahunList = [];

    public function mount()
    {
        $this->kategoriList = Buku::select('kategori')->distinct()->pluck('kategori')->toArray();
        $this->tahunList = Buku::select('tahun_terbit')->distinct()->orderBy('tahun_terbit', 'desc')->pluck('tahun_terbit')->toArray();
    }

    private function loadKategoriList()
    {
        $this->kategoriList = Buku::select('kategori')->distinct()->pluck('kategori')->toArray();
    }


    public function render()
    {
        $query = Buku::query();

        // Filter berdasarkan kategori
        if ($this->filterKategori !== 'semua') {
            $query->where('kategori', $this->filterKategori);
        }

        // Filter berdasarkan tahun
        if ($this->filterTahun !== 'semua') {
            $query->where('tahun_terbit', $this->filterTahun);
        }

        // Filter berdasarkan pencarian
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('penulis', 'like', '%' . $this->search . '%')
                  ->orWhere('penerbit', 'like', '%' . $this->search . '%')
                  ->orWhere('isbn', 'like', '%' . $this->search . '%');
            });
        }

        // Sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.admin.buku.index', [
            'buku' => $query->get(),
        ])->layout('layouts.app');
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEdit = false;
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    public function store()
    {
        $this->validateData();

        $coverPath = null;
        if ($this->cover) {
            $coverPath = $this->cover->store('covers', 'public');
        }

        Buku::create([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'deskripsi' => $this->deskripsi,
            'jumlah_stok' => $this->jumlah_stok,
            'lokasi_rak' => $this->lokasi_rak,
            'cover' => $coverPath,
        ]);

        $this->loadKategoriList();
        $this->mount();

        session()->flash('message', 'Buku berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        $this->bukuId = $buku->id;
        $this->judul = $buku->judul;
        $this->kategori = $buku->kategori;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->isbn = $buku->isbn;
        $this->deskripsi = $buku->deskripsi;
        $this->jumlah_stok = $buku->jumlah_stok;
        $this->lokasi_rak = $buku->lokasi_rak;
        $this->existingCover = $buku->cover;
        $this->cover = null;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validateData();

        $buku = Buku::findOrFail($this->bukuId);
        $coverPath = $buku->cover;

        if ($this->cover) {
            if ($coverPath) {
                Storage::disk('public')->delete($coverPath);
            }
            $coverPath = $this->cover->store('covers', 'public');
        }

        $buku->update([
            'judul' => $this->judul,
            'kategori' => $this->kategori,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_terbit' => $this->tahun_terbit,
            'isbn' => $this->isbn,
            'deskripsi' => $this->deskripsi,
            'jumlah_stok' => $this->jumlah_stok,
            'lokasi_rak' => $this->lokasi_rak,
            'cover' => $coverPath,
        ]);

        session()->flash('message', 'Buku berhasil diperbarui!');
        $this->closeModal();
    }

    public function delete($id)
    {
        $buku = Buku::findOrFail($id);
        if ($buku->cover) {
            Storage::disk('public')->delete($buku->cover);
        }
        $buku->delete();

        session()->flash('message', 'Buku berhasil dihapus!');
    }

    private function validateData()
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer',
            'isbn' => 'required|string|max:20',
            'deskripsi' => 'nullable|string|max:1000',
            'jumlah_stok' => 'required|integer|min:0',
            'lokasi_rak' => 'required|string|max:50',
        ];

        if ($this->isEdit) {
            // Hanya validasi cover jika ada input baru
            if ($this->cover) {
                $rules['cover'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
            }
        } else {
            // Tambah data: wajib upload cover
            $rules['cover'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        $this->validate($rules);
    }

    private function resetForm()
    {
        $this->judul = '';
        $this->kategori = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->tahun_terbit = '';
        $this->isbn = '';
        $this->deskripsi = '';
        $this->jumlah_stok = '';
        $this->lokasi_rak = '';
        $this->cover = null;
        $this->bukuId = null;
        $this->isEdit = false;
        $this->showModal = false;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
}
