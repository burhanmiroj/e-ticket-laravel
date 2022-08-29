@extends('layouts.admin')
@section('content')
    <div class="py-5">
        <div class="flex justify-between items-center py-5">
            <div class="w-full">
                <h1 class="text-xl md:text-2xl font-bold">Jadwal penerbangan</h1>    
                <p>Lihat daftar jadwal penerbangan</p>
            </div>
            <div class="w-auto flex justify-end">
                <a href="{{ route('jadwal.create') }}" class="w-10 h-10 transition-all duration-300 bg-green-1000 hover:bg-green-1100 focus:ring-2 focus:ring-green-500 text-white rounded-md flex justify-center items-center">
                    <iconify-icon icon="ci:add-to-queue" ></iconify-icon>
                </a>
            </div>
        </div>
        {{--  --}}
        <div class="w-full mt-5">
            <div class="w-full overflow-hidden rounded-lg mt-5">
                <div class="custom-horizontal-scrollbar w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap table-auto">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-slate-500 uppercase border-b bg-slate-100 whitespace-nowrap">
                                <th class="p-4">ID</th>
                                <th class="p-4">Nama maskapai</th>
                                <th class="p-4">Jadwal keberangkatan</th>
                                <th class="p-4">Jadwal pulang</th>
                                <th class="p-4">Kelas penerbangan</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-slate-700 dark:bg-slate-800">
                            @forelse ($schedules as $schedule)
                                <tr class="text-slate-700 dark:text-slate-400 whitespace-nowrap">
                                    {{-- ID --}}
                                    <td class="px-4 py-3 text-sm">
                                        {{ $schedule->id }}
                                    </td>
                                    {{-- LOGO --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="w-full flex items-center space-x-5">
                                            <div class="h-10">
                                                <img src="{{ asset('storage/maskapai/'. $schedule->maskapai->logo_maskapai) }}" class="h-full" alt="">
                                            </div>
                                            <div class="w-full">
                                                <h1 class="font-semibold">{{ $schedule->maskapai->nama_maskapai }}</h1>
                                                <p class="text-green-1000 font-semibold">{{ $schedule->nomor_penerbangan }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- JADWAL KEBERANGKATAN --}}
                                    <td class="px-4 py-3 text-sm">
                                        {{ $schedule->jadwal_keberangkatan }}
                                    </td>
                                    {{-- JADWAL PULANG --}}
                                    <td class="px-4 py-3 text-sm">
                                        {{ $schedule->jadwal_pulang }}
                                    </td>
                                    {{-- KELAS PENERBANGAN --}}
                                    <td class="px-4 py-3 text-sm">
                                        {{ $schedule->kelas_penerbangan }}
                                    </td>
                                    {{-- ACTION BUTTON --}}
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('jadwal.edit', $schedule->id) }}" class="w-8 h-8 transition-all duration-300 bg-yellow-500 hover:bg-yellow-700 focus:ring-2 focus:ring-yellow-500 text-white rounded-md flex justify-center items-center">
                                                <iconify-icon icon="akar-icons:edit" class="text-lg"></iconify-icon>
                                            </a>
                                            <div x-data="{ openConfirmDeleteModal : false }" x-cloak>
                                                <button @click="openConfirmDeleteModal = true" class="w-8 h-8 flex items-center justify-center rounded-md transition-all duration-300 bg-red-500 hover:bg-red-700 focus:ring-2 focus:ring-red-300 text-white">
                                                    <iconify-icon icon="fluent:delete-12-regular" class="text-lg"></iconify-icon>
                                                </button>
                                                <div x-show="openConfirmDeleteModal" style="z-index: 999;" class="w-full h-screen fixed z-50 inset-0 bg-slate-900 bg-opacity-50 p-3 cursor-pointer flex justify-center items-center" style="display: none;">
                                                    <div x-show="openConfirmDeleteModal" @click.away="openConfirmDeleteModal = false" x-transition="" x-transition.duration.200ms="" class="w-full bg-white cursor-default rounded-lg mx-auto max-w-xl overflow-hidden p-8" style="display: none;">
                                                        <h1 class="text-xl font-medium">Anda yakin ingin menghapus?</h1>
                                                        <p class="py-5 text-zinc-500">Tindakan ini tidak dapat dibatalkan</p>
                                                        <div class="w-full flex space-x-3 justify-end pt-10">
                                                            <button @click="openConfirmDeleteModal = false" class="w-full md:w-40 h-11 flex items-center justify-center rounded-md transition-all duration-300 border border-slate-300 hover:bg-slate-100 focus:ring-2 focus:ring-slate-300 text-slate-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--heroicons-outline text-lg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="heroicons-outline:trash"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"></path></svg>
                                                                <span class="ml-2">Batalkan</span>
                                                            </button>
                                                            
                                                            <form action="{{ route('jadwal.destroy', $schedule->id) }}" method="POST" class="w-full md:w-40">                                                                
                                                                @csrf
                                                                {{-- @method('DELETE') --}}
                                                                <button type="submit" class="w-full h-11 flex items-center justify-center rounded-md transition-all duration-300 bg-red-500 hover:bg-red-700 focus:ring-2 focus:ring-red-300 text-white">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--heroicons-outline text-lg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" data-icon="heroicons-outline:trash"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"></path></svg>
                                                                    <span class="ml-2">Hapus data</span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-slate-700 dark:text-slate-400 whitespace-nowrap">
                                    {{-- ID --}}
                                    <td class="px-4 py-3 text-sm text-red-500 italic">
                                        Oops, tidak ada data jadwal penerbangan!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection