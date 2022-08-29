<?php

namespace App\Models;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_maskapai',
        'nama_maskapai'
    ];

    public function jadwal() {
        return $this->belongsTo(Jadwal::class);
    }
}
