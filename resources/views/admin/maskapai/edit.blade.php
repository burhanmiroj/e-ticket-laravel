@extends('layouts.admin')
@section('content')
    <div class="py-5">
        <div class="w-full">
            <h1 class="text-xl md:text-2xl font-bold">Maskapai</h1>    
            <p>Edit data maskapai penerbangan</p>
        </div>
        <form action="{{ route('maskapai.update', $maskapai->id) }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col space-y-5 mt-5">
            @csrf
            @method('PUT')
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="logo_maskapai" class="text-sm text-zinc-500 font-semibold">Logo maskapai</label>
                <div class="relative flex w-full space-x-5 mt-1">
                    <img src="{{ asset('storage/maskapai/'. $maskapai->logo_maskapai) }}"  class="w-12 h-12 rounded-full overflow-hidden border border-green-500" alt="Logo maskapai {{ $maskapai->nama_maskapai }}">
                    <input type="file" name="logo_maskapai" class="py-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000"/>
                    @error('logo_maskapai')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="nama_maskapai" class="text-sm text-zinc-500 font-semibold">Nama maskapai</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="simple-icons:ethiopianairlines"></iconify-icon>
                    </span>
                    <input type="text" name="nama_maskapai" value="{{ $maskapai->nama_maskapai }}" placeholder="Nama maskapai" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10"/>
                    @error('nama_maskapai')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- BUTTON --}}
            <div class="w-full flex items-center space-x-3">
                {{-- SUBMIT BUTTON --}}
                <button type="submit" class="w-full sm:w-40 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-green-1000 to-green-1100 hover:to-green-1000 focus:ring-2 focus:ring-green-400 text-white flex justify-center items-center">
                    <div class="w-12 h-11 grid place-items-center">
                        <iconify-icon icon="fluent:save-20-regular" class="text-xl"></iconify-icon>
                    </div>
                    <span class="text-sm">Simpan data</span>
                </button>
                {{-- CANCEL BUTTON --}}
                <a href="{{ route('maskapai.index') }}" class="w-full sm:w-40 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-slate-600 to-slate-500 hover:to-slate-600 focus:ring-2 focus:ring-slate-400 text-white flex justify-center items-center">
                    <div class="w-12 h-11 grid place-items-center">
                        <iconify-icon icon="bi:arrow-left" class="text-xl"></iconify-icon>
                    </div>
                    <span class="text-sm">Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection