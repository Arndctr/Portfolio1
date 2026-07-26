<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $fillable = ['nama'];

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'batch_divisi');
    }
}
