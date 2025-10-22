<x-app-layout>
    <x-slot name="header">
        🔁 Permintaan Ujian Ulang
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6 mt-6 space-y-6">

        {{-- 🧾 Info Umum --}}
        <div class="text-gray-700">
            <p class="mb-4">
                Jika Anda mengalami kendala saat ujian (seperti koneksi terputus, waktu habis, atau kesalahan teknis),
                Anda dapat mengajukan permintaan ujian ulang kepada admin. Permintaan akan ditinjau terlebih dahulu.
            </p>
            <p class="text-sm text-yellow-700 bg-yellow-50 p-3 rounded border border-yellow-200">
                ⏳ Permintaan hanya dapat diajukan satu kali dan menunggu persetujuan admin.
            </p>
        </div>

        {{-- ⚙️ Form Permintaan --}}
        <form action="{{ route('peserta.ujian.ulang.kirim') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="reason" class="block font-semibold text-gray-800 mb-1">Alasan Permintaan</label>
                <textarea name="reason" id="reason" rows="4" required
                    placeholder="Tuliskan alasan Anda (misalnya: koneksi terputus, sistem error, waktu habis, dll)..."
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2 rounded-lg shadow transition">
                    📤 Kirim Permintaan
                </button>
            </div>
        </form>

        {{-- ✅ Riwayat Permintaan (jika ada) --}}
        @if (isset($requests) && $requests->count())
            <div class="border-t pt-5">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">🕓 Riwayat Permintaan Ujian Ulang</h3>
                <table class="w-full text-sm border border-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 text-left text-gray-700">
                            <th class="px-3 py-2 border">Tanggal</th>
                            <th class="px-3 py-2 border">Alasan</th>
                            <th class="px-3 py-2 border">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $req)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-3 py-2 border">{{ $req->requested_at->format('d M Y H:i') }}</td>
                                <td class="px-3 py-2 border">{{ $req->reason ?? '-' }}</td>
                                <td class="px-3 py-2 border capitalize">
                                    @if ($req->status === 'pending')
                                        <span class="text-yellow-600 font-semibold">Menunggu</span>
                                    @elseif ($req->status === 'approved')
                                        <span class="text-green-600 font-semibold">Disetujui</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- 🔙 Tombol Kembali --}}
        <div class="text-center pt-4">
            <a href="{{ route('peserta.dashboard') }}"
                class="inline-block bg-gray-600 text-white px-5 py-2 rounded-lg hover:bg-gray-500 transition">
                ⬅️ Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
