<?php

namespace App\Http\Controllers;

use App\Models\Checkin;
use App\Models\Jadwal;
use App\Models\Maskapai;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        Checkin::create([
            'status' => false
        ]);
        $checkin_latest = Checkin::latest()->first();

        $order = Order::create([
            'checkin_id' => $checkin_latest->id,
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

        $query = Jadwal::whereDate('jadwal_keberangkatan', '=', Carbon::parse($request->tanggal_berangkat)->format('Y-m-d'))
            ->where('kota_asal', '=', $request->kota_asal)
            ->where('kota_tujuan', '=', $request->kota_tujuan)
            ->where('kelas_penerbangan', '=', $request->kelas_penerbangan)
            ->limit(1)
            ->get();
            
        $kode_booking = Order::latest()->first()->kode_booking;    
        
        return view('print.confirm-print', compact(['order', 'query', 'kota_asal', 'kota_tujuan', 'kelas_penerbangan', 'tanggal_berangkat', 'tanggal_pulang', 'jumlah_penumpang', 'kode_booking']));
    }
    
    public function cekBooking(Request $request)
    {
        $order = Order::where('kode_booking', $request->kode_booking)->first();

        return view('checkin', compact(['order']));
    }
    
    public function checkin(Request $request)
    {
        $checkin_id = Order::where('checkin_id', $request->checkin_id)->first();
        
        Checkin::where('id', $checkin_id->id)->update([
            'status' => 1
        ]);

        Alert::success('Berhasil', 'Berhasil melakukan cekin!');

        return redirect()->route('frontend.index');
    }
    
    public function print(Request $request)
    {
        // $order = Order::where('checkin_id', $request->checkin_id)->first();

        // // dd($order);
        // $pdf = PDF::loadView('print.e-ticket', compact('order'));        
    
        // // // DOWNLOAD PDF 
        // // return $pdf->download('e-ticket.pdf');
        // // view()->share('print.e-ticket', compact('order'));
        // // $pdf = PDF::loadView('print.e-ticket', compact('order'));
        // // // download PDF file with download method
        // return $pdf->download('pdf_file.pdf');
        $pdf = PDF::loadView('print.e-ticket');
        return $pdf->download('invoice.pdf');
    }
}

