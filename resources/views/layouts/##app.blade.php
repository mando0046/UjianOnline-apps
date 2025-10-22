<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-green-700 text-white flex flex-col min-h-screen">
            <div class="p-6 text-2xl font-bold border-b border-green-600">
                Ujian Online
            </div>

            <nav class="flex flex-col mt-4 gap-2 px-2">
                <!-- Dashboard Admin -->
                <a href="{{ route('dashboard') }}"
                    class="px-3 py-2 rounded hover:bg-gray-300 {{ request()->routeIs('dashboard') ? 'bg-gray-300 text-gray-800 font-semibold' : 'bg-gray-200 text-gray-800' }}">
                    Dashboard
                </a>

                {{-- Menu Soal --}}
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.soal') }}"
                        class="px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('admin.soal*') ? 'bg-blue-600 font-semibold' : 'bg-blue-500' }}">
                        Soal
                    </a>
                @elseif(Auth::user()->role === 'peserta')
                    <a href="{{ route('peserta.ujian') }}"
                        class="px-3 py-2 rounded hover:bg-blue-600 {{ request()->routeIs('peserta.soal') ? 'bg-blue-600 font-semibold' : 'bg-blue-500' }}">
                        Mulai Ujian
                    </a>
                @endif


                <!-- Daftar Peserta -->
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.peserta') }}"
                        class="px-3 py-2 rounded hover:bg-green-600 {{ request()->routeIs('admin.peserta') ? 'bg-green-600 font-semibold' : 'bg-green-500' }}">
                        Peserta
                    </a>
                @endif


                {{-- Menu Hasil --}}
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.hasil') }}"
                        class="px-3 py-2 rounded hover:bg-yellow-600 {{ request()->routeIs('admin.hasil') ? 'bg-yellow-600 font-semibold' : 'bg-yellow-500' }}">
                        Hasil
                    </a>
                @elseif(Auth::user()->role === 'peserta')
                    <a href="{{ route('peserta.hasil') }}"
                        class="px-3 py-2 rounded hover:bg-yellow-600 {{ request()->routeIs('peserta.hasil') ? 'bg-yellow-600 font-semibold' : 'bg-yellow-500' }}">
                        Hasil Saya
                    </a>
                @endif


                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>

            </nav>
        </aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header (opsional) -->
            @isset($header)
                <header class="bg-white shadow p-4">
                    <div class="max-w-7xl mx-auto text-xl font-semibold text-gray-800">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireStyles

</body>

</html>
