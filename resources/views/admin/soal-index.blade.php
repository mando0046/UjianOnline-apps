<x-app-layout>
    <h2 class="font-bold text-xl mb-4">📚 Daftar Soal</h2>
    <a href="{{ route('admin.soal.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Tambah Soal</a>
    <table class="table-auto w-full mt-4 border">
        <thead class="bg-gray-200">
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $q)
                <tr class="border-t">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $q->question }}</td>
                    <td>
                        <a href="{{ route('admin.soal.edit', $q->id) }}" class="text-blue-600">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
