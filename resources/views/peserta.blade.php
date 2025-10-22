<x-app-layout>
    <x-slot name="header">
        Dashboard Peserta
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Selamat datang, {{ Auth::user()->name }}!</h2>

        <div class="space-y-4">
            {{-- Tombol Ikut Ujian --}}
            <a href="{{ route('peserta.ujian.index') }}"
                class="block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-500 transition text-center">
                Ikut Ujian
            </a>

            {{-- Tombol Lihat Hasil --}}
            <a href="{{ route('peserta.hasil') }}"
                class="block bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-500 transition text-center">
                Lihat Hasil
            </a>
        </div>

        {{-- Info tambahan / pengumuman --}}
        <div class="mt-6 p-4 bg-gray-100 rounded-lg">
            <p class="text-gray-700">
                Pastikan Anda menyelesaikan ujian sebelum batas waktu. Nilai akan muncul setelah submit jawaban.
            </p>
        </div>
    </div>
</x-app-layout>
