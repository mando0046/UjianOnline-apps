<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👤 Profil Peserta
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 mt-6 rounded-2xl shadow-lg">
        @if (session('success'))
            <div class="p-3 bg-green-100 text-green-700 rounded-lg mb-4 border border-green-300">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('peserta.profil.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <hr class="my-4">

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Password Baru (Opsional)</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"
                    placeholder="Masukkan password baru (kosongkan jika tidak ingin ubah)">
                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"
                    placeholder="Ulangi password baru">
            </div>

            <div class="text-right mt-4">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 font-semibold transition">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
        <div class="text-center mt-6">
            <a href="{{ route('peserta.dashboard') }}"
                class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-400 transition">
                ⬅️ Kembali ke Dashboard
            </a>
        </div>

    </div>
</x-app-layout>
