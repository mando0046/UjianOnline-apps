<x-app-layout>
    <x-slot name="header">
        Dashboard Peserta
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
        <h2 class="text-xl font-semibold">Halo, {{ auth()->user()->name }}!</h2>
        <p>Selamat datang di sistem Ujian Psikologi. Silakan pilih aksi di bawah ini:</p>

        <div class="flex flex-col md:flex-row gap-4">
            <!-- Mulai Ujian -->
            <a href="{{ route('peserta.ujian.index') }}"
                class="flex-1 text-center bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-500 transition">
                Mulai Ujian
            </a>

            <!-- Lihat Hasil -->
            <a href="{{ route('peserta.hasil.index') }}"
                class="flex-1 text-center bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-500 transition">
                Lihat Hasil Ujian
            </a>
        </div>
    </div>
</x-app-layout>
