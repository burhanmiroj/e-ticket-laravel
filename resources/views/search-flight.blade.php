@extends('layouts.app')
@section('content')
    <div class="w-full max-w-screen-custom mx-auto bg-white rounded-md shadow-xl transform -translate-y-20 p-4 md:p-10">
        <div class="w-full rounded-lg grid grid-cols-3 md:grid-cols-6 gap-5">    
            <div class="w-full flex flex-col justify-center items-center bg-slate-100 rounded-md p-3 md:p-5">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex justify-center items-center">
                    <iconify-icon icon="ic:baseline-flight-takeoff"></iconify-icon>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-bold mb-2 text-center uppercase">Dari</p>
                    <p class="text-sm text-center">{{ $kota_asal }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col justify-center items-center bg-slate-100 rounded-md p-3 md:p-5">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex justify-center items-center">
                    <iconify-icon icon="ic:baseline-flight-land"></iconify-icon>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-bold mb-2 text-center uppercase">Tujuan</p>
                    <p class="text-sm text-center">{{ $kota_tujuan }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col justify-center items-center bg-slate-100 rounded-md p-3 md:p-5">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex justify-center items-center">
                    <iconify-icon icon="icon-park-outline:flight-safety"></iconify-icon>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-bold uppercase mb-2 text-center">Kelas</p>
                    <p class="text-sm text-center">{{ $kelas_penerbangan }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col justify-center items-center bg-slate-100 rounded-md p-3 md:p-5">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex justify-center items-center">
                    <iconify-icon icon="uiw:date"></iconify-icon>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-bold uppercase mb-2 text-center">Berangkat</p>
                    <p class="text-sm text-center">{{ $tanggal_berangkat }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col justify-center items-center bg-slate-100 rounded-md p-3 md:p-5">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex justify-center items-center">
                    <iconify-icon icon="uiw:date"></iconify-icon>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-bold uppercase mb-2 text-center">Pulang</p>
                    <p class="text-sm text-center">{{ $tanggal_pulang }}</p>
                </div>
            </div>
            <div class="w-full flex flex-col justify-center items-center bg-slate-100 rounded-md p-3 md:p-5">
                <div class="w-10 h-10 bg-slate-200 rounded-full flex justify-center items-center">
                    <iconify-icon icon="mdi:seat-passenger"></iconify-icon>
                </div>
                <div class="mt-3">
                    <p class="text-xs font-bold uppercase mb-2 text-center">Kursi dipesan</p>
                    <p class="text-sm text-center">{{ $jumlah_penumpang }}</p>
                </div>
            </div>
        </div>
        <div class="w-full rounded-lg mt-5">
            <form action="{{ route('frontend.booking') }}" method="POST" class="pt-5">
                @csrf
                {{-- NAMA PEMESAN --}}
                <div class="w-full">
                    <label for="nama_pemesan" class="text-sm text-zinc-500 font-semibold">Nama pemesan</label>
                    <div class="relative flex w-full flex-wrap mt-1">
                        <span class="z-10 h-full leading-snug font-normal text-center text-slate-500 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3">
                            <iconify-icon icon="ant-design:user-outlined" class="-mb-0.5"></iconify-icon>
                        </span>
                        <input required type="text" name="nama_pemesan" placeholder="Nama pemesan" class="p-3 placeholder-slate-400 text-slate-600 relative bg-white rounded text-sm focus:outline-none border-slate-300 focus:border-green-1000 w-full pl-10" />
                        @error('nama_pemesan')
                            <span class="text-sm italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="py-5 my-5">
                    <h1 class="text-green-1000 text-xl font-bold">Jadwal penerbangan sesuai pencarian anda :</h1>
                </div>
                <div class="custom-horizontal-scrollbar w-full overflow-x-auto mb-5">
                    <table class="w-full whitespace-nowrap table-auto">
                        <tbody class="bg-white divide-y dark:divide-slate-700 dark:bg-slate-800">
                            @forelse ($query as $q)
                                <tr class="text-slate-700 dark:text-slate-400 whitespace-nowrap border-b rounded-lg">
                                    {{-- LOGO --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="w-full flex items-center space-x-5">
                                            <div class="w-20">
                                                <img src="{{ asset('storage/maskapai/'. $q->maskapai->logo_maskapai) }}" class="h-full" alt="">
                                            </div>
                                            <div class="w-full">
                                                <h1 class="font-semibold">{{ $q->maskapai->nama_maskapai }}</h1>
                                                <p class="text-green-1000 font-semibold">{{ $q->nomor_penerbangan }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- JADWAL KEBERANGKATAN --}}
                                    <td class="px-4 py-3 text-sm flex flex-col space-y-1">
                                        <div class="flex space-x-2">
                                            <iconify-icon icon="ic:baseline-flight-takeoff" class="text-lg"></iconify-icon>
                                            <span class="text-xs"><span class="font-bold text-green-1000">{{ $q->kota_asal }}</span> {{ \Carbon\Carbon::parse($q->jadwal_keberangkatan)->format('d-m-Y h:m') }}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <iconify-icon icon="ic:baseline-flight-land" class="text-lg"></iconify-icon>
                                            <span class="text-xs"><span class="font-bold text-green-1000">{{ $q->kota_tujuan }}</span> {{ \Carbon\Carbon::parse($q->jadwal_pulang)->format('d-m-Y h:m') }}</span>
                                        </div>
                                    </td>
                                    {{-- JADWAL PULANG --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-2">
                                            <span class="font-semibold text-green-1000">Harga tiket</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            Rp. {{ number_format($q->harga_tiket) }}
                                        </div>
                                    </td>
                                    {{-- KELAS PENERBANGAN --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-2">
                                            <span class="font-semibold text-green-1000">Kelas penerbangan</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            {{ $q->kelas_penerbangan }}
                                        </div>
                                    </td>
                                    {{-- ACTION --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex justify-end space-x-2">
                                            {{-- ORDER ID --}}
                                            <input type="hidden" name="jadwal_id" value="{{ $q->id }}" />
                                            {{-- KOTA ASAL --}}
                                            <input type="hidden" name="kota_asal" value="{{ $kota_asal }}" />
                                            {{-- KOTA TUJUAN --}}
                                            <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}" />
                                            {{-- KELAS PENERBANGAn --}}
                                            <input type="hidden" name="kelas_penerbangan" value="{{ $kelas_penerbangan }}" />
                                            {{-- TANGGAL BERANGKAT --}}
                                            <input type="hidden" name="tanggal_berangkat" value="{{ $tanggal_berangkat }}" />
                                            {{-- TANGGAL PULANG --}}
                                            <input type="hidden" name="tanggal_pulang" value="{{ $tanggal_pulang }}" />
                                            {{-- JUMLAH PENUMPANG --}}
                                            <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}" />
                                            <button type="submit" class="w-32 h-10 transition-all duration-300 bg-green-1000 hover:bg-green-900 focus:ring-2 focus:ring-green-500 flex justify-center items-center text-white rounded-md">
                                                <iconify-icon icon="ic:baseline-shopping-cart-checkout"></iconify-icon>
                                                <span class="ml-1">Pesan tiket</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>Oops! Tidak ada penerbangan sesuai pencarian anda</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
@endsection