@extends('layouts.admin')
@section('content')
    <div class="py-5">
        <div class="w-full">
            <h1 class="text-xl md:text-2xl font-bold">Jadwal penerbangan</h1>    
            <p>Edit jadwal penerbangan</p>
        </div>
        <form action="{{ route('jadwal.update', $schedule->id) }}" method="POST" class="w-full grid grid-cols-1 gap-5 mt-5">
            @csrf
            @method('PUT')
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="kota_asal" class="text-sm text-zinc-500 font-semibold">Kota asal</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="charm:map-pin" class="-mb-0.5"></iconify-icon>
                    </span>
                    <input type="text" name="kota_asal" placeholder="Kota asal" value="{{ $schedule->kota_asal }}" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10" />
                    @error('kota_asal')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="kota_tujuan" class="text-sm text-zinc-500 font-semibold">Kota tujuan</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="charm:map-pin" class="-mb-0.5"></iconify-icon>
                    </span>
                    <input type="text" name="kota_tujuan" placeholder="Kota tujuan" value="{{ $schedule->kota_tujuan }}" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10" />
                    @error('kota_tujuan')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="maskapai_id" class="text-sm text-zinc-500 font-semibold">Nama maskapai</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="simple-icons:ethiopianairlines"></iconify-icon>
                    </span>
                    <select name="maskapai_id" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10">
                        <option selected disabled>-- Pilih maskapai</option>
                        @foreach ($maskapais as $maskapai)
                            <option {{ $schedule->maskapai->id ? 'selected' : '' }} value="{{ $maskapai->id }}">{{ $maskapai->nama_maskapai }}</option>
                        @endforeach
                    </select>
                    @error('maskapai_id')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="jadwal_keberangkatan" class="text-sm text-zinc-500 font-semibold">Jadwal keberangkatan</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="uiw:date"></iconify-icon>
                    </span>
                    <input type="datetime-local" name="jadwal_keberangkatan" value="{{ $schedule->jadwal_keberangkatan }}" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10"/>
                    @error('jadwal_keberangkatan')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="jadwal_pulang" class="text-sm text-zinc-500 font-semibold">Jadwal pulang</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="uiw:date"></iconify-icon>
                    </span>
                    <input type="datetime-local" name="jadwal_pulang" value="{{ $schedule->jadwal_pulang }}" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10"/>
                    @error('jadwal_pulang')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="harga_tiket" class="text-sm text-zinc-500 font-semibold">Harga tiket</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="clarity:dollar-line" class="-mb-0.5"></iconify-icon>
                    </span>
                    <input type="number" name="harga_tiket" placeholder="Harga tiket" value="{{ $schedule->harga_tiket }}" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10" />
                    @error('harga_tiket')
                        <span class="text-sm italic text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- SINGLE INPUT --}}
            <div class="w-full">
                <label for="kelas_penerbangan" class="text-sm text-zinc-500 font-semibold">Kelas penerbangan</label>
                <div class="relative flex w-full flex-wrap mt-1">
                    <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                        <iconify-icon icon="simple-icons:ethiopianairlines"></iconify-icon>
                    </span>
                    <select name="kelas_penerbangan" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10">
                        <option selected disabled>-- Pilih kelas</option>
                        <option {{ $schedule->kelas_penerbangan == 'ekonomi' ? 'selected' : '' }} value="ekonomi">Ekonomi</option>
                        <option {{ $schedule->kelas_penerbangan == 'premium-ekonomi' ? 'selected' : '' }} value="premium-ekonomi">Premium Ekonomi</option>
                        <option {{ $schedule->kelas_penerbangan == 'business' ? 'selected' : '' }} value="business">Bisnis</option>
                        <option {{ $schedule->kelas_penerbangan == 'first-class' ? 'selected' : '' }} value="first-class">First class</option>
                    </select>
                    @error('kelas_penerbangan')
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
                <a href="{{ route('jadwal.index') }}" class="w-full sm:w-40 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-slate-600 to-slate-500 hover:to-slate-600 focus:ring-2 focus:ring-slate-400 text-white flex justify-center items-center">
                    <div class="w-12 h-11 grid place-items-center">
                        <iconify-icon icon="bi:arrow-left" class="text-xl"></iconify-icon>
                    </div>
                    <span class="text-sm">Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection