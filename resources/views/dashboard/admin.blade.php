<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Dashboard Admin</h2>
    </x-slot>

    <div class="p-6">
        <h3 class="font-bold mb-4">
            Selamat datang Admin {{ auth()->user()->name }} 👋
        </h3>

        <ul class="list-disc pl-6 space-y-2">
            <li>
                <a href="{{ route('admin.soal.index') }}" class="text-green-700 hover:underline">
                    📘 Kelola Soal
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="text-green-700 hover:underline">
                    👥 Kelola Peserta
                </a>
            </li>
            <li>
                <a href="{{ route('admin.hasil') }}" class="text-green-700 hover:underline">
                    📊 Lihat Hasil Ujian
                </a>
            </li>
            <li>
                <a href="{{ route('admin.exam-reset.index') }}" class="text-green-700 hover:underline">
                    Permintaan Reset Ujian
                </a>
            </li>
        </ul>
    </div>
</x-app-layout>
