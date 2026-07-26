<?php

namespace App\Livewire\Admin\Peserta;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Peserta;
use App\Models\Divisi;
use App\Models\Batch;
use Illuminate\Support\Facades\Cache;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterDivisi = '';
    public $filterStatus = '';
    public $filterBatch = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $isBatchSelected = false;

    protected $paginationTheme = 'tailwind';
    protected $queryString = ['search', 'filterDivisi', 'filterStatus', 'filterBatch', 'sortField', 'sortDirection'];

    public function mount()
    {
        if ($this->filterBatch) {
            $this->isBatchSelected = true;
        }
    }

    public function updatedFilterBatch($value)
    {
        if ($value !== '') {
            $this->isBatchSelected = true;
        } else {
            $this->isBatchSelected = false;
        }
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function render()
    {
        $query = Peserta::with(['divisiUtama', 'divisiTambahan', 'diterimaDi', 'batch']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('universitas', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->filterDivisi) {
            $query->where(function($q) {
                $q->where('divisi1', $this->filterDivisi)
                  ->orWhere('divisi2', $this->filterDivisi)
                  ->orWhere('divisi_diterima', $this->filterDivisi);
            });
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        if ($this->filterBatch !== 'all' && $this->filterBatch !== '') {
            $query->where('batch_id', $this->filterBatch);
        }

        $peserta = $query->orderBy($this->sortField, $this->sortDirection)->paginate(10);

        return view('livewire.admin.peserta.index', [
            'peserta' => $peserta,
            'divisiList' => Cache::remember('admin.divisi-list', 600, fn () => Divisi::orderBy('nama')->get()),
            'batchList' => Cache::remember('admin.batch-list', 300, fn () => Batch::orderBy('created_at', 'desc')->get(['id', 'nama_batch']))
        ])->layout('layouts.admin');
    }
}
