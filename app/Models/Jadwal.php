<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'maskapai_id',
        'jadwal_keberangkatan',
        'jadwal_pulang',
        'nomor_penerbangan',
        'kelas_penerbangan',
    ];

    public function maskapai() {
        return $this->belongsTo(Maskapai::class);
    }
}
