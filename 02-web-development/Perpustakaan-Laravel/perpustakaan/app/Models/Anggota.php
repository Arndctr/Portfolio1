<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'nama',
        'status',
        'role',
        'nis_nip',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'email',
        'plain_password',
        'email_verified_at',
    ];

    protected $dates = [
        'email_verified_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nis_nip', 'nis_nip');
    }


    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }

    public function getNisAttribute()
    {
        return $this->role === 'siswa' ? $this->nis_nip : null;
    }

    public function getNipAttribute()
    {
        return $this->role === 'guru' ? $this->nis_nip : null;
    }
}
