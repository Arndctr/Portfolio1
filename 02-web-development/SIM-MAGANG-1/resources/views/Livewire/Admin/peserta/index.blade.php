{{-- ============================================================
     data-peserta.blade.php  —  Admin: Data Peserta Magang
     CSS: admin-table.css + peserta.css
     Logic/variable/Livewire tidak diubah sama sekali.
     FIX: tabel full-width, toolbar responsive, layout rapi.
     ============================================================ --}}

<div class="adm dp-page">

    {{-- ── Page header ── --}}
    <div class="adm-page-hdr">
        <div>
            <p class="adm-page-hdr__title">Data Peserta Magang</p>
            <p class="adm-page-hdr__sub">Kelola dan pantau seluruh pendaftar magang.</p>
        </div>
    </div>

    {{-- ── Main card ── --}}
    <div class="adm-card dp-card">

        {{-- ── Toolbar ── --}}
        <div class="dp-toolbar">

            {{-- Search --}}
            <div class="dp-toolbar__search">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z"/>
                </svg>
                <input
                    wire:model.live.debounce.500ms="search"
                    type="text"
                    placeholder="Cari nama atau kampus..."
                    class="dp-input dp-input--search"
                >
            </div>

            {{-- Filters row --}}
            <div class="dp-filters">
                <select wire:model.live="filterBatch" class="dp-input dp-select">
                    <option value="">Semua Batch/Periode</option>
                    @foreach($batchList as $batch)
                        <option value="{{ $batch->id }}">{{ $batch->nama_batch }}</option>
                    @endforeach
                </select>

                <select wire:model.live="filterDivisi" class="dp-input dp-select">
                    <option value="">Semua Divisi</option>
                    @foreach($divisiList as $divisi)
                        <option value="{{ $divisi->id }}">{{ $divisi->nama }}</option>
                    @endforeach
                </select>

                <select wire:model.live="filterStatus" class="dp-input dp-select">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="wawancara">Wawancara</option>
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                    <option value="selesai">Selesai</option>
                </select>

                <a href="{{ route('admin.export.excel') }}{{ $filterBatch ? '?batch_id=' . $filterBatch : '' }}"
                   class="adm-btn adm-btn--green dp-btn-export"
                   title="Export Excel">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 3v12"/>
                    </svg>
                    Export
                </a>
            </div>
        </div>

        {{-- ── Table ── --}}
        <div class="adm-tbl-wrap">
            <table class="adm-tbl dp-tbl">
                <colgroup>
                    <col class="dp-col-no">
                    <col class="dp-col-nama">
                    <col class="dp-col-kampus">
                    <col class="dp-col-divisi">
                    <col class="dp-col-diterima">
                    <col class="dp-col-status">
                    <col class="dp-col-batch">
                    <col class="dp-col-aksi">
                </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th>
                            <button type="button" class="adm-sort-btn" wire:click="sortBy('nama')">
                                Nama
                                @if($sortField === 'nama')
                                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                                @else
                                    <span style="opacity:.3">↕</span>
                                @endif
                            </button>
                        </th>
                        <th>
                            <button type="button" class="adm-sort-btn" wire:click="sortBy('universitas')">
                                Kampus
                                @if($sortField === 'universitas')
                                    <span>{!! $sortDirection === 'asc' ? '&#8593;' : '&#8595;' !!}</span>
                                @else
                                    <span style="opacity:.3">↕</span>
                                @endif
                            </button>
                        </th>
                        <th>Divisi Pilihan</th>
                        <th>Diterima Di</th>
                        <th class="c">Status</th>
                        <th class="c">Batch</th>
                        <th class="c">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peserta as $index => $p)
                        @php
                            $statusBadge = match($p->status) {
                                'menunggu'  => 'adm-badge--menunggu',
                                'wawancara' => 'adm-badge--wawancara',
                                'diterima'  => 'adm-badge--diterima',
                                'ditolak'   => 'adm-badge--ditolak',
                                'selesai'   => 'adm-badge--selesai',
                                default     => 'adm-badge--menunggu',
                            };
                        @endphp
                        <tr>
                            {{-- No --}}
                            <td class="c clip0 dp-td-no">
                                {{ $peserta->firstItem() + $index }}
                            </td>

                            {{-- Nama + prodi --}}
                            <td>
                                <div class="adm-cell__primary">{{ $p->nama }}</div>
                                <div class="adm-cell__sub">{{ $p->prodi }}</div>
                            </td>

                            {{-- Kampus --}}
                            <td style="font-weight:500;color:var(--text-1)">
                                {{ $p->universitas }}
                            </td>

                            {{-- Divisi pilihan --}}
                            <td>
                                <div class="adm-cell__top">1. {{ $p->divisiUtama->nama ?? '-' }}</div>
                                <div class="adm-cell__bot">2. {{ $p->divisiTambahan->nama ?? '-' }}</div>
                            </td>

                            {{-- Diterima di --}}
                            <td class="clip0">
                                @if($p->diterimaDi)
                                    <span class="adm-badge adm-badge--blue">
                                        {{ $p->diterimaDi->nama }}
                                    </span>
                                @else
                                    <span style="color:var(--text-3)">—</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="c clip0">
                                <span class="adm-badge {{ $statusBadge }}">
                                    {{ $p->status }}
                                </span>
                            </td>

                            {{-- Batch --}}
                            <td class="c clip0">
                                <span class="adm-badge adm-badge--slate">
                                    {{ $p->batch->nama_batch ?? '-' }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="c clip0">
                                <a href="{{ route('admin.peserta.detail', $p->id) }}"
                                   class="adm-icon-btn adm-icon-btn--blue"
                                   title="Detail">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                              c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542
                                              7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="adm-tbl__empty">
                                Tidak ada data peserta ditemukan untuk kriteria ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── Pagination footer ── --}}
        <div class="adm-footer">
            <span>
                @if($peserta->total() > 0)
                    Menampilkan {{ $peserta->firstItem() }}–{{ $peserta->lastItem() }}
                    dari {{ $peserta->total() }} peserta
                @else
                    Tidak ada data
                @endif
            </span>
            <div>{{ $peserta->links() }}</div>
        </div>

    </div>{{-- /.adm-card --}}
</div>
