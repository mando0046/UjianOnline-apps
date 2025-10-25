<x-app-layout>
    <x-slot name="header">📘 Manajemen Soal</x-slot>

    <!-- Pesan sukses / error -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            ❌ {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-wrap items-center mb-4 gap-2">
        <!-- Tambah Soal -->
        <a href="{{ route('admin.soal.create') }}" class="bg-green-600 hover:bg-green-500 text-white px-3 py-2 rounded">
            ➕ Tambah Soal
        </a>

        <!-- Export -->
        <a href="{{ route('admin.soal.export') }}" class="bg-yellow-600 hover:bg-yellow-500 text-white px-4 py-2 rounded">
            📤 Export Soal (CSV)
        </a>

        <!-- Download Template -->
        <a href="{{ route('admin.soal.template') }}"
            class="bg-purple-600 hover:bg-purple-500 text-white px-4 py-2 rounded">
            📑 Download Template Excel
        </a>

        <!-- Upload Soal CSV/Excel -->
        <form action="{{ route('admin.soal.upload') }}" method="POST" enctype="multipart/form-data"
            class="flex gap-2 items-center border p-2 rounded bg-gray-50">
            @csrf
            <label class="text-sm font-medium">📂 Pilih File:</label>
            <input type="file" name="file" accept=".csv,.xlsx" class="border rounded px-2 py-1 text-sm" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-2 rounded">
                ⬆️ Upload Soal
            </button>
        </form>

        <!-- Reset Semua Soal -->
        <form action="{{ route('admin.soal.reset') }}" method="POST"
            onsubmit="return confirm('Apakah kamu yakin ingin menghapus semua soal beserta jawaban?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-3 py-2 rounded">
                🔄 Reset Semua Soal
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-3 py-2 border">No</th>
                    <th class="px-3 py-2 border">Pertanyaan</th>
                    <th class="px-3 py-2 border">Kunci Jawaban</th>
                    <th class="px-3 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($questions as $q)
                    <tr class="border hover:bg-gray-50">
                        <td class="px-3 py-2">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2">{{ $q->question }}</td>
                        <td class="px-3 py-2 font-bold text-green-600">{{ strtoupper($q->answer) }}</td>
                        <td class="px-3 py-2 flex gap-2">
                            <a href="{{ route('admin.soal.edit', $q->id) }}"
                                class="bg-blue-600 hover:bg-blue-500 text-white px-2 py-1 rounded">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('admin.soal.destroy', $q->id) }}" method="POST"
                                onsubmit="return confirm('Hapus soal ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-500 text-white px-2 py-1 rounded">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">
                            ❗ Belum ada soal.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
