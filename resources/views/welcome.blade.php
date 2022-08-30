@extends('layouts.app')
@section('content')
    <div class="w-full max-w-screen-custom mx-auto bg-white rounded-md shadow-xl transform -translate-y-20 p-4 md:p-10">
        {{-- HEADING --}}
        <div class="py-5 md:py-0">
            <h1 class="text-xl md:text-2xl font-bold">Travelgo</h1>
            <p>Pesan tiket pesawat mudah disini</p>
        </div>
        {{-- CONTENT --}}
        <form action="{{ route('frontend.search') }}" method="POST" class="w-full border border-zinc-300 rounded-md p-4 md:p-10 mt-4 md:mt-10 grid grid-cols-1 md:grid-cols-3 gap-5">
            @csrf
            {{-- LEFT --}}
            <div class="w-full grid grid-cols-1 md:grid-cols-2 md:col-span-2 gap-5">
                {{-- KOTA ASAL --}}
                <div class="w-full">
                    <label for="kota_asal" class="text-sm text-zinc-500 font-semibold">Kota asal</label>
                    <div class="mt-1 w-full flex items-center transition-all duration-300 border border-zinc-300 hover:border-green-500 rounded-md">
                        <div class="w-14 h-12 rounded-md flex justify-center items-center">
                            <iconify-icon icon="bxs:plane-take-off" class="text-2xl"></iconify-icon>
                        </div>
                        {{-- INPUT --}}
                        <select required name="kota_asal" id="kota_asal" class="w-full border-none shadow-none outline-none text-sm cursor-pointer">
                            <option  @if (old('kota_asal') == "") {{ 'selected' }} @endif disabled>-- Pilih kota asal</option>
                            <option value="semarang" @if ( old('kota_asal') == "semarang") {{ 'selected' }} @endif>Semarang</option>
                            <option value="surabaya" @if ( old('kota_asal') == "surabaya") {{ 'selected' }} @endif>Surabaya</option>
                            <option value="jakarta" @if ( old('kota_asal') == "jakarta") {{ 'selected' }} @endif>Jakarta</option>
                        </select>
                    </div>
                </div>
                {{-- KOTA TUJUAN --}}
                <div class="w-full">
                    <label for="kota_asal" class="text-sm text-zinc-500 font-semibold">Kota tujuan</label>
                    <div class="mt-1 w-full flex items-center transition-all duration-300 border border-zinc-300 hover:border-green-500 rounded-md">
                        <div class="w-14 h-12 rounded-md flex justify-center items-center">
                            <iconify-icon icon="bxs:plane-land" class="text-2xl"></iconify-icon>
                        </div>
                        {{-- INPUT --}}
                        <select required name="kota_tujuan" id="kota_tujuan" class="w-full border-none shadow-none outline-none text-sm cursor-pointer">
                            <option  @if (old('kota_tujuan') == "") {{ 'selected' }} @endif disabled>-- Pilih kota tujuan</option>
                            <option value="semarang" @if ( old('kota_tujuan') == "semarang")  {{ "selected" }} @endif>Semarang</option>
                            <option value="surabaya" @if ( old('kota_tujuan') == "surabaya") {{ 'selected' }} @endif>Surabaya</option>
                            <option value="jakarta" @if ( old('kota_tujuan') == "jakarta")  {{ "selected" }} @endif>Jakarta</option>
                        </select>
                    </div>
                </div>
                {{-- TANGGAL BERANGKAT --}}
                <div class="w-full">
                    <label for="tanggal_berangkat" class="text-sm text-zinc-500 font-semibold">Tanggal berangkat</label>
                    <div class="mt-1 w-full flex items-center transition-all duration-300 border border-zinc-300 hover:border-green-500 rounded-md">
                        <div class="w-14 h-12 rounded-md flex justify-center items-center">
                            <iconify-icon icon="uiw:date" class="text-xl"></iconify-icon>
                        </div>
                        {{-- INPUT --}}
                        <input required type="date" name="tanggal_berangkat" id="tanggal_berangkat" class="w-full border-none shadow-none outline-none text-sm cursor-pointer">
                    </div>
                </div>
                {{-- TANGGAL PULANG --}}
                <div class="w-full">
                    <label for="tanggal_pulang" class="text-sm text-zinc-500 font-semibold">Tanggal pulang</label>
                    <div class="mt-1 w-full flex items-center transition-all duration-300 border border-zinc-300 hover:border-green-500 rounded-md">
                        <div class="w-14 h-12 rounded-md flex justify-center items-center">
                            <iconify-icon icon="uiw:date" class="text-xl"></iconify-icon>
                        </div>
                        {{-- INPUT --}}
                        <input required type="date" name="tanggal_pulang" id="tanggal_pulang" class="w-full border-none shadow-none outline-none text-sm cursor-pointer">
                    </div>
                </div>
            </div>
            {{-- RIGHT --}}
            <div class="w-full grid grid-cols-1 gap-5">
                {{-- KELAS PENERBANGAN --}}
                <div class="w-full">
                    <label for="kelas_penerbangan" class="text-sm text-zinc-500 font-semibold">Kelas penerbangan</label>
                    <div class="mt-1 w-full flex items-center transition-all duration-300 border border-zinc-300 hover:border-green-500 rounded-md">
                        <div class="w-14 h-12 rounded-md flex justify-center items-center">
                            <iconify-icon icon="bxs:plane-take-off" class="text-2xl"></iconify-icon>
                        </div>
                        {{-- INPUT --}}
                        <select required name="kelas_penerbangan" id="kelas_penerbangan" class="w-full border-none shadow-none outline-none text-sm cursor-pointer">
                            <option selected disabled>-- Pilih kelas penerbangan</option>
                            <option value="ekonomi">Ekonomi</option>
                            <option value="premium-ekonomi">Premium Ekonomi</option>
                            <option value="business">Bisnis</option>
                            <option value="first-class">First class</option>
                        </select>
                    </div>
                </div>
                {{-- KOTA ASAL --}}
                <div class="w-full">
                    <label for="jumlah_penumpang" class="text-sm text-zinc-500 font-semibold">Jumlah penumpang</label>
                    <div class="mt-1 w-full flex items-center transition-all duration-300 border border-zinc-300 hover:border-green-500 rounded-md">
                        <div class="w-14 h-12 rounded-md flex justify-center items-center">
                            <iconify-icon icon="fluent:people-12-regular" class="text-2xl"></iconify-icon>
                        </div>
                        {{-- INPUT --}}
                        <input required type="number" min="1" max="100" name="jumlah_penumpang" id="jumlah_penumpang" class="w-full border-none shadow-none outline-none text-sm cursor-pointer" placeholder="Masukkan jumlah penumpang" />
                    </div>
                </div>
            </div>
            {{-- SUBMIT BUTTON --}}
            <div class="w-full flex justify-end md:col-span-3">
                <button type="submit" class="w-full sm:w-auto pr-5 h-12 rounded-md bg-gradient-to-tr from-green-1000 to-green-1100 hover:to-green-1000 text-white flex justify-center md:justify-start items-center">
                    <div class="w-12 h-12 grid place-items-center">
                        <iconify-icon icon="bi:search"></iconify-icon>
                    </div>
                    <span class="text-sm">Cari penerbangan</span>
                </button>
            </div>
            
        </form>
        <hr class="mt-10" />
        {{-- MASKAPAI --}}
        <div class="w-full mt-10">
            <h1 class="text-xl md:text-2xl font-bold">Partner maskapai</h1>
            <p>Partner maskapai penerbangan Dalam & Luar negri</p>
            {{--  --}}
            <div class="w-full grid grid-cols-3 md:grid-cols-6 gap-5 mt-10">
                @foreach ($maskapais as $maskapai)
                    {{-- SINGLE CONTENT --}}
                    <div class="w-full h-14 overflow-hidden rounded-md border">
                        <img src="{{ asset('storage/maskapai/'. $maskapai->logo_maskapai) }}" alt="">
                    </div>
                @endforeach
            </div>
        </div>    
    </div>
@endsection