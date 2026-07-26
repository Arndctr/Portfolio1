{{-- ============================================================
     manajemen-batch.blade.php  —  Admin: Manajemen Batch
     CSS: admin-table.css + batch.css
     Logic/variable/Livewire tidak diubah sama sekali.
     ============================================================ --}}

<div class="adm mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

    {{-- ── Page header ── --}}
    <div class="adm-page-hdr">
        <div>
            <p class="adm-page-hdr__title">Manajemen Batch</p>
            <p class="adm-page-hdr__sub">
                Atur periode pendaftaran, timeline seleksi, kuota, dan divisi magang.
            </p>
        </div>
        <button type="button" wire:click="openCreateModal" class="adm-btn adm-btn--primary adm-btn--md">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Batch
        </button>
    </div>

    {{-- ── Flash messages ── --}}
    @if(session()->has('success'))
        <div class="adm-toast adm-toast--success">
            <p class="adm-toast__title">Berhasil</p>
            <p class="adm-toast__msg">{{ session('success') }}</p>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="adm-alert adm-alert--error">{{ session('error') }}</div>
    @endif

    {{-- ── Main card ── --}}
    <div class="adm-card">

        {{-- ════════════════════════
             DESKTOP TABLE
             ════════════════════════ --}}
        <div class="batch-desktop-tbl adm-tbl-wrap">
            <table class="adm-tbl">
                <colgroup>
                    <col style="width:13%">
                    <col style="width:11%">
                    <col style="width:12%">
                    <col style="width:12%">
                    <col style="width:10%">
                    <col style="width:6%">
                    <col style="width:19%">
                    <col style="width:9%">
                    <col style="width:8%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Batch</th>
                        <th class="c">Periode</th>
                        <th class="c">Administrasi</th>
                        <th class="c">Wawancara</th>
                        <th class="c">Pengumuman</th>
                        <th class="c">Kuota</th>
                        <th>Divisi</th>
                        <th class="c">Status</th>
                        <th class="c">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($batches as $batch)
                        <tr>
                            {{-- Nama batch --}}
                            <td style="font-weight:600;color:var(--text-1)">
                                {{ $batch->nama_batch }}
                            </td>

                            {{-- Periode --}}
                            <td class="c clip0" style="font-family:var(--mono);font-size:11px;white-space:normal">
                                <div>{{ $batch->tanggal_mulai?->format('d M Y') ?? '-' }}</div>
                                <div style="color:var(--text-3)">
                                    s/d {{ $batch->tanggal_selesai?->format('d M Y') ?? '-' }}
                                </div>
                            </td>

                            {{-- Administrasi --}}
                            <td class="c clip0" style="font-family:var(--mono);font-size:11px;white-space:normal">
                                <div>{{ $batch->tanggal_admin_mulai?->format('d M Y') ?? '-' }}</div>
                                <div style="color:var(--text-3)">
                                    s/d {{ $batch->tanggal_admin_selesai?->format('d M Y') ?? '-' }}
                                </div>
                            </td>

                            {{-- Wawancara --}}
                            <td class="c clip0" style="font-family:var(--mono);font-size:11px;white-space:normal">
                                <div>{{ $batch->tanggal_wawancara_mulai?->format('d M Y') ?? '-' }}</div>
                                <div style="color:var(--text-3)">
                                    s/d {{ $batch->tanggal_wawancara_selesai?->format('d M Y') ?? '-' }}
                                </div>
                            </td>

                            {{-- Pengumuman --}}
                            <td class="c clip0" style="font-family:var(--mono);font-size:11px;white-space:nowrap">
                                {{ $batch->tanggal_pengumuman?->format('d M Y') ?? '-' }}
                            </td>

                            {{-- Kuota --}}
                            <td class="c clip0" style="font-weight:700;color:var(--text-1)">
                                {{ $batch->kuota ?? '-' }}
                            </td>

                            {{-- Divisi --}}
                            <td class="clip0" style="white-space:normal;padding-top:6px;padding-bottom:6px">
                                <div class="adm-divisi-wrap">
                                    @forelse($batch->divisi as $div)
                                        <span class="adm-badge adm-badge--divisi">{{ $div->nama }}</span>
                                    @empty
                                        <span style="color:var(--text-3);font-size:11px">-</span>
                                    @endforelse
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="c clip0">
                                @if($batch->isQuotaFull())
                                    <span class="adm-badge adm-badge--full">Kuota Penuh</span>
                                @elseif($batch->isOpen())
                                    <span class="adm-badge adm-badge--open">Dibuka</span>
                                @elseif($batch->isUpcoming())
                                    <span class="adm-badge adm-badge--upcoming">Akan Datang</span>
                                @else
                                    <span class="adm-badge adm-badge--closed">Ditutup</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="c clip0">
                                <div style="display:flex;align-items:center;justify-content:center;gap:4px">
                                    <button
                                        wire:click="edit({{ $batch->id }})"
                                        class="adm-icon-btn adm-icon-btn--blue"
                                        title="Edit Batch"
                                    >
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h11a2 2 0 0
                                                     0 2-2v-5m-1.414-9.414a2 2 0 1 1 2.828 2.828L11.828
                                                     15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button
                                        onclick="confirm('Yakin ingin menghapus batch ini?') || event.stopImmediatePropagation()"
                                        wire:click="delete({{ $batch->id }})"
                                        class="adm-icon-btn adm-icon-btn--red"
                                        title="Hapus Batch"
                                    >
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="m19 7-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0
                                                     1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1
                                                     1 0 0 0-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="adm-tbl__empty">Belum ada data batch.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ════════════════════════
             MOBILE CARD LIST
             ════════════════════════ --}}
        <div class="batch-mobile-list">
            @forelse($batches as $batch)
                <div class="batch-mobile-item">
                    <div class="batch-mobile-item__head">
                        <div>
                            <div class="batch-mobile-item__name">{{ $batch->nama_batch }}</div>
                            <div class="batch-mobile-item__period">
                                {{ $batch->tanggal_mulai?->format('d M Y') ?? '-' }}
                                s/d {{ $batch->tanggal_selesai?->format('d M Y') ?? '-' }}
                            </div>
                        </div>
                        <button wire:click="edit({{ $batch->id }})"
                                class="batch-mobile-item__btn">
                            Edit
                        </button>
                    </div>
                    <div class="batch-mobile-grid">
                        <div class="batch-mobile-tile">
                            <div class="batch-mobile-tile__label">Administrasi</div>
                            <div class="batch-mobile-tile__val">
                                {{ $batch->tanggal_admin_mulai?->format('d M') ?? '-' }}
                                s/d {{ $batch->tanggal_admin_selesai?->format('d M Y') ?? '-' }}
                            </div>
                        </div>
                        <div class="batch-mobile-tile">
                            <div class="batch-mobile-tile__label">Wawancara</div>
                            <div class="batch-mobile-tile__val">
                                {{ $batch->tanggal_wawancara_mulai?->format('d M') ?? '-' }}
                                s/d {{ $batch->tanggal_wawancara_selesai?->format('d M Y') ?? '-' }}
                            </div>
                        </div>
                        <div class="batch-mobile-tile">
                            <div class="batch-mobile-tile__label">Pengumuman</div>
                            <div class="batch-mobile-tile__val">
                                {{ $batch->tanggal_pengumuman?->format('d M Y') ?? '-' }}
                            </div>
                        </div>
                        <div class="batch-mobile-tile">
                            <div class="batch-mobile-tile__label">Kuota</div>
                            <div class="batch-mobile-tile__val">{{ $batch->kuota ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="padding:40px 16px;text-align:center;color:var(--text-3);font-size:12px">
                    Belum ada data batch.
                </div>
            @endforelse
        </div>

    </div>{{-- /.adm-card --}}

    @if($batches->hasPages())
        <div class="adm-footer">
            <span>
                Menampilkan {{ $batches->firstItem() }}–{{ $batches->lastItem() }}
                dari {{ $batches->total() }} batch
            </span>
            <div>{{ $batches->links() }}</div>
        </div>
    @endif

    {{-- ════════════════════════════════════════
         MODAL — Tambah / Edit Batch
         ════════════════════════════════════════ --}}
    @if($showModal)
        <div
            class="adm-modal-overlay adm-modal-overlay--sidebar"
            wire:click.self="closeModal"
            x-data
            x-on:keydown.escape.window="$wire.closeModal()"
        >
            <div class="adm-modal">

                {{-- Modal header --}}
                <div class="adm-modal__hdr">
                    <div>
                        <p class="adm-modal__title">
                            {{ $isEdit ? 'Edit Batch' : 'Tambah Batch' }}
                        </p>
                        <p class="adm-modal__sub">
                            {{ $isEdit
                                ? 'Perbarui periode, kuota, divisi, atau timeline seleksi.'
                                : 'Lengkapi informasi batch baru sesuai alur pendaftaran.' }}
                        </p>
                    </div>
                    <button type="button" wire:click="closeModal"
                            class="adm-modal__close" title="Tutup">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Modal form --}}
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}"
                      style="display:flex;flex-direction:column;flex:1;min-height:0;overflow:hidden">

                    <div class="adm-modal__body">

                        {{-- ── Informasi Batch ── --}}
                        <div class="adm-form-section">
                            <div class="adm-form-section__hdr">Informasi Batch</div>
                            <div class="adm-form-section__body">
                                <div class="adm-form-grid-2">

                                    <div class="adm-form-span-2">
                                        <label class="adm-form-label">Nama Batch</label>
                                        <input
                                            type="text"
                                            wire:model="nama_batch"
                                            placeholder="Contoh: Batch 1 2026"
                                            class="adm-form-input"
                                        >
                                        @error('nama_batch')
                                            <p class="adm-form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="adm-form-label">Tanggal Mulai</label>
                                        <input type="date" wire:model="tanggal_mulai"
                                               class="adm-form-input">
                                        @error('tanggal_mulai')
                                            <p class="adm-form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="adm-form-label">Tanggal Selesai</label>
                                        <input type="date" wire:model="tanggal_selesai"
                                               class="adm-form-input">
                                        @error('tanggal_selesai')
                                            <p class="adm-form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="adm-form-label">Kuota Peserta</label>
                                        <input type="number" min="1" wire:model="kuota"
                                               placeholder="Contoh: 20" class="adm-form-input">
                                        @error('kuota')
                                            <p class="adm-form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- ── Divisi Tersedia ── --}}
                        <div class="adm-form-section">
                            <div class="adm-form-section__hdr">Divisi Tersedia</div>
                            <div class="adm-form-section__body">
                                <div class="adm-check-grid-2">
                                    @foreach($divisiList as $divisi)
                                        <label class="adm-check-item">
                                            <input
                                                type="checkbox"
                                                wire:model="selectedDivisi"
                                                value="{{ $divisi->id }}"
                                            >
                                            <span>{{ $divisi->nama }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('selectedDivisi')
                                    <p class="adm-form-error" style="margin-top:8px">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Timeline Seleksi ── --}}
                        <div class="adm-form-section">
                            <div class="adm-form-section__hdr">Timeline Seleksi</div>
                            <div class="adm-form-section__body">

                                {{-- A. Administrasi --}}
                                <div class="batch-timeline-block">
                                    <p class="batch-timeline-block__title">A. Seleksi Administrasi</p>
                                    <div class="adm-form-grid-2">
                                        <div>
                                            <label class="adm-form-label">Mulai Administrasi</label>
                                            <input type="date" wire:model="tanggal_admin_mulai"
                                                   class="adm-form-input">
                                            @error('tanggal_admin_mulai')
                                                <p class="adm-form-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="adm-form-label">Selesai Administrasi</label>
                                            <input type="date" wire:model="tanggal_admin_selesai"
                                                   class="adm-form-input">
                                            @error('tanggal_admin_selesai')
                                                <p class="adm-form-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- B. Wawancara --}}
                                <div class="batch-timeline-block">
                                    <p class="batch-timeline-block__title">B. Wawancara</p>
                                    <div class="adm-form-grid-2">
                                        <div>
                                            <label class="adm-form-label">Mulai Wawancara</label>
                                            <input type="date" wire:model="tanggal_wawancara_mulai"
                                                   class="adm-form-input">
                                            @error('tanggal_wawancara_mulai')
                                                <p class="adm-form-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="adm-form-label">Selesai Wawancara</label>
                                            <input type="date" wire:model="tanggal_wawancara_selesai"
                                                   class="adm-form-input">
                                            @error('tanggal_wawancara_selesai')
                                                <p class="adm-form-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- C. Pengumuman --}}
                                <div class="batch-timeline-block">
                                    <p class="batch-timeline-block__title">C. Pengumuman</p>
                                    <div style="max-width:280px">
                                        <label class="adm-form-label">Tanggal Pengumuman</label>
                                        <input type="date" wire:model="tanggal_pengumuman"
                                               class="adm-form-input">
                                        @error('tanggal_pengumuman')
                                            <p class="adm-form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>{{-- /.adm-form-section timeline --}}
                    </div>{{-- /.adm-modal__body --}}

                    {{-- Modal footer --}}
                    <div class="adm-modal__ftr">
                        <button type="button" wire:click="closeModal"
                                class="adm-btn adm-btn--ghost">
                            Batal
                        </button>
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="adm-btn adm-btn--primary adm-btn--md"
                        >
                            <span wire:loading.remove>
                                {{ $isEdit ? 'Update Batch' : 'Simpan Batch' }}
                            </span>
                            <span wire:loading>Menyimpan...</span>
                        </button>
                    </div>

                </form>
            </div>{{-- /.adm-modal --}}
        </div>{{-- /.adm-modal-overlay --}}
    @endif

</div>
