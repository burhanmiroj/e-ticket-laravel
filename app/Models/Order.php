<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'nama_pemesan',
        'kota_asal',
        'kota_tujuan',
        'tanggal_berangkat',
        'tanggal_pulang',
        'kelas_penerbangan',
        'jumlah_penumpang',
        'kode_booking',
    ];
}
