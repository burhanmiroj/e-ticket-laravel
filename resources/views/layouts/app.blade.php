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
            <div class="w-full h-24 max-w-screen-custom mx-auto flex justify-between items-center">
                {{-- LOGO --}}
                <img src="{{ asset('logo.jpeg') }}" class="w-20" alt="">
                {{-- NAV UL --}}
                <ul class="w-full flex justify-end items-center space-x-5 text-center">
                    <li>
                        <a href="#" class="text-center text-white">Beranda</a>
                    </li>
                    <li>
                        @auth
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
                        @else
                            <a href="{{ route('login') }}" class="flex justify-center items-center text-sm text-white w-28 h-10 transition-all duration-300 bg-green-1000 hover:bg-green-800 rounded-sm">
                                Login
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    {{-- END : HEADER --}}
    {{-- START : MAIN CONTENT --}}
    <div class="px-4">
        <div class="w-full">
            @yield('content')
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
    @stack('scripts')
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>