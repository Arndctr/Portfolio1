<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Batch;
use App\Models\Peserta;
use App\Models\Divisi;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $filterDivisi = '';
    public $filterStatus = '';

    protected $queryString = ['search','filterDivisi','filterStatus'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $activeBatch = Batch::active()->first();
        
        $stats = [
            'total' => 0,
            'wawancara' => 0,
            'diterima' => 0,
            'ditolak' => 0,
            'selesai' => 0,
            'menunggu' => 0,
        ];
        
        $pesertas = Peserta::where('id', 0)->paginate(10);

        if ($activeBatch) {
            $counts = Peserta::where('batch_id', $activeBatch->id)
                ->selectRaw("status, count(*) as count")
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();
            
            $stats['total'] = array_sum($counts);
            $stats['wawancara'] = $counts['wawancara'] ?? 0;
            $stats['diterima'] = $counts['diterima'] ?? 0;
            $stats['ditolak'] = $counts['ditolak'] ?? 0;
            $stats['selesai'] = $counts['selesai'] ?? 0;
            $stats['menunggu'] = $counts['menunggu'] ?? 0;

            $query = Peserta::with(['divisiUtama', 'divisiTambahan', 'diterimaDi'])
                ->where('batch_id', $activeBatch->id);

            if ($this->search) {
                $query->where(function($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('universitas', 'like', '%' . $this->search . '%');
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

            $pesertas = $query->latest()->paginate(10);
        }

        return view('livewire.admin.dashboard', array_merge([
            'activeBatch' => $activeBatch,
            'pesertas' => $pesertas,
            'divisiList' => Cache::remember('admin.divisi-list', 600, fn () => Divisi::orderBy('nama')->get()),
        ], $stats))->layout('layouts.admin');
    }
}
