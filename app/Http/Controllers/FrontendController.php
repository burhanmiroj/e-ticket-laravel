<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maskapai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $maskapais = Maskapai::get();

        return view('welcome', compact(['maskapais']));
    }

    // CARI PENERBANGAN
    public function search(Request $request)
    {
        $query = Jadwal::where('kelas_penerbangan', '=', $request->kelas_penerbangan)
            ->whereDate('jadwal_keberangkatan', '=', Carbon::parse($request->tanggal_berangkat)->format('Y-m-d'))
            ->orWhere('jadwal_pulang', '=', Carbon::parse($request->tanggal_pulang)->format('Y-m-d'))
            ->get();

        return $query;
    }

    
}
