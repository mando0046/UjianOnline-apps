<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Untuk Admin --}}
                @if (Auth::user()->role === 'admin')
                    <h3 class="text-lg font-bold mb-4">Halo Admin {{ Auth::user()->name }} 👋</h3>
                    <p class="mb-4">Kelola ujian di sini:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>
                            <a href="{{ route('admin.soal.index') }}" class="text-green-700 hover:underline">
                                Kelola Soal
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="text-green-700 hover:underline">
                                Kelola Peserta
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.hasil') }}" class="text-green-700 hover:underline">
                                Lihat Hasil Ujian
                            </a>
                        </li>
                @endif
                <li>
                    <a href="{{ route('admin.examreset.index') }}" class="text-green-700 hover:underline">
                        Permintaan Reset Ujian
                    </a>
                </li>
                </ul>


                {{-- Untuk Peserta --}}
                @if (Auth::user()->role === 'peserta')
                    <h3 class="text-lg font-bold mb-4">Halo {{ Auth::user()->name }} 👋</h3>
                    <p class="mb-4">Selamat datang di Ujian Online. Silakan pilih menu:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>
                            <a href="{{ route('peserta.ujian') }}" class="text-green-700 hover:underline">
                                Ikut Ujian
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('peserta.hasil') }}" class="text-green-700 hover:underline">
                                Lihat Hasil Saya
                            </a>
                        </li>

                    </ul>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>
