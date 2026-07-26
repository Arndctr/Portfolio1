<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batches';

    protected $fillable = [
        'nama_batch',
        'tanggal_mulai',
        'tanggal_selesai',
        'tanggal_admin_mulai',
        'tanggal_admin_selesai',
        'tanggal_wawancara_mulai',
        'tanggal_wawancara_selesai',
        'tanggal_pengumuman',
        'kuota',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_admin_mulai' => 'date',
        'tanggal_admin_selesai' => 'date',
        'tanggal_wawancara_mulai' => 'date',
        'tanggal_wawancara_selesai' => 'date',
        'tanggal_pengumuman' => 'date',
        'kuota' => 'integer',
    ];

    public function scopeActive($query)
    {
        $today = Carbon::today();
        return $query->where('tanggal_mulai', '<=', $today)
                     ->where('tanggal_selesai', '>=', $today);
    }

    public function isQuotaFull()
    {
        if (!$this->kuota) {
            return false;
        }

        if (isset($this->peserta_count)) {
            return $this->peserta_count >= $this->kuota;
        }

        return $this->peserta()->count() >= $this->kuota;
    }

    public function isRegistrationOpen()
    {
        return $this->isOpen() && !$this->isQuotaFull();
    }

    public function getTimelineStepsAttribute()
    {
        return [
            [
                'title' => 'Pendaftaran',
                'date' => $this->tanggal_mulai && $this->tanggal_selesai
                    ? $this->tanggal_mulai->format('d M Y').' – '.$this->tanggal_selesai->format('d M Y')
                    : 'Tanggal belum ditentukan',
            ],
            [
                'title' => 'Seleksi Administrasi',
                'date' => $this->tanggal_admin_mulai && $this->tanggal_admin_selesai
                    ? $this->tanggal_admin_mulai->format('d M Y').' – '.$this->tanggal_admin_selesai->format('d M Y')
                    : ($this->tanggal_admin_mulai ? $this->tanggal_admin_mulai->format('d M Y').' – Menunggu' : 'Menunggu penetapan'),
            ],
            [
                'title' => 'Wawancara',
                'date' => $this->tanggal_wawancara_mulai && $this->tanggal_wawancara_selesai
                    ? $this->tanggal_wawancara_mulai->format('d M Y').' – '.$this->tanggal_wawancara_selesai->format('d M Y')
                    : ($this->tanggal_wawancara_mulai ? $this->tanggal_wawancara_mulai->format('d M Y').' – Menunggu' : 'Menunggu penetapan'),
            ],
            [
                'title' => 'Pengumuman',
                'date' => $this->tanggal_pengumuman
                    ? $this->tanggal_pengumuman->format('d M Y')
                    : 'Segera diumumkan',
            ],
        ];
    }

    public function isExpired()
    {
        return Carbon::today()->gt($this->tanggal_selesai);
    }

    public function isUpcoming()
    {
        return Carbon::today()->lt($this->tanggal_mulai);
    }

    public function isOpen()
    {
        $today = Carbon::today();
        return $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class, 'batch_id');
    }

    public function divisi()
    {
        return $this->belongsToMany(Divisi::class, 'batch_divisi');
    }

    public function getStatusAttribute()
    {
        if ($this->isUpcoming()) {
            return 'belum_dibuka';
        }

        if ($this->isOpen()) {
            return 'dibuka';
        }

        return 'ditutup';
    }
}
