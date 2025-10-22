<x-app-layout>
    <x-slot name="header">
        🔄 Permintaan Ujian Ulang
    </x-slot>

    <div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow space-y-6">
        @if ($requests->isEmpty())
            <p class="text-center text-gray-500 py-6">
                Tidak ada permintaan ujian ulang saat ini.
            </p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left border-b text-gray-700">
                            <th class="p-3">👤 Peserta</th>
                            <th class="p-3">📝 Alasan</th>
                            <th class="p-3">📅 Tanggal Permintaan</th>
                            <th class="p-3">📊 Status</th>
                            <th class="p-3 text-center">⚙️ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $req)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-3 font-medium">{{ $req->user->name ?? '-' }}</td>
                                <td class="p-3">{{ $req->reason ?? '-' }}</td>
                                <td class="p-3">
                                    {{ $req->requested_at ? $req->requested_at->format('d M Y H:i') : '-' }}</td>
                                <td class="p-3 capitalize">
                                    @if ($req->status == 'pending')
                                        <span
                                            class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs">Pending</span>
                                    @elseif ($req->status == 'approved')
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Disetujui</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-3 text-center space-x-2">
                                    @if ($req->status === 'pending')
                                        {{-- ✅ Setujui --}}
                                        <form method="POST" action="{{ route('admin.exam-reset.approve', $req->id) }}"
                                            class="inline-block">
                                            @csrf
                                            <input type="number" name="allowed_attempts" placeholder="Percobaan"
                                                min="1" class="border p-1 rounded w-20 text-center text-sm">
                                            <button type="submit"
                                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-500 transition text-sm">
                                                Setujui
                                            </button>
                                        </form>

                                        {{-- ❌ Tolak --}}
                                        <form method="POST" action="{{ route('admin.exam-reset.reject', $req->id) }}"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500 transition text-sm">
                                                Tolak
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-500 text-sm">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- 🔙 Tombol kembali --}}
        <div class="text-center pt-4">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-block bg-gray-600 text-white px-5 py-2 rounded-lg hover:bg-gray-500 transition">
                ⬅️ Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
