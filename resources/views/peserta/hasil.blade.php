<x-app-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-indigo-200 to-purple-200 py-10 px-4">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl p-8 text-center">
            <!-- Judul -->
            <h2 class="text-3xl font-bold mb-6 text-gray-800">
                🎓 Hasil Ujian Kamu
            </h2>

            <!-- Identitas -->
            <div class="mb-8">
                <p class="text-lg text-gray-700">
                    Peserta: <span class="font-semibold">{{ Auth::user()->name }}</span>
                </p>
                <p class="text-gray-600">Tanggal: {{ now()->format('d M Y, H:i') }}</p>
            </div>

            <!-- Statistik Ujian -->
            <div class="space-y-4 text-lg">
                <div class="flex justify-between text-gray-700">
                    <span>Total Soal:</span>
                    <span class="font-semibold">{{ $total_questions ?? 0 }}</span>
                </div>
                <div class="flex justify-between text-green-600">
                    <span>Jawaban Benar:</span>
                    <span class="font-semibold">{{ $correct_answers ?? 0 }}</span>
                </div>
                <div class="flex justify-between text-red-600">
                    <span>Jawaban Salah:</span>
                    <span class="font-semibold">{{ $wrong_answers ?? 0 }}</span>
                </div>
                <div class="flex justify-between text-yellow-600">
                    <span>Belum Dijawab:</span>
                    <span class="font-semibold">{{ $unanswered ?? 0 }}</span>
                </div>
            </div>

            <!-- Nilai Akhir -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Nilai Akhir</h3>

                <!-- Progress bar -->
                <div class="w-full bg-gray-200 rounded-full h-6 overflow-hidden shadow-inner">
                    <div class="h-6 rounded-full transition-all duration-700
                        @if (($score ?? 0) >= 80) bg-green-500 
                        @elseif(($score ?? 0) >= 60) bg-yellow-400 
                        @else bg-red-500 @endif"
                        style="width: {{ $score ?? 0 }}%;">
                    </div>
                </div>

                <p
                    class="text-4xl font-extrabold mt-4
                    @if (($score ?? 0) >= 80) text-green-600
                    @elseif(($score ?? 0) >= 60) text-yellow-500
                    @else text-red-600 @endif">
                    {{ $score ?? 0 }} / 100
                </p>

                <p class="mt-2 text-gray-600 italic">
                    @if (($score ?? 0) >= 80)
                        🎉 Hebat! Kamu lulus dengan nilai tinggi!
                    @elseif(($score ?? 0) >= 60)
                        👍 Lumayan, tapi masih bisa lebih baik!
                    @else
                        💪 Jangan menyerah! Coba lagi ya!
                    @endif
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('peserta.dashboard') }}"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow transition">
                    ⬅️ Kembali ke Dashboard
                </a>
                <a href="{{ route('peserta.ujian.index') }}"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow transition">
                    🔁 Ulangi Ujian
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
