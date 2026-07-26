{{-- ============================================================
     dashboard.blade.php  —  Admin Dashboard
     CSS: admin-table.css + dashboard.css
     Logic/variable/query tidak diubah sama sekali.
     ============================================================ --}}

<div class="adm mx-auto max-w-7xl space-y-4 px-4 sm:px-6 lg:px-8">

    @php
        $stats = [
            ['label' => 'Total Peserta', 'value' => $total,     'color' => 'blue',   'icon' => 'Total.svg'],
            ['label' => 'Menunggu',      'value' => $menunggu,  'color' => 'yellow', 'icon' => 'wawancara.svg'],
            ['label' => 'Wawancara',     'value' => $wawancara, 'color' => 'indigo', 'icon' => 'wawancara.svg'],
            ['label' => 'Diterima',      'value' => $diterima,  'color' => 'green',  'icon' => 'diterima.svg'],
            ['label' => 'Ditolak',       'value' => $ditolak,   'color' => 'red',    'icon' => 'tolak.svg'],
            ['label' => 'Selesai',       'value' => $selesai,   'color' => 'gray',   'icon' => 'selesai.svg'],
        ];
    @endphp

    {{-- ── Stat cards ── --}}
    <div class="db-stat-grid">
        @foreach($stats as $stat)
            <div class="adm-stat adm-stat--{{ $stat['color'] }}">
                <div class="adm-stat__top">
                    <div class="adm-stat__icon">
                        <img src="{{ asset('images/' . $stat['icon']) }}" loading="lazy" decoding="async" alt="{{ $stat['label'] }}">
                    </div>
                    <span class="adm-stat__label-tag">Statistik</span>
                </div>
                <div>
                    <p class="adm-stat__val">{{ $stat['value'] }}</p>
                    <p class="adm-stat__name">{{ $stat['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ── Batch aktif ── --}}
    <div class="adm-card">
        <div class="adm-card-hdr">
            <div style="display:flex;align-items:center;gap:10px">
                <div class="db-batch-icon">
                    <img src="{{ asset('images/periode.svg') }}" loading="lazy" decoding="async" alt="batch">
                </div>
                <div>
                    <p class="adm-card-hdr__title">Batch Pendaftaran Aktif</p>
                    <p class="adm-card-hdr__sub">Informasi periode yang sedang berlangsung</p>
                </div>
            </div>
        </div>

        <div style="padding:12px 14px">
            @if($activeBatch)
                @php
                    $batchStatus    = $activeBatch->status;
                    $statusBadgeMap = [
                        'dibuka'       => 'adm-badge--open',
                        'belum_dibuka' => 'adm-badge--yellow',
                        'ditutup'      => 'adm-badge--closed',
                    ];
                    $statusBadgeCls = $statusBadgeMap[$batchStatus] ?? 'adm-badge--slate';
                @endphp
                <div class="adm-batch-banner">
                    <div class="adm-batch-banner__cell">
                        <p class="adm-batch-banner__label">Nama Batch</p>
                        <p class="adm-batch-banner__val" style="margin-bottom:5px">
                            {{ $activeBatch->nama_batch }}
                        </p>
                        <span class="adm-badge adm-badge--open">Aktif</span>
                    </div>
                    <div class="adm-batch-banner__cell">
                        <p class="adm-batch-banner__label">Periode Pendaftaran</p>
                        <p class="adm-batch-banner__val adm-batch-banner__val--period">
                            {{ $activeBatch->tanggal_mulai->translatedFormat('d F Y') }}
                            <span style="color:var(--text-3)">—</span>
                            {{ $activeBatch->tanggal_selesai->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div class="adm-batch-banner__cell">
                        <p class="adm-batch-banner__label">Status Sistem</p>
                        <span class="adm-badge {{ $statusBadgeCls }}">
                            Pendaftaran {{ str_replace('_', ' ', $batchStatus) }}
                        </span>
                    </div>
                </div>
            @else
                <div class="adm-empty-banner">
                    <div class="adm-empty-banner__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667
                                     1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464
                                     0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <p class="adm-empty-banner__title">Tidak ada batch aktif</p>
                    <p class="adm-empty-banner__desc">
                        Aktifkan salah satu batch di menu "Atur Batch" untuk menerima pendaftaran.
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Tabel pendaftar batch aktif ── --}}
    <div class="adm-card">
        <div class="adm-card-hdr">
            <div>
                <p class="adm-card-hdr__title">Pendaftar Batch Aktif</p>
                <p class="adm-card-hdr__sub">
                    Monitoring pendaftar terbaru pada batch yang sedang berjalan
                </p>
            </div>
        </div>

        <div class="adm-tbl-wrap">
            <table class="adm-tbl" style="min-width:580px">
                <colgroup>
                    <col style="width:22%">
                    <col style="width:20%">
                    <col style="width:22%">
                    <col style="width:13%">
                    <col style="width:7%">
                </colgroup>
                <thead>
                    <tr>
                        <th>Nama Peserta</th>
                        <th>Universitas</th>
                        <th>Divisi Pilihan</th>
                        <th class="c">Status</th>
                        <th class="c">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesertas as $p)
                        @php
                            $sBadge = match($p->status) {
                                'menunggu'  => 'adm-badge--menunggu',
                                'wawancara' => 'adm-badge--wawancara',
                                'diterima'  => 'adm-badge--diterima',
                                'ditolak'   => 'adm-badge--ditolak',
                                'selesai'   => 'adm-badge--selesai',
                                default     => 'adm-badge--menunggu',
                            };
                        @endphp
                        <tr>
                            {{-- Nama + email --}}
                            <td>
                                <div class="adm-cell__primary">{{ $p->nama }}</div>
                                <div class="adm-cell__sub">{{ $p->email }}</div>
                            </td>

                            {{-- Universitas --}}
                            <td style="font-weight:500;color:var(--text-1)">
                                {{ $p->universitas }}
                            </td>

                            {{-- Divisi pilihan --}}
                            <td>
                                <div class="adm-cell__top">1. {{ $p->divisiUtama->nama ?? '-' }}</div>
                                <div class="adm-cell__bot">2. {{ $p->divisiTambahan->nama ?? '-' }}</div>
                            </td>

                            {{-- Status --}}
                            <td class="c clip0">
                                <span class="adm-badge {{ $sBadge }}">{{ $p->status }}</span>
                            </td>

                            {{-- Aksi --}}
                            <td class="c clip0">
                                <a href="{{ route('admin.peserta.detail', $p->id) }}"
                                   class="adm-icon-btn adm-icon-btn--blue"
                                   title="Detail">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268
                                                 2.943 9.542 7-1.274 4.057-5.064 7-9.542
                                                 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="adm-tbl__empty">
                                @if($activeBatch)
                                    Belum ada data pendaftar pada batch aktif ini.
                                @else
                                    Sistem menunggu aktivasi batch untuk memuat data.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pesertas->hasPages())
            <div class="adm-footer">
                <span>
                    Menampilkan {{ $pesertas->firstItem() }}–{{ $pesertas->lastItem() }}
                    dari {{ $pesertas->total() }} peserta
                </span>
                <div>{{ $pesertas->links() }}</div>
            </div>
        @endif
    </div>

</div>
