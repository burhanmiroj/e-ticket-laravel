<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'maskapai_id',
        'kota_asal',
        'kota_tujuan',
        'harga_tiket',
        'jadwal_keberangkatan',
        'jadwal_pulang',
        'nomor_penerbangan',
        'kelas_penerbangan',
        'jumlah_kursi',
    ];

    public function maskapai() {
        return $this->belongsTo(Maskapai::class);
    }
}
