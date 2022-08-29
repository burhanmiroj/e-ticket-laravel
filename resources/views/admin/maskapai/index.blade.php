@extends('layouts.admin')
@section('content')
    <div class="py-5">
        <div class="flex justify-between items-center py-5">
            <div class="w-full">
                <h1 class="text-xl md:text-2xl font-bold">Maskapai</h1>    
                <p>Lihat daftar maskapai penerbangan</p>
            </div>
            <div class="w-auto flex justify-end">
                <a href="{{ route('maskapai.create') }}" class="w-10 h-10 transition-all duration-300 bg-green-1000 hover:bg-green-1100 focus:ring-2 focus:ring-green-500 text-white rounded-md flex justify-center items-center">
                    <iconify-icon icon="ci:add-to-queue" ></iconify-icon>
                </a>
            </div>
        </div>
        {{--  --}}
        <div class="w-full mt-5 grid grid-cols-1 md:grid-cols-2 gap-5">
            @forelse ($maskapais as $maskapai)
                <div class="p-5 mb-4 text-sm text-green-500 bg-green-50 border border-green-500 rounded-lg flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/maskapai/'. $maskapai->logo_maskapai) }}" class="w-12 h-12 md:w-16 md:h-16 rounded-full overflow-hidden border border-green-500" alt="Logo maskapai {{ $maskapai->nama_maskapai }}">
                        <div class="ml-5">
                            <h1 class="font-bold text-lg">{{ $maskapai->nama_maskapai }}</h1>
                            <span class="text-slate-400">Partner sejak : {{ \Carbon\Carbon::parse($maskapai->created_at)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('maskapai.edit', $maskapai->id) }}" class="w-8 h-8 transition-all duration-300 bg-yellow-500 hover:bg-yellow-700 focus:ring-2 focus:ring-yellow-500 text-white rounded-md flex justify-center items-center">
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
                                        
                                        <form action="{{ route('maskapai.destroy', $maskapai->id) }}" method="POST" class="w-full md:w-40">                                                                
                                            @csrf
                                            @method('DELETE')
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
                </div>
            @empty
                <div class="p-5 mb-4 text-sm text-red-500 bg-red-50 border border-red-500 rounded-lg flex justify-between items-center">                
                    <p>Oops! Tidak ada data maskapai</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection