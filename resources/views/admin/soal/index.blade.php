<x-app-layout>
    <x-slot name="header">
        📘 Manajemen Soal
    </x-slot>

    <!-- ✅ Pesan sukses / error -->
    @if (session('success'))
        <div class="max-w-6xl mx-auto mt-4">
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-sm relative"
                role="alert">
                <strong class="font-bold">✅ Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-700"
                    onclick="this.parentElement.style.display='none';">✖</button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-6xl mx-auto mt-4">
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow-sm relative"
                role="alert">
                <strong class="font-bold">❌ Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-700"
                    onclick="this.parentElement.style.display='none';">✖</button>
            </div>
        </div>
    @endif

    <!-- 🔧 Tombol Aksi -->
    <div class="flex flex-wrap items-center mb-4 gap-3">
        <a href="{{ route('admin.soal.create') }}"
            class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded shadow">
            ➕ Tambah Soal
        </a>

        <form action="{{ route('admin.soal.upload') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-wrap gap-2 items-center border p-2 rounded bg-gray-50 shadow-sm">
            @csrf
            <label class="text-sm font-medium">📂 File CSV:</label>
            <input type="file" name="file" accept=".csv,.xlsx"
                class="border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-2 rounded shadow">
                ⬆️ Upload Soal
            </button>
        </form>

        <form action="{{ route('admin.soal.reset') }}" method="POST"
            onsubmit="return confirm('⚠️ Apakah kamu yakin ingin menghapus semua soal beserta jawaban?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded shadow">
                🔄 Reset Semua Soal
            </button>
        </form>
    </div>

    <!-- 📋 Tabel Soal -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="table-auto w-full border border-gray-200 rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-3 py-2 border w-12">No</th>
                    <th class="px-3 py-2 border w-1/2">Pertanyaan</th>
                    <th class="px-3 py-2 border w-1/6 text-center">Kunci Jawaban</th>
                    <th class="px-3 py-2 border w-1/4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($questions as $q)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-3 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $q->question }}</td>
                        <td class="px-3 py-2 text-center font-semibold text-green-600">
                            {{ strtoupper($q->answer) }}
                        </td>
                        <td class="px-3 py-2 flex items-center justify-center gap-2">
                            <a href="{{ route('admin.soal.edit', $q->id) }}"
                                class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded shadow">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('admin.soal.destroy', $q->id) }}" method="POST"
                                onsubmit="return confirm('Hapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded shadow">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">
                            ❗ Belum ada soal yang ditambahkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🔙 Tombol Kembali ke Dashboard -->
    <div class="mt-6 text-center">
        <a href="{{ url('/admin/dashboard') }}"
            class="inline-block bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            ⬅️ Kembali ke Dashboard
        </a>
    </div>

    <!-- ⏱️ Auto-hide alert -->
    <script>
        setTimeout(() => {
            document.querySelectorAll('[role="alert"]').forEach(el => el.style.display = 'none');
        }, 5000);
    </script>
</x-app-layout>
