@extends('layouts.app')
@section('content')
    <div class="w-full max-w-screen-custom mx-auto bg-white rounded-md shadow-xl transform -translate-y-20 p-4 md:p-10">
        {{-- HEADING --}}
        <div class="w-full flex justify-between">
            <img src="{{ asset('logo.png') }}" class="w-12" alt="">
            <div class="py-5 md:py-0">
                <h1 class="text-xl md:text-2xl font-bold">E-Ticket</h1>
                <p>Divis airlines</p>
            </div>
        </div>
        {{-- CONTENT --}}
        {{-- <form action="{{ route('frontend.print-ticket') }}" method="POST" class="w-full border border-zinc-300 rounded-md p-4 mt-4 md:mt-10"> --}}
            {{-- @csrf --}}
            <div class="custom-horizontal-scrollbar w-full overflow-x-auto mb-5">
                <table class="w-full whitespace-nowrap table-auto">
                    <tbody class="bg-white dark:divide-slate-700">
                        @forelse ($query as $q)
                            <tr class="text-slate-700 whitespace-nowrap rounded-lg border">
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
                                <td class="px-4 py-3 text-sm flex flex-col space-y-1 mt-3">
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
                            </tr>
                            <input type="hidden" name="harga_tiket" value="{{ $q->harga_tiket }}">
                            {{-- KODE PESAN --}}
                            <tr>
                                <div class="mt-10 text-center">
                                    <div class="w-full p-3 border rounded-lg max-w-screen-md mx-auto text-xl text-center bg-slate-200">
                                        <h1>{{ $kode_booking }}</h1>
                                    </div>
                                    <span class="text-sm font-semibold text-red-500">Salin kode ini, kode ini digunakan untuk check in</span>
                                </div>
                                <div class="w-full flex justify-center space-x-3 mt-5 mb-10">
                                    {{-- BACK BUTTON --}}
                                    <form action="{{ route('frontend.print-ticket') }}">
                                        @csrf
                                        <button type="submit" class="w-full sm:w-48 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-600 focus:ring-2 focus:ring-blue-400 text-white flex justify-center items-center">
                                            <div class="w-12 h-11 grid place-items-center">
                                                <iconify-icon icon="fluent:print-16-regular" class="text-xl"></iconify-icon>
                                            </div>
                                            <span class="text-sm">Print tiket</span>
                                        </button>
                                    </form>
                                    {{-- BACK BUTTON --}}
                                    <a href="{{ route('frontend.print-ticket') }}" class="w-full sm:w-48 pr-5 h-11 transition-all rounded-md bg-gradient-to-tr from-slate-500 to-slate-600 hover:from-slate-600 hover:to-slate-600 focus:ring-2 focus:ring-slate-400 text-white flex justify-center items-center">
                                        <div class="w-12 h-11 grid place-items-center">
                                            <iconify-icon icon="akar-icons:arrow-back" class="text-xl"></iconify-icon>
                                        </div>
                                        <span class="text-sm">Halaman utama</span>
                                    </a>
                                </div>
                            </tr>
                        @empty
                            <p>Oops! Tidak ada penerbangan sesuai pencarian anda</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        {{-- </form> --}}
    </div>
@endsection

@push('scripts')
    <script>
        const printBtn = document.querySelector('#print-btn')
        printBtn.addEventListener('click', function() {
            setTimeout(() => {
                window.location.href = '/'
            }, 1000);
        })
    </script>
@endpush