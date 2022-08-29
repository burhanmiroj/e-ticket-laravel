<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class MaskapaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maskapais = Maskapai::get();
        
        return view('admin.maskapai.index', compact(['maskapais']));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maskapai.create');
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
            'logo_maskapai' => 'required|mimes:jpg,png,svg,jpeg',
            'nama_maskapai' => 'required',
        ]);;

        $logoName = Str::random(20) . '.' . $request->logo_maskapai->getClientOriginalExtension();
        $request->file('logo_maskapai')->storeAs('public/maskapai', $logoName);

        Maskapai::create([
            'logo_maskapai' => $logoName,
            'nama_maskapai' => $request->nama_maskapai,
        ]);

        Alert::success('Berhasil', 'Berhasil menambah data maskapai!');
        return redirect()->route('maskapai.index');
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
        $maskapai = Maskapai::find($id);

        return view('admin.maskapai.edit', compact(['maskapai']));
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
        $request->validate([
            'nama_maskapai' => 'required',
        ]);;

        $maskapai = Maskapai::find($id);

        if($request->has('logo_maskapai')) {
            if(File::exists('storage/maskapai/' . $maskapai->logo_maskapai)) {
                File::delete('storage/maskapai/' . $maskapai->logo_maskapai);
            }
            
            $logoName = Str::random(20) . '.' . $request->logo_maskapai->getClientOriginalExtension();
            $request->file('logo_maskapai')->storeAs('public/maskapai', $logoName);
        } else {
            $logoName = $maskapai->logo_maskapai;
        }

        Maskapai::where('id', $id)->update([
            'logo_maskapai' => $logoName,
            'nama_maskapai' => $request->nama_maskapai,
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data maskapai!');
        return redirect()->route('maskapai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maskapai = Maskapai::where('id', $id)->first();
        if(File::exists('storage/maskapai/' . $maskapai->logo_maskapai)) {
            File::delete('storage/maskapai/' . $maskapai->logo_maskapai);
        }

        Maskapai::where('id', $id)->delete();

        Alert::success('Berhasil', 'Berhasil menghapus data!');
        return redirect()->route('maskapai.index');
    }
}
