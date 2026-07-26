{{-- ============================================================
     cek-pendaftar.blade.php  —  Halaman Publik: Cek Pendaftar
     CSS: admin-table.css + pendaftar.css
     Logic/variable/kondisi tidak diubah sama sekali.
     ============================================================ --}}

<div class="adm @if(!$limit) cp-page @endif">
    <div class="@if(!$limit) mx-auto max-w-4xl @endif">

        {{-- ── FULL PAGE MODE: header & back button ── --}}
        @if(!$limit)
            <a href="{{ route('daftar') }}" class="cp-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19 3 12m0 0 7-7m-7 7h18"/>
                </svg>
                Kembali ke Pendaftaran
            </a>

            <div class="cp-page-hdr">
                <h1 class="cp-page-hdr__title">Data Pendaftar</h1>
                <p class="cp-page-hdr__desc">
                    Pantau data peserta yang telah mengajukan pendaftaran magang
                    pada batch yang sedang berlangsung.
                </p>
            </div>

            @if($activeBatch)
                <div class="cp-batch-bar">
                    <div>
                        <div class="cp-batch-bar__label">Batch Aktif</div>
                        <div class="cp-batch-bar__name">{{ $activeBatch->nama_batch }}</div>
                    </div>
                    <span class="adm-badge adm-badge--open">Pendaftaran Dibuka</span>
                </div>
            @endif
        @endif

        {{-- ── NO ACTIVE BATCH ── --}}
        @if(!$activeBatch)
            @if(!$limit)
                <div class="cp-empty-box">
                    <div class="cp-empty-box__icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                        </svg>
                    </div>
                    <h2 class="cp-empty-box__title">Pendaftaran Belum Dibuka</h2>
                    <p class="cp-empty-box__desc">
                        Saat ini belum ada batch pendaftaran yang aktif.
                        Silakan cek kembali nanti.
                    </p>
                    <a href="{{ route('home') }}" class="cp-empty-box__btn">
                        Kembali ke Beranda
                    </a>
                </div>
            @endif

        {{-- ── HAS ACTIVE BATCH → TABLE ── --}}
        @else
            <div class="adm-card">
                <div class="adm-tbl-wrap">
                    <table class="adm-tbl">
                        <colgroup>
                            <col style="width:38%">
                            <col style="width:38%">
                            <col style="width:24%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Nama Peserta</th>
                                <th>Asal Kampus / Sekolah</th>
                                <th class="r">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peserta as $p)
                                <tr>
                                    {{-- Nama + prodi --}}
                                    <td>
                                        <div class="adm-cell__primary">{{ $p->nama }}</div>
                                        <div class="adm-cell__sub">{{ $p->prodi }}</div>
                                    </td>

                                    {{-- Universitas / sekolah --}}
                                    <td style="color:var(--text-1);font-weight:500;
                                               max-width:none;white-space:nowrap;
                                               overflow:hidden;text-overflow:ellipsis">
                                        {{ $p->universitas }}
                                        @if(isset($p->sekolah))
                                            <span style="color:var(--text-3);font-weight:400">
                                                · {{ $p->sekolah }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Tanggal daftar --}}
                                    <td class="r clip0"
                                        style="font-family:var(--mono);font-size:11.5px">
                                        <div style="color:var(--text-1);font-weight:600">
                                            {{ $p->created_at->format('d M Y') }}
                                        </div>
                                        <div style="color:var(--text-3);font-size:10.5px">
                                            {{ $p->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="padding:0;max-width:none">
                                        <div class="adm-empty-state">
                                            <div class="adm-empty-state__icon">
                                                <svg fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="1.8"
                                                          d="M9 13h6m-6 4h6M7 5h10a2 2 0 0 1 2
                                                             2v10a2 2 0 0 1-2 2H7a2 2 0 0
                                                             1-2-2V7a2 2 0 0 1 2-2z"/>
                                                </svg>
                                            </div>
                                            <p class="adm-empty-state__title">
                                                Belum ada pendaftar saat ini.
                                            </p>
                                            <p class="adm-empty-state__desc">
                                                Data peserta yang telah melakukan pendaftaran
                                                akan muncul pada bagian ini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(!$limit && method_exists($peserta, 'hasPages') && $peserta->hasPages())
                <div class="adm-footer">
                    <span>
                        Menampilkan {{ $peserta->firstItem() }}–{{ $peserta->lastItem() }}
                        dari {{ $peserta->total() }} pendaftar
                    </span>
                    <div>{{ $peserta->links() }}</div>
                </div>
            @endif
        @endif

    </div>
</div>
