<x-app-layout>
    <x-slot name="header">
        ✏️ Edit Data User
    </x-slot>

    <!-- ✅ Pesan sukses -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 transition-all duration-300">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- ❌ Pesan error -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 transition-all duration-300">
            ❌ <strong>Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside mt-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 🧾 Form Edit User -->
    <div
        class="max-w-lg mx-auto bg-white p-6 rounded-2xl shadow-lg transition-transform duration-300 hover:scale-[1.01]">

        <!-- 🔘 Tombol Reset dan Simpan di Tengah Atas -->
        <div class="flex justify-center items-center gap-3 mb-6">
            <!-- 🔄 Reset Password -->
            <form action="{{ route('admin.users.resetPassword', $user->id) }}" method="POST"
                onsubmit="return confirm('Yakin ingin reset password user ini ke 123456?')">
                @csrf
                @method('PUT')
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg shadow-md text-sm sm:text-base font-semibold transition-all duration-200 hover:scale-105 active:scale-95">
                    🔄 Reset Password
                </button>
            </form>

            <!-- 💾 Simpan -->
            <button form="form-edit-user" type="submit"
                class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded-lg shadow-md font-semibold text-sm sm:text-base transition-all duration-200 hover:scale-105 active:scale-95">
                💾 Simpan Perubahan
            </button>
        </div>

        <!-- 📝 Form Edit User -->
        <form id="form-edit-user" action="{{ route('admin.users.update', $user->id) }}" method="POST"
            class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200 transition-all duration-200"
                    required>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200 transition-all duration-200"
                    required>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Role</label>
                <select name="role"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200 transition-all duration-200"
                    required>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="peserta" {{ old('role', $user->role) === 'peserta' ? 'selected' : '' }}>Peserta
                    </option>
                    <option value="guest" {{ old('role', $user->role) === 'guest' ? 'selected' : '' }}>Guest</option>
                </select>
            </div>

            <!-- 🔑 Ganti Password (opsional) -->
            <div class="border-t pt-4">
                <label class="block text-gray-700 font-semibold mb-2">Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti password"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200 transition-all duration-200">
            </div>

            <!-- 🔁 Konfirmasi Password -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200 transition-all duration-200">
            </div>

            <!-- Tombol Kembali -->
            <div class="border-t pt-4 flex justify-center">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-600 hover:bg-gray-500 text-white px-5 py-2 rounded-lg shadow-md text-sm sm:text-base font-medium transition-all duration-200 hover:scale-105 active:scale-95">
                    ⬅️ Kembali ke Daftar User
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
