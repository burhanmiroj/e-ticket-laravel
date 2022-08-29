<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalPenerbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Jadwal::paginate(5);

        return view('admin.jadwal-penerbangan.index', compact(['schedules']));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maskapais = Maskapai::get();

        return view('admin.jadwal-penerbangan.create', compact(['maskapais']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'maskapai_id' => 'required',
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'harga_tiket' => 'required',
            'jadwal_keberangkatan' => 'required',
            'jadwal_pulang' => 'required',
            'kelas_penerbangan' => 'required',
            'jumlah_kursi' => 'required',
            'kelas_penerbangan' => 'required',
        ]);
        
        Jadwal::create([
            'maskapai_id' => $request->maskapai_id,
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'harga_tiket' => $request->harga_tiket,
            'jadwal_keberangkatan' => $request->jadwal_keberangkatan,
            'jadwal_pulang' => $request->jadwal_pulang,
            'kelas_penerbangan' => $request->kelas_penerbangan,
            'jumlah_kursi' => $request->jumlah_kursi,
            'nomor_penerbangan' => Str::upper(Str::random(2)) . '-' . Str::upper(Str::random(5)),
        ]);

        Alert::success('Berhasil', 'Berhasil menambah jadwal penerbangan!');
        return redirect()->route('jadwal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maskapais = Maskapai::get();
        $schedule = Jadwal::find($id);

        return view('admin.jadwal-penerbangan.edit', compact(['maskapais', 'schedule']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = Jadwal::find($id);

        $request->validate([
            'maskapai_id' => 'required',
            'kota_asal' => 'required',
            'kota_tujuan' => 'required',
            'harga_tiket' => 'required',
            'jadwal_keberangkatan' => 'required',
            'jadwal_pulang' => 'required',
            'kelas_penerbangan' => 'required',
            'jumlah_kursi' => 'required',
            'kelas_penerbangan' => 'required',
        ]);
        
        if(empty($request->nomor_penerbangan)) {
            $nomorPenerbangan = $schedule->nomor_penerbangan;
        } else {
            $nomorPenerbangan = Str::random(2) . '-' . Str::random(5);
        }

        Jadwal::where('id', $id)->update([
            'maskapai_id' => $request->maskapai_id,
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'harga_tiket' => $request->harga_tiket,
            'jadwal_keberangkatan' => $request->jadwal_keberangkatan,
            'jadwal_pulang' => $request->jadwal_pulang,
            'kelas_penerbangan' => $request->kelas_penerbangan,
            'jumlah_kursi' => $request->jumlah_kursi,
            'nomor_penerbangan' => $nomorPenerbangan,
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data jadwal!');
        return redirect()->route('jadwal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jadwal::where('id', $id)->delete();

        Alert::success('Berhasil', 'Berhasil menghapus data!');
        return redirect()->route('jadwal.index');
    }
}
