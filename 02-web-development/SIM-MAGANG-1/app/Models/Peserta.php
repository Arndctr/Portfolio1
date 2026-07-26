<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';

    protected $fillable = [
        'nama',
        'email',
        'whatsapp',
        'universitas',
        'prodi',
        'sosial_media',
        'usaha_bisnis',
        'jenis_magang',
        'durasi_magang',
        'cv',
        'khs',
        'bukti_follow',
        'portfolio',
        'periode_mulai',
        'periode_selesai',
        'divisi1',
        'divisi2',
        'divisi_diterima',
        'status',
        'batch_id',
        'foto'
    ];

    protected $casts = [
        'periode_mulai' => 'date',
        'periode_selesai' => 'date'
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function divisiUtama()
    {
        return $this->belongsTo(Divisi::class, 'divisi1');
    }

    public function divisiTambahan()
    {
        return $this->belongsTo(Divisi::class, 'divisi2');
    }

    public function diterimaDi()
    {
        return $this->belongsTo(Divisi::class, 'divisi_diterima');
    }
}
