<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'keterangan',
    ];

    // Relasi ke model Anggota (member)
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // Relasi ke model Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public $showModal = false;
    public $isEdit = false;

    public function openModal()
    {
        $this->resetForm(); // (opsional)
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

}
