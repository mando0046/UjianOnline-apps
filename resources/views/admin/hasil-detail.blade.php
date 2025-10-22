<x-app-layout>
    <x-slot name="header">
        Hasil Detail Peserta - {{ $user->name }}
    </x-slot>

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Ringkasan Nilai</h2>
        <ul class="list-disc ml-6 mb-6">
            <li>Jumlah Benar: <strong>{{ $benar }}</strong></li>
            <li>Jumlah Salah: <strong>{{ $salah }}</strong></li>
            <li>Total Nilai: <strong>{{ $total_nilai }}</strong></li>
        </ul>

        <h3 class="font-semibold mb-2">Detail Jawaban</h3>
        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-100 text-center">
                    <th class="border px-2 py-2">No</th>
                    <th class="border px-2 py-2">Soal</th>
                    <th class="border px-2 py-2">Jawaban Peserta</th>
                    <th class="border px-2 py-2">Kunci Jawaban</th>
                    <th class="border px-2 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($answers as $i => $ans)
                    <tr class="text-center">
                        <td class="border px-2 py-2">{{ $i + 1 }}</td>
                        <td class="border px-2 py-2 text-left">{{ $ans->question->question }}</td>
                        <td class="border px-2 py-2">{{ strtoupper($ans->answer) }}</td>
                        <td class="border px-2 py-2">{{ strtoupper($ans->question->answer) }}</td>
                        <td class="border px-2 py-2">
                            @if ($ans->answer === $ans->question->answer)
                                ✅ Benar
                            @else
                                ❌ Salah
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <a href="{{ route('admin.hasil') }}"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-500 transition">
                ⬅ Kembali ke Rekap
            </a>
        </div>
    </div>
</x-app-layout>
