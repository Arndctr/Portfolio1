{{-- ============================================================
     detail-peserta.blade.php  —  Admin: Detail Peserta
     CSS: admin-table.css + detail.css
     Logic/variable/Livewire tidak diubah sama sekali.
     ============================================================ --}}

<div class="adm mx-auto max-w-5xl px-4 space-y-4">

    {{-- ── Page header ── --}}
    <div class="adm-page-hdr">
        <div style="display:flex;align-items:center;gap:10px">
            <a href="{{ route('admin.peserta.index') }}" class="adm-back">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <div>
                <p class="adm-page-hdr__title">Detail Peserta</p>
                <p class="adm-page-hdr__sub">Informasi lengkap &amp; pengelolaan</p>
            </div>
        </div>

        <div class="adm-page-hdr__actions">
            @if(in_array($status, ['wawancara', 'diterima']))
                <a href="#wa-template" class="adm-btn adm-btn--green adm-btn--md">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15
                                 -.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463
                                 -2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134
                                 -.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52
                                 -.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.506-.173-.007-.371
                                 -.007-.57-.007-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0
                                 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262
                                 .489 1.694.625.712.136 1.36.117 1.871.05.57-.075 1.758-.716 2.003-1.408.245
                                 -.693.245-1.287.172-1.407-.073-.12-.272-.198-.57-.347zM12 2.163c-5.429
                                 0-9.837 4.408-9.837 9.837 0 1.735.453 3.428 1.312 4.922L2 22l5.22-.1.372
                                 -1.373c1.442.8 3.06 1.226 4.708 1.226 5.43 0 9.837-4.408 9.837-9.837
                                 0-5.429-4.407-9.837-9.837-9.837z"/>
                    </svg>
                    Hubungi via WhatsApp
                </a>
            @else
                <button disabled class="adm-btn adm-btn--ghost adm-btn--md"
                        style="cursor:not-allowed;opacity:.5">
                    <svg fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15
                                 -.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463
                                 -2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134
                                 -.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52
                                 -.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.506-.173-.007-.371
                                 -.007-.57-.007-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0
                                 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262
                                 .489 1.694.625.712.136 1.36.117 1.871.05.57-.075 1.758-.716 2.003-1.408.245
                                 -.693.245-1.287.172-1.407-.073-.12-.272-.198-.57-.347zM12 2.163c-5.429
                                 0-9.837 4.408-9.837 9.837 0 1.735.453 3.428 1.312 4.922L2 22l5.22-.1.372
                                 -1.373c1.442.8 3.06 1.226 4.708 1.226 5.43 0 9.837-4.408 9.837-9.837
                                 0-5.429-4.407-9.837-9.837-9.837z"/>
                    </svg>
                    Hubungi via WhatsApp
                </button>
            @endif
        </div>
    </div>

    {{-- ── Flash ── --}}
    @if(session()->has('success'))
        <div class="adm-toast adm-toast--success">
            <p class="adm-toast__title">Berhasil</p>
            <p class="adm-toast__msg">{{ session('success') }}</p>
        </div>
    @endif

    {{-- ── Two-column layout ── --}}
    <div class="dp2-layout">

        {{-- ════════════════════
             LEFT COLUMN
             ════════════════════ --}}
        <div style="display:flex;flex-direction:column;gap:14px">

            {{-- Profile card --}}
            <div class="adm-card">
                <div class="adm-profile-card">
                    <div class="adm-profile-card__avatar">
                        @if($peserta->foto && Storage::disk('public')->exists($peserta->foto))
                            <img src="{{ asset('storage/' . $peserta->foto) }}"
                                 loading="lazy"
                                 decoding="async"
                                 alt="{{ $peserta->nama }}">
                        @else
                            <svg fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4
                                         4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        @endif
                    </div>
                    <p class="adm-profile-card__name">{{ $peserta->nama }}</p>
                    <p class="adm-profile-card__univ">{{ $peserta->universitas }}</p>
                </div>

                <div style="height:1px;background:var(--border)"></div>

                <div class="adm-profile-links">
                    {{-- CV --}}
                    @if($peserta->cv && Storage::disk('public')->exists($peserta->cv))
                        <a href="{{ asset('storage/' . $peserta->cv) }}" target="_blank"
                           class="adm-profile-link adm-profile-link--blue">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0
                                         01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lihat CV
                        </a>
                    @else
                        <span class="adm-profile-link adm-profile-link--disabled">
                            CV Tidak Tersedia
                        </span>
                    @endif

                    {{-- KHS --}}
                    @if($peserta->khs && Storage::disk('public')->exists($peserta->khs))
                        <a href="{{ asset('storage/' . $peserta->khs) }}" target="_blank"
                           class="adm-profile-link adm-profile-link--green">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1
                                         1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lihat KHS
                        </a>
                    @endif

                    {{-- Bukti follow IG --}}
                    @if($peserta->bukti_follow && Storage::disk('public')->exists($peserta->bukti_follow))
                        <a href="{{ asset('storage/' . $peserta->bukti_follow) }}" target="_blank"
                           class="adm-profile-link adm-profile-link--pink">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0
                                         012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2
                                         2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Bukti Follow IG
                        </a>
                    @endif

                    {{-- Portofolio --}}
                    @if($peserta->portfolio)
                        <a href="{{ $peserta->portfolio }}" target="_blank"
                           class="adm-profile-link adm-profile-link--purple">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0
                                         0v6m0-6L10 14"/>
                            </svg>
                            Lihat Portofolio
                        </a>
                    @else
                        <span class="adm-profile-link adm-profile-link--disabled">
                            Portofolio Kosong
                        </span>
                    @endif
                </div>
            </div>

            {{-- Kontak & Akademik --}}
            <div class="adm-card">
                <div class="adm-card-hdr">
                    <p class="adm-card-hdr__title">Kontak &amp; Akademik</p>
                </div>
                <div style="padding:12px 14px">
                    <div class="adm-info-list">

                        <div class="adm-info-row">
                            <div class="adm-info-row__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2
                                             2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="adm-info-row__key">Email</p>
                                <p class="adm-info-row__val">{{ $peserta->email }}</p>
                            </div>
                        </div>

                        <div class="adm-info-row">
                            <div class="adm-info-row__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54
                                             1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0
                                             011.059-.54l4.435.74a1 1 0 01.836.986V17a2 2 0 01-2 2h-1C9.716
                                             19 3 12.284 3 4V3z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="adm-info-row__key">WhatsApp</p>
                                <p class="adm-info-row__val">{{ $peserta->whatsapp }}</p>
                            </div>
                        </div>

                        <div class="adm-info-row">
                            <div class="adm-info-row__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="adm-info-row__key">Sosial Media</p>
                                <p class="adm-info-row__val">{{ $peserta->sosial_media ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="adm-info-row">
                            <div class="adm-info-row__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16
                                             6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2
                                             2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="adm-info-row__key">Usaha / Bisnis</p>
                                <p class="adm-info-row__val">{{ $peserta->usaha_bisnis ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="adm-info-row">
                            <div class="adm-info-row__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="adm-info-row__key">Durasi Magang</p>
                                <p class="adm-info-row__val">{{ $peserta->durasi_magang ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="adm-info-row">
                            <div class="adm-info-row__icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 14l9-5-9-5-9 5 9 5zm0 0v7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="adm-info-row__key">Program Studi</p>
                                <p class="adm-info-row__val">
                                    {{ $peserta->prodi }} ({{ $peserta->jenis_magang }})
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>{{-- /.left-col --}}

        {{-- ════════════════════
             RIGHT COLUMN
             ════════════════════ --}}
        <div style="display:flex;flex-direction:column;gap:14px">

            {{-- ── Update Status & Penempatan ── --}}
            <div class="adm-card">
                <div class="adm-card-hdr">
                    <div style="display:flex;align-items:center;gap:8px">
                        <span style="width:3px;height:16px;background:var(--blue);
                                     border-radius:2px;display:block;flex-shrink:0"></span>
                        <p class="adm-card-hdr__title">Update Status &amp; Penempatan</p>
                    </div>
                </div>

                <form wire:submit.prevent="update"
                      style="padding:14px;display:flex;flex-direction:column;gap:12px">

                    <div class="adm-form-grid-3">
                        {{-- Status --}}
                        <div>
                            <label class="adm-form-label">Status Seleksi</label>
                            <select wire:model.live="status" class="adm-form-select">
                                <option value="menunggu">Menunggu</option>
                                <option value="wawancara">Wawancara</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            @error('status')
                                <p class="adm-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Divisi diterima --}}
                        <div>
                            <label class="adm-form-label">Divisi Diterima</label>
                            <select wire:model="divisi_diterima" class="adm-form-select">
                                <option value="">Pilih Penempatan</option>
                                @foreach($divisiList as $div)
                                    <option value="{{ $div->id }}">{{ $div->nama }}</option>
                                @endforeach
                            </select>
                            <p class="adm-form-hint">
                                * Pilihan utama &amp; alternatif peserta
                            </p>
                            @error('divisi_diterima')
                                <p class="adm-form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Pindah batch --}}
                        <div>
                            <label class="adm-form-label">Pindah Batch</label>
                            <select wire:model="batch_id" class="adm-form-select">
                                @foreach($batchList as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->nama_batch }}</option>
                                @endforeach
                            </select>
                            @error('batch_id')
                                <p class="adm-form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Jadwal magang resmi --}}
                    <div class="adm-form-section">
                        <div class="adm-form-section__hdr adm-form-section__hdr--accent">
                            Jadwal Magang Resmi
                        </div>
                        <div class="adm-form-section__body">
                            <div class="adm-form-grid-2">
                                <div>
                                    <label class="adm-form-label"
                                           style="color:var(--blue)">Tanggal Mulai</label>
                                    <input type="date" wire:model="periode_mulai"
                                           class="adm-form-input">
                                    @error('periode_mulai')
                                        <p class="adm-form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="adm-form-label"
                                           style="color:var(--blue)">Tanggal Selesai</label>
                                    <input type="date" wire:model="periode_selesai"
                                           class="adm-form-input">
                                    @error('periode_selesai')
                                        <p class="adm-form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="dp2-period-row">
                                <span class="dp2-period-row__label">Request awal peserta:</span>
                                <span class="dp2-period-row__val">
                                    {{ $peserta->periode_mulai?->format('d M Y') ?? '-' }}
                                    —
                                    {{ $peserta->periode_selesai?->format('d M Y') ?? '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="adm-btn adm-btn--primary adm-btn--md">
                            <span wire:loading.remove>Simpan Perubahan</span>
                            <span wire:loading>Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── Template WhatsApp ── --}}
            <div id="wa-template" class="adm-card">
                <div class="adm-card-hdr">
                    <div style="display:flex;align-items:center;gap:8px">
                        <span style="width:3px;height:16px;background:#16a34a;
                                     border-radius:2px;display:block;flex-shrink:0"></span>
                        <p class="adm-card-hdr__title">Template Pesan WhatsApp</p>
                    </div>
                    <div>
                        @if($status === 'wawancara')
                            <span class="adm-wa-mode-tag adm-wa-mode-tag--interview">
                                Mode: Interview
                            </span>
                        @elseif($status === 'diterima')
                            <span class="adm-wa-mode-tag adm-wa-mode-tag--diterima">
                                Mode: Diterima
                            </span>
                        @else
                            <span class="adm-wa-mode-tag adm-wa-mode-tag--off">
                                Mode: Disabled
                            </span>
                        @endif
                    </div>
                </div>

                <div style="padding:14px">
                    @if(in_array($status, ['wawancara', 'diterima']))
                        <div style="display:flex;flex-direction:column;gap:12px">

                            {{-- WA input fields --}}
                            <div class="adm-form-grid-4">
                                <div>
                                    <label class="adm-form-label">Hari / Tanggal</label>
                                    <input type="text"
                                           wire:model.live="wa_hari_tanggal"
                                           placeholder="Senin, 20 Mei 2025"
                                           class="adm-form-input">
                                </div>
                                <div>
                                    <label class="adm-form-label">Pukul</label>
                                    <input type="text"
                                           wire:model.live="wa_pukul"
                                           placeholder="09.00 WIB"
                                           class="adm-form-input">
                                </div>
                                <div>
                                    <label class="adm-form-label">Tempat</label>
                                    <input type="text"
                                           wire:model.live="wa_tempat"
                                           placeholder="Kantor Rumah BUMN"
                                           class="adm-form-input">
                                </div>
                                <div>
                                    <label class="adm-form-label">Pakaian</label>
                                    <input type="text"
                                           wire:model.live="wa_pakaian"
                                           placeholder="Kemeja Rapi"
                                           class="adm-form-input">
                                </div>
                            </div>

                            {{-- Edit + Preview --}}
                            <div class="adm-form-grid-2">
                                <div>
                                    <label class="adm-form-label">Edit Isi Pesan</label>
                                    <textarea wire:model.live="wa_template_content"
                                              rows="10"
                                              class="adm-form-textarea"></textarea>
                                </div>
                                <div>
                                    <label class="adm-form-label">Preview Pesan</label>
                                    <div class="adm-wa-preview">{{ $wa_template_content }}</div>
                                </div>
                            </div>

                            {{-- Kirim via WA --}}
                            <a href="{{ $this->wa_url }}" target="_blank"
                               class="adm-btn adm-btn--green adm-btn--md"
                               style="width:100%;justify-content:center;height:38px;font-size:13px">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471
                                             -.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644
                                             .075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653
                                             -2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149
                                             -.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669
                                             -1.612-.916-2.207-.242-.579-.487-.5-.669-.506-.173-.007-.371-.007
                                             -.57-.007-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479
                                             0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709
                                             .306 1.262.489 1.694.625.712.136 1.36.117 1.871.05.57-.075 1.758
                                             -.716 2.003-1.408.245-.693.245-1.287.172-1.407-.073-.12-.272-.198
                                             -.57-.347zM12 2.163c-5.429 0-9.837 4.408-9.837 9.837 0 1.735.453
                                             3.428 1.312 4.922L2 22l5.22-.1.372-1.373c1.442.8 3.06 1.226 4.708
                                             1.226 5.43 0 9.837-4.408 9.837-9.837 0-5.429-4.407-9.837-9.837
                                             -9.837z"/>
                                </svg>
                                Buka &amp; Kirim via WhatsApp
                            </a>
                        </div>

                    @else
                        <div class="adm-wa-disabled">
                            <div class="adm-wa-disabled__icon">
                                <svg fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471
                                             -.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644
                                             .075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653
                                             -2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149
                                             -.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669
                                             -1.612-.916-2.207-.242-.579-.487-.5-.669-.506-.173-.007-.371-.007
                                             -.57-.007-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479
                                             0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709
                                             .306 1.262.489 1.694.625.712.136 1.36.117 1.871.05.57-.075 1.758
                                             -.716 2.003-1.408.245-.693.245-1.287.172-1.407-.073-.12-.272-.198
                                             -.57-.347zM12 2.163c-5.429 0-9.837 4.408-9.837 9.837 0 1.735.453
                                             3.428 1.312 4.922L2 22l5.22-.1.372-1.373c1.442.8 3.06 1.226 4.708
                                             1.226 5.43 0 9.837-4.408 9.837-9.837 0-5.429-4.407-9.837-9.837
                                             -9.837z"/>
                                </svg>
                            </div>
                            <p class="adm-wa-disabled__title">Template Tidak Tersedia</p>
                            <p class="adm-wa-disabled__desc">
                                Fitur WhatsApp hanya aktif untuk peserta berstatus
                                <span style="color:var(--blue)">Wawancara</span> atau
                                <span style="color:var(--green)">Diterima</span>.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>{{-- /.right-col --}}
    </div>{{-- /.dp2-layout --}}
</div>
