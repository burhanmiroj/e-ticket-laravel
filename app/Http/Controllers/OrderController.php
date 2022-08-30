<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maskapai;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'jadwal_id' => $request->jadwal_id,
            'nama_pemesan' => $request->nama_pemesan,
            'nomor_whatsapp' => $request->nomor_whatsapp,
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'tanggal_berangkat' => $request->tanggal_berangkat,
            'tanggal_pulang' => $request->tanggal_pulang,
            'kelas_penerbangan' => $request->kelas_penerbangan,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'kode_booking' => Str::upper(Str::random(5)) . '-' . Str::upper(Str::random(5)) . '-' . Str::upper(Str::random(5)),
        ]);

        $kota_asal = $request->kota_asal; 
        $kota_tujuan = $request->kota_tujuan; 
        $kelas_penerbangan = $request->kelas_penerbangan; 
        $tanggal_berangkat = $request->tanggal_berangkat; 
        $tanggal_pulang = $request->tanggal_pulang; 
        $jumlah_penumpang = $request->jumlah_penumpang; 

        
        // foreach ($jadwals as $jadwal) {
        // }

        $query = Jadwal::whereDate('jadwal_keberangkatan', '=', Carbon::parse($request->tanggal_berangkat)->format('Y-m-d'))
            // ->where('jadwal_pulang', '=', Carbon::parse($request->tanggal_pulang)->format('Y-m-d'))
            ->where('kota_asal', '=', $request->kota_asal)
            ->where('kota_tujuan', '=', $request->kota_tujuan)
            ->where('kelas_penerbangan', '=', $request->kelas_penerbangan)
            ->limit(1)
            ->get();
            
        //  
        $total_pay = $request->jumlah_penumpang * $request->harga_tiket;
        
        Alert::success('Berhasil', 'Berhasil memesan penerbangan!');

        return view('print.confirm-print', compact(['order', 'query', 'kota_asal', 'kota_tujuan', 'kelas_penerbangan', 'tanggal_berangkat', 'tanggal_pulang', 'jumlah_penumpang', 'total_pay']));
    }
    
    // public function success(Request $request)
    // {
    //     $harga_tiket = $request->harga_tiket;
    //     // $total_harga = $request->harga_tiket ;

    //     return view('print.e-ticket', compact(['total_harga']));
    // }
    
    public function print(Request $request)
    {
        $total_harga = $request->jumlah_penumpang * $request->harga_tiket;
        $order = Order::latest()->first();
        $maskapai = Maskapai::where('id', $request->maskapai_id)->first();

        // return view('print.e-ticket', compact(['total_harga', 'order', 'maskapai']));
        // dd($order);

        // dd($order_id);
        // $order = Order::where('id', $order_id)->get();

        $pdf = Pdf::loadView('print.e-ticket', [$total_harga, $order, $maskapai]);
        
        
        // DOWNLOAD PDF 
        return $pdf->download('e-ticket.pdf');
    }
}

