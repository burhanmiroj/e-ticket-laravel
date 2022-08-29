<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maskapai;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $maskapais = Maskapai::get();

        return view('welcome', compact(['maskapais']));
    }
    
    public function search(Request $request)
    {
        $kota_asal = $request->kota_asal; 
        $kota_tujuan = $request->kota_tujuan; 
        $kelas_penerbangan = $request->kelas_penerbangan; 
        $tanggal_berangkat = $request->tanggal_berangkat; 
        $tanggal_pulang = $request->tanggal_pulang; 
        $jumlah_penumpang = $request->jumlah_penumpang; 

        $query = Jadwal::whereDate('jadwal_keberangkatan', '=', Carbon::parse($request->tanggal_berangkat)->format('Y-m-d'))
            // ->where('jadwal_pulang', '=', Carbon::parse($request->tanggal_pulang)->format('Y-m-d'))
            ->where('kota_asal', '=', $request->kota_asal)
            ->where('kota_tujuan', '=', $request->kota_tujuan)
            ->where('kelas_penerbangan', '=', $request->kelas_penerbangan)
            ->get();

        // dd($query);
        return view('search-flight', compact(['query', 'kota_asal', 'kota_tujuan', 'kelas_penerbangan', 'tanggal_berangkat', 'tanggal_pulang', 'jumlah_penumpang']));
    }
    
    // public function searchPage(Request $request)
    // {
    //     $datas = $request->query;

    //     return view('search-flight', compact(['datas']));
    // }

}
