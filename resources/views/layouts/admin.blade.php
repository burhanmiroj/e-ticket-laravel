<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Travelgo</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        input, select {
            box-shadow: none !important;
        }
    </style>
    @vite(['resources/css/app.css', '/resources/js/app.js'])
</head>
<body>
    {{-- START : HEADER --}}
    <header class="w-full h-72 bg-gradient-to-tr from-green-1000 to-green-1100">
        <nav class="w-full px-4">
            <div class="w-full h-28 max-w-screen-custom mx-auto flex justify-between items-center">
                {{-- LOGO --}}
                <a href="{{ route('dashboard') }}" class="w-14 bg-white p-2 rounded-md">
                    <img src="{{ asset('logo.png') }}" class="w-full" alt="">
                </a>
                {{-- NAV UL --}}
                <ul class="w-full flex justify-end items-center space-x-5 text-center">
                    <li>
                        <a href="#" class="text-center text-white">Beranda</a>
                    </li>
                    <li>
                        <div class="inline-block relative" x-data="{ dropdownProfile: false }" x-cloak>
                            <button @click="dropdownProfile = !dropdownProfile" class="focus:outline-none cursor-pointer flex border rounded-full shadow-none border-indigo-300" :class="{ 'shadow-none border-indigo-300': dropdownProfile}">
                                <img class="w-9 h-9 hover:ring-2 ring-slate-300 rounded-full" src="https://kapnovelsyah.com/icons/admin.svg" alt="">
                            </button>
                            <div @click.away="dropdownProfile = false" x-show="dropdownProfile" class="text-sm flex flex-col absolute z-20 transform origin-top-right right-0 w-72 rounded-md overflow-hidden shadow-lg mt-5" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform opacity-50 scale-50" x-transition:enter-end="opacity-100 transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 transform opacity-0 scale-50" style="">
                                <ul class="bg-white">
                                    <li @click="dropdownProfile = false" class="text-slate-400 p-4 text-left">
                                        <p class="text-md text-slate-900 font-semibold">{{ Auth::user()->name }}</p>
                                        <p class="text-slate-500 text-xs">Terdaftar sebagai <span class="font-semibold text-green-1000">{{ Auth::user()->roles[0]->name }}</span></p>
                                    </li>
                                    @auth
                                        @role('admin')
                                            <li @click="dropdownProfile = false" class="border-t">
                                                <a href="{{ route('dashboard') }}" target="_blank" class="flex items-center w-full px-4 py-3 transition-all duration-300 hover:bg-slate-50 hover:text-slate-500">
                                                    <iconify-icon icon="ant-design:dashboard-outlined"></iconify-icon>
                                                    <span class="ml-2">Dashboard</span>
                                                </a>
                                            </li>
                                        @endrole
                                        <li @click="dropdownProfile = false">
                                            <a href="{{ route('dashboard') }}" class="flex items-center w-full px-4 py-3 transition-all duration-300 hover:bg-slate-50 hover:text-slate-500">
                                                <iconify-icon icon="heroicons:ticket"></iconify-icon>
                                                <span class="ml-2">Tiket anda</span>
                                            </a>
                                        </li>
                                    @endauth
                                </ul>
                                <ul class="bg-white">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center w-full px-4 py-3 transition-all duration-300 bg-red-500 hover:bg-red-700 text-white">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M14 8V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2v-2"></path><path d="M7 12h14l-3-3m0 6l3-3"></path></g></svg>
                                                <span class="ml-2">Logout</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    {{-- END : HEADER --}}
    {{-- START : MAIN CONTENT --}}
    <div class="px-4">
        <div class="w-full max-w-screen-custom mx-auto bg-white rounded-md shadow-xl transform -translate-y-20 p-4 md:p-10">
            <div class="w-full overflow-x-auto">
                <table class="w-full table-auto overflow-hidden">
                    <thead>
                        <tr class="text-left">
                            <th style="min-width: 200px;" class="w-48 h-14 text-center transition-all duration-300 rounded-t-xl hover:bg-slate-50 border-b-2 {{ request()->routeIs('dashboard') ? 'bg-green-100 hover:bg-green-200 text-green-1000 border-green-1000' : 'text-slate-500' }}">
                                <a href="{{ route('dashboard') }}" class="w-full h-full flex justify-center items-center">
                                    <iconify-icon icon="ant-design:dashboard-outlined" class="text-xl mr-2"></iconify-icon>
                                    <span>Dashboard</span>
                                </a>
                            </th>
                            <th style="min-width: 200px;" class="w-48 h-14 text-center transition-all duration-300 rounded-t-xl hover:bg-slate-50 border-b-2 {{ request()->routeIs('maskapai.*') ? 'bg-green-100 hover:bg-green-200 text-green-1000 border-green-1000' : 'text-slate-500' }}">
                                <a href="{{ route('maskapai.index') }}" class="w-full h-full flex justify-center items-center">
                                    <iconify-icon icon="simple-icons:ethiopianairlines" class="text-xl mr-2"></iconify-icon>
                                    <span>Maskapai</span>
                                </a>
                            </th>
                            <th style="min-width: 200px;" class="w-48 h-14 text-center transition-all duration-300 rounded-t-xl hover:bg-slate-50 border-b-2 {{ request()->routeIs('jadwal.*') ? 'bg-green-100 hover:bg-green-200 text-green-1000 border-green-1000' : 'text-slate-500' }}">
                                <a href="{{ route('jadwal.index') }}" class="w-full h-full flex justify-center items-center">
                                    <iconify-icon icon="akar-icons:schedule" class="text-xl mr-2"></iconify-icon>
                                    <span>Jadwal penerbangan</span>
                                </a>
                            </th>
                        </tr>
                    </thead>
                </table>
                <div class="w-full sticky bottom-0 left-0">
                    @yield('content')
                </div>
            </div>
        </div>
        {{-- FOOTER --}}
        <footer class="w-full">
            <div class="max-w-screen-custom mx-auto pb-5 -mt-10">
                <p class="text-sm">Copyright &copy;2022 Travelgo</p>
            </div>
        </footer>
    </div>
    {{-- END : MAIN CONTENT --}}

    {{--  --}}
    @include('sweetalert::alert')
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>