<x-app-layout>
    <x-slot name="header">🔄 Permintaan Reset Ujian</x-slot>

    <div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                ✅ {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Peserta</th>
                    <th class="p-3">Alasan</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $req)
                    <tr class="border-b">
                        <td class="p-3">{{ $req->user->name }}</td>
                        <td class="p-3">{{ $req->reason }}</td>
                        <td class="p-3 capitalize">{{ $req->status }}</td>
                        <td class="p-3 space-x-2">
                            @if ($req->status == 'pending')
                                <form method="POST" action="{{ route('admin.examreset.approve', $req->id) }}"
                                    class="inline">
                                    @csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded">Setujui</button>
                                </form>
                                <form method="POST" action="{{ route('admin.examreset.reject', $req->id) }}"
                                    class="inline">
                                    @csrf
                                    <button class="bg-red-600 text-white px-3 py-1 rounded">Tolak</button>
                                </form>
                            @else
                                <span class="text-gray-500">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-3 text-center text-gray-500">Tidak ada permintaan reset.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
