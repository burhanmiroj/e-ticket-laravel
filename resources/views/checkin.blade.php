@extends('layouts.app')
@section('content')
    <div class="w-full max-w-screen-custom mx-auto bg-white rounded-md shadow-xl transform -translate-y-20 p-4 md:p-10">
        {{-- <p>{{ $order->checkin->status }}</p> --}}
        {{-- <p>{{ dd($order) }}</p> --}}
        @if($order == [])
            <h1>Tidak ada tiket dengan kode booking tersebut!</h1>
            {{-- SUBMIT BUTTON --}}
            <a href="{{ route('frontend.index') }}" class="mt-5 w-full sm:w-48 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-green-1000 to-green-1100 hover:to-green-1000 focus:ring-2 focus:ring-green-400 text-white flex justify-center items-center">
                <div class="w-12 h-11 grid place-items-center">
                    <iconify-icon icon="akar-icons:arrow-back" class="text-xl"></iconify-icon>
                </div>
                <span class="text-sm">Kembali</span>
            </a>
        @else
            <div class="custom-horizontal-scrollbar w-full overflow-x-auto mb-5">
                <table class="w-full whitespace-nowrap table-auto">
                    <tbody class="bg-white divide-y dark:divide-slate-700 dark:bg-slate-800">
                        <tr class="text-slate-700 dark:text-slate-400 whitespace-nowrap border-b rounded-lg">
                            {{-- LOGO --}}
                            <td class="px-4 py-3 text-sm">
                                <div class="w-full flex items-center space-x-5">
                                    <div class="w-20">
                                        <img src="{{ asset('storage/maskapai/'. $order->jadwal->maskapai->logo_maskapai) }}" class="h-full" alt="">
                                    </div>
                                    <div class="w-full">
                                        <h1 class="font-semibold">{{ $order->jadwal->maskapai->nama_maskapai }}</h1>
                                        <p class="text-green-1000 font-semibold">{{ $order->jadwal->nomor_penerbangan }}</p>
                                    </div>
                                </div>
                            </td>
                            {{-- NAMA PEMESAN --}}
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <span class="text-sm"><span class="font-bold text-green-1000">{{ $order->nama_pemesan}}</span></span>
                                </div>
                                <div class="flex space-x-2">
                                    <span class="text-sm"><span class="font-bold text-green-1000">{{ $order->nomor_whatsapp}}</span></span>
                                </div>
                            </td>
                            {{-- JADWAL KEBERANGKATAN --}}
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <iconify-icon icon="ic:baseline-flight-takeoff" class="text-lg"></iconify-icon>
                                    <span class="text-xs"><span class="font-bold text-green-1000">{{ $order->kota_asal }}</span> {{ \Carbon\Carbon::parse($order->jadwal_keberangkatan)->format('d-m-Y h:m') }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <iconify-icon icon="ic:baseline-flight-land" class="text-lg"></iconify-icon>
                                    <span class="text-xs"><span class="font-bold text-green-1000">{{ $order->kota_tujuan }}</span> {{ \Carbon\Carbon::parse($order->jadwal_pulang)->format('d-m-Y h:m') }}</span>
                                </div>
                            </td>
                            {{-- JADWAL PULANG --}}
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <span class="font-semibold text-green-1000">Harga tiket</span>
                                </div>
                                <div class="flex space-x-2">
                                    Rp. {{ number_format($order->jumlah_penumpang * $order->jadwal->harga_tiket) }}
                                </div>
                            </td>
                            {{-- KELAS PENERBANGAN --}}
                            <td class="px-4 py-3 text-sm">
                                <div class="flex space-x-2">
                                    <span class="font-semibold text-green-1000">Kelas penerbangan</span>
                                </div>
                                <div class="flex space-x-2">
                                    {{ $order->kelas_penerbangan }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{--  --}}
                <div class="mt-10">
                    @if ($order->checkin->status == 0)
                        <form action="{{ route('frontend.cekin') }}" method="POST" class="w-full flex flex-col items-center">
                            @csrf
                            <input type="hidden" name="checkin_id" value="{{ $order->checkin->id }}">
                            <div class="w-96 text-center rounded-lg bg-red-200 text-red-500 py-4">
                                Anda belum melakukan checkin
                            </div>
                            {{-- SUBMIT BUTTON --}}
                            <button type="submit" class="mt-5 w-full sm:w-48 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-green-1000 to-green-1100 hover:to-green-1000 focus:ring-2 focus:ring-green-400 text-white flex justify-center items-center">
                                <div class="w-12 h-11 grid place-items-center">
                                    <iconify-icon icon="fluent:save-20-regular" class="text-xl"></iconify-icon>
                                </div>
                                <span class="text-sm">Check in sekarang</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('frontend.print-ticket') }}" class="w-full flex flex-col items-center">
                            @csrf
                            <input type="hidden" name="checkin_id" value="{{ $order->checkin->id }}">
                            <div class="w-96 text-center rounded-lg bg-green-200 text-green-500 py-4">
                                Anda sudah checkin
                            </div>
                            <div class="flex space-x-3 items-center">
                                {{-- SUBMIT BUTTON --}}
                                <button type="submit" class="mt-5 w-full sm:w-48 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-green-1000 to-green-1100 hover:to-green-1000 focus:ring-2 focus:ring-green-400 text-white flex justify-center items-center">
                                    <div class="w-12 h-11 grid place-items-center">
                                        <iconify-icon icon="akar-icons:cloud-download" class="text-xl"></iconify-icon>
                                    </div>
                                    <span class="text-sm">Cetak Board Pass</span>
                                </button>
                                {{-- SUBMIT BUTTON --}}
                                <a href="{{ route('frontend.index') }}" class="mt-5 w-full sm:w-48 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-600 focus:ring-2 focus:ring-slate-400 text-white flex justify-center items-center">
                                    <div class="w-12 h-11 grid place-items-center">
                                        <iconify-icon icon="akar-icons:arrow-back" class="text-xl"></iconify-icon>
                                    </div>
                                    <span class="text-sm">Halaman utama</span>
                                </a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection