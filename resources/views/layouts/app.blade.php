<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Ujian Psikologi') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tambahkan ini di dalam <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 font-sans antialiased flex flex-col min-h-screen">
    {{-- Header --}}
    <header class="bg-blue-600 text-white p-4">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-lg">Ujian Online</h1>
            <div>
                @auth
                    <span>Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="ml-3 bg-red-500 px-3 py-1 rounded">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="bg-green-500 px-3 py-1 rounded">Login</a>
                    <a href="{{ route('register') }}" class="ml-2 bg-yellow-500 px-3 py-1 rounded">Register</a>
                @endguest
            </div>
        </div>
    </header>

    {{-- Flash Message --}}
    <div class="max-w-4xl mx-auto mt-4 space-y-2">
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Main Content --}}
    <main class="p-6 flex-grow">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white text-center p-4">
        <p>&copy; {{ date('Y') }} Ujian Online. All rights reserved.</p>
        <p class="text-sm">Programmer by <span class="font-semibold">Mando Ubuntu</span></p>
    </footer>
</body>

</html>
