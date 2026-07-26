<?php

namespace App\Livewire\Admin\Batch;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Batch;
use App\Models\Divisi;
use Illuminate\Support\Facades\Cache;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $nama_batch, $tanggal_mulai, $tanggal_selesai, $tanggal_admin_mulai, $tanggal_admin_selesai, $tanggal_wawancara_mulai, $tanggal_wawancara_selesai, $tanggal_pengumuman, $kuota, $batch_id;
    public $selectedDivisi = [];
    public $isEdit = false;
    public $showModal = false;

    protected $rules = [
        'nama_batch' => 'required|string|max:255',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'tanggal_admin_mulai' => 'nullable|date',
        'tanggal_admin_selesai' => 'nullable|date|after_or_equal:tanggal_admin_mulai',
        'tanggal_wawancara_mulai' => 'nullable|date',
        'tanggal_wawancara_selesai' => 'nullable|date|after_or_equal:tanggal_wawancara_mulai',
        'tanggal_pengumuman' => 'nullable|date',
        'kuota' => 'nullable|integer|min:1',
        'selectedDivisi' => 'array',
        'selectedDivisi.*' => 'exists:divisi,id',
    ];

    public function render()
    {
        return view('livewire.admin.batch.index', [
            'batches' => Batch::with('divisi')->withCount('peserta')->orderBy('created_at', 'desc')->paginate(10),
            'divisiList' => Cache::remember('admin.divisi-list', 600, fn () => Divisi::orderBy('nama')->get())
        ])->layout('layouts.admin');
    }

    public function resetFields()
    {
        $this->nama_batch = '';
        $this->tanggal_mulai = '';
        $this->tanggal_selesai = '';
        $this->tanggal_admin_mulai = '';
        $this->tanggal_admin_selesai = '';
        $this->tanggal_wawancara_mulai = '';
        $this->tanggal_wawancara_selesai = '';
        $this->tanggal_pengumuman = '';
        $this->kuota = '';
        $this->batch_id = null;
        $this->selectedDivisi = [];
        $this->isEdit = false;
    }

    public function openCreateModal()
    {
        $this->resetFields();
        $this->resetValidation();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetFields();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        $batch = Batch::create([
            'nama_batch' => $this->nama_batch,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'tanggal_admin_mulai' => $this->tanggal_admin_mulai,
            'tanggal_admin_selesai' => $this->tanggal_admin_selesai,
            'tanggal_wawancara_mulai' => $this->tanggal_wawancara_mulai,
            'tanggal_wawancara_selesai' => $this->tanggal_wawancara_selesai,
            'tanggal_pengumuman' => $this->tanggal_pengumuman,
            'kuota' => $this->kuota,
        ]);

        $batch->divisi()->sync($this->selectedDivisi);
        Cache::forget('landing.daftar.batch-data');
        Cache::forget('landing.home.batch-data');
        Cache::forget('landing.active-batch');
        Cache::forget('admin.batch-list');

        session()->flash('success', 'Batch berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $batch = Batch::with('divisi')->findOrFail($id);

        $this->batch_id = $id;
        $this->nama_batch = $batch->nama_batch;
        $this->tanggal_mulai = $batch->tanggal_mulai?->format('Y-m-d');
        $this->tanggal_selesai = $batch->tanggal_selesai?->format('Y-m-d');
        $this->tanggal_admin_mulai = $batch->tanggal_admin_mulai?->format('Y-m-d');
        $this->tanggal_admin_selesai = $batch->tanggal_admin_selesai?->format('Y-m-d');
        $this->tanggal_wawancara_mulai = $batch->tanggal_wawancara_mulai?->format('Y-m-d');
        $this->tanggal_wawancara_selesai = $batch->tanggal_wawancara_selesai?->format('Y-m-d');
        $this->tanggal_pengumuman = $batch->tanggal_pengumuman?->format('Y-m-d');
        $this->kuota = $batch->kuota;
        $this->selectedDivisi = $batch->divisi->pluck('id')->toArray();
        $this->isEdit = true;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $batch = Batch::findOrFail($this->batch_id);

        $batch->update([
            'nama_batch' => $this->nama_batch,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'tanggal_admin_mulai' => $this->tanggal_admin_mulai,
            'tanggal_admin_selesai' => $this->tanggal_admin_selesai,
            'tanggal_wawancara_mulai' => $this->tanggal_wawancara_mulai,
            'tanggal_wawancara_selesai' => $this->tanggal_wawancara_selesai,
            'tanggal_pengumuman' => $this->tanggal_pengumuman,
            'kuota' => $this->kuota,
        ]);

        $batch->divisi()->sync($this->selectedDivisi);
        Cache::forget('landing.daftar.batch-data');
        Cache::forget('landing.home.batch-data');
        Cache::forget('landing.active-batch');
        Cache::forget('admin.batch-list');

        session()->flash('success', 'Batch berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $batch = Batch::findOrFail($id);
        
        if ($batch->peserta()->count() > 0) {
            session()->flash('error', 'Batch tidak dapat dihapus karena sudah memiliki pendaftar.');
            return;
        }

        $batch->delete();
        Cache::forget('landing.daftar.batch-data');
        Cache::forget('landing.home.batch-data');
        Cache::forget('landing.active-batch');
        Cache::forget('admin.batch-list');
        session()->flash('success', 'Batch berhasil dihapus.');
    }
}
