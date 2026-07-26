<?php

namespace App\Livewire\Admin\Peserta;

use Livewire\Component;
use App\Models\Peserta;
use App\Models\Divisi;
use App\Models\Batch;
use Illuminate\Support\Facades\Cache;

class Detail extends Component
{
    public $peserta;
    public $status;
    public $divisi_diterima;
    public $batch_id;
    public $periode_mulai;
    public $periode_selesai;

    public $wa_hari_tanggal;
    public $wa_pukul;
    public $wa_tempat;
    public $wa_pakaian;
    public $wa_template_content;

    public $divisiList = [];
    public $batchList = [];

    public function mount($id)
    {
        $this->peserta = Peserta::with(['divisiUtama', 'divisiTambahan', 'diterimaDi', 'batch'])->findOrFail($id);

        $this->status = $this->peserta->status;
        $this->divisi_diterima = $this->peserta->divisi_diterima;
        $this->batch_id = $this->peserta->batch_id;
        $this->periode_mulai = $this->peserta->periode_mulai ? $this->peserta->periode_mulai->format('Y-m-d') : null;
        $this->periode_selesai = $this->peserta->periode_selesai ? $this->peserta->periode_selesai->format('Y-m-d') : null;

        $this->divisiList = Divisi::whereIn('id', array_filter([$this->peserta->divisi1, $this->peserta->divisi2]))
            ->orderBy('nama')
            ->get();
        $this->batchList = Cache::remember('admin.batch-list', 300, fn () => Batch::orderBy('created_at', 'desc')->get(['id', 'nama_batch']));

        $this->generateWATemplate();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['wa_hari_tanggal', 'wa_pukul', 'wa_tempat', 'wa_pakaian', 'status'])) {
            $this->generateWATemplate();
        }
    }

    public function generateWATemplate()
    {
        $nama = $this->peserta->nama;
        $hari = $this->wa_hari_tanggal ?: '......';
        $pukul = $this->wa_pukul ?: '......';
        $tempat = $this->wa_tempat ?: '......';
        $pakaian = $this->wa_pakaian ?: '......';

        if ($this->status === 'wawancara') {
            $this->wa_template_content = "Selamat Pagi/Siang/Sore,\nKami dari Rumah BUMN Yogyakarta menginformasikan bahwa berdasarkan hasil seleksi, Anda diundang mengikuti *wawancara/interview* untuk program magang di Rumah BUMN Yogyakarta.\n\nKami mohon kesediaannya untuk hadir pada:\nHari/Tanggal : {$hari}\nPukul : {$pukul}\nTempat : {$tempat}\nPakaian : {$pakaian}\n\nNB:\n- Membawa fotokopi KTM\n- Membawa transkrip nilai/KHS\n\nTerima kasih.\nSalam hangat,\nRumah BUMN Yogyakarta";
        } elseif ($this->status === 'diterima') {
            $this->wa_template_content = "Selamat Pagi/Siang/Sore,\nKami dari Rumah BUMN Yogyakarta menginformasikan bahwa berdasarkan hasil seleksi, Anda dinyatakan *diterima* untuk mengikuti program magang di Rumah BUMN Yogyakarta.\n\nKami mohon kesediaannya untuk hadir pada:\nHari/Tanggal : {$hari}\nPukul : {$pukul}\nTempat : {$tempat}\nPakaian : {$pakaian}\n\nNB:\n- Membawa fotokopi KTM\n- Membawa transkrip nilai/KHS\n\nTerima kasih.\nSalam hangat,\nRumah BUMN Yogyakarta";
        } else {
            $this->wa_template_content = "";
        }
    }

    public function getWaUrlProperty()
    {
        $nomor = preg_replace('/[^0-9]/', '', $this->peserta->whatsapp);

        // Ubah format 08 menjadi 628
        if (substr($nomor, 0, 1) == '0') {
            $nomor = '62' . substr($nomor, 1);
        }

        return "https://wa.me/{$nomor}?text=" . urlencode($this->wa_template_content);
    }

    public function update()
    {
        $this->validate([
            'status' => 'required',
            'divisi_diterima' => 'nullable|exists:divisi,id',
            'batch_id' => 'nullable|exists:batches,id',
            'periode_mulai' => 'nullable|date',
            'periode_selesai' => 'nullable|date',
        ]);

        $this->peserta->update([
            'status' => $this->status,
            'divisi_diterima' => $this->divisi_diterima,
            'batch_id' => $this->batch_id,
            'periode_mulai' => $this->periode_mulai,
            'periode_selesai' => $this->periode_selesai,
        ]);

        Cache::forget('landing.daftar.batch-data');
        Cache::forget('landing.home.batch-data');
        Cache::forget('landing.active-batch');

        session()->flash('success', 'Data peserta berhasil diperbarui.');
        return redirect()->route('admin.peserta.index');
    }

    public function render()
    {
        return view('livewire.admin.peserta.detail')->layout('layouts.admin');
    }
}
