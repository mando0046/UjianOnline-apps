<x-app-layout>
    <x-slot name="header">
        Daftar Peserta
    </x-slot>

    <div class="flex justify-end mb-4">
        {{-- Tombol tambahan bisa diletakkan di sini --}}
    </div>

    @if ($users->count())
        <table class="table-auto w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-2 py-2 border text-center">No</th>
                    <th class="px-2 py-2 border">Nama</th>
                    <th class="px-2 py-2 border">Email</th>
                    <th class="px-2 py-2 border text-center">Role</th>
                    <th class="px-2 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-2 py-1 border text-center">
                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                        </td>
                        <td class="px-2 py-1 border">{{ $user->name }}</td>
                        <td class="px-2 py-1 border">{{ $user->email }}</td>

                        {{-- 🔹 Dropdown ubah role --}}
                        <td class="px-2 py-1 border text-center">
                            <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit()" class="border p-1 rounded">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="peserta" {{ $user->role === 'peserta' ? 'selected' : '' }}>Peserta
                                    </option>
                                    <option value="guest" {{ $user->role === 'guest' ? 'selected' : '' }}>Guest
                                    </option>
                                </select>
                            </form>
                        </td>

                        {{-- 🔹 Tombol Edit & Hapus --}}
                        <td class="px-2 py-1 border text-center align-middle">
                            <div class="flex justify-center items-center space-x-2">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    ✏️ Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- 🔹 Pagination --}}
        <div class="mt-4">
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <p class="text-gray-500 text-center">Belum ada peserta atau guest.</p>
    @endif

    {{-- 🔹 Tombol Kembali & Tambah User --}}
    <div class="mt-6 flex justify-center items-center gap-4">
        <a href="{{ url('admin/dashboard') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition-all duration-200 hover:scale-105 active:scale-95">
            ⬅️ Kembali ke Dashboard
        </a>

        <a href="{{ route('admin.users.create') }}"
            class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition-all duration-200 hover:scale-105 active:scale-95">
            ➕ Tambah User Baru
        </a>
    </div>
</x-app-layout>
