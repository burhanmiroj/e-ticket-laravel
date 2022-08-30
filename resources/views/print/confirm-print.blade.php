@extends('layouts.app')
@section('content')
    <div class="w-full max-w-screen-custom mx-auto bg-white rounded-md shadow-xl transform -translate-y-20 p-4 md:p-10">
        {{-- HEADING --}}
        <div class="py-5 md:py-0">
            <h1 class="text-xl md:text-2xl font-bold">Print tiket anda</h1>
            <p>Print tiket, simpan kode booking dengan baik</p>
        </div>
        {{-- CONTENT --}}
        <form action="{{ route('frontend.print-ticket') }}" method="POST" class="w-full border border-zinc-300 rounded-md p-4 mt-4 md:mt-10">
            @csrf
            <div class="custom-horizontal-scrollbar w-full overflow-x-auto mb-5">
                <table class="w-full whitespace-nowrap table-auto">
                    <tbody class="bg-white dark:divide-slate-700">
                        @forelse ($query as $q)
                            <tr class="text-slate-700 whitespace-nowrap rounded-lg">
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
                                        {{-- MASKAPAI --}}
                                        <input type="hidden" name="maskapai_id" value="{{ $q->maskapai->id }}" />
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
                                        <button id="print-btn" type="submit" class="w-full sm:w-auto pr-5 h-12 rounded-md bg-gradient-to-tr from-green-1000 to-green-1100 hover:to-green-1000 text-white flex justify-center md:justify-start items-center">
                                            <div class="w-12 h-12 grid place-items-center">
                                                <iconify-icon icon="fa6-regular:file-pdf"></iconify-icon>
                                            </div>
                                            <span class="text-sm">Print tiket</span>
                                        </button>
                                        {{-- <button type="submit" class="w-32 h-10 transition-all duration-300 bg-green-1000 hover:bg-green-900 focus:ring-2 focus:ring-green-500 flex justify-center items-center text-white rounded-md">
                                            <iconify-icon icon="ic:baseline-shopping-cart-checkout"></iconify-icon>
                                            <span class="ml-1">Pesan tiket</span>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            <input type="hidden" name="harga_tiket" value="{{ $q->harga_tiket }}">
                            {{-- <input type="hidden" name="order_id" value="{{ $q->jumlah_penumpang }}"> --}}
                        @empty
                            <p>Oops! Tidak ada penerbangan sesuai pencarian anda</p>
                        @endforelse
                        {{-- <tr class="text-slate-700 whitespace-nowrap rounded-lg">Total tagihan : Rp. {{ number_format($total_pay) }}</tr> --}}
                    </tbody>
                </table>
            </div>
        </form>
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