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
                    <div id="progress-bar"
                        class="h-6 rounded-full transition-all duration-1000 ease-out
                        @if (($score ?? 0) >= 81) bg-green-500
                        @elseif(($score ?? 0) >= 75) bg-lime-400
                        @elseif(($score ?? 0) >= 61) bg-yellow-400
                        @else bg-red-500 @endif"
                        style="width: 0%;">
                    </div>
                </div>

                <!-- Nilai angka -->
                <p
                    class="text-4xl font-extrabold mt-4
                    @if (($score ?? 0) >= 81) text-green-600
                    @elseif(($score ?? 0) >= 75) text-lime-600
                    @elseif(($score ?? 0) >= 61) text-yellow-600
                    @else text-red-600 @endif">
                    {{ $score ?? 0 }} / 100
                </p>

                <!-- Pesan motivasi -->
                <p class="mt-3 text-gray-700 italic text-lg">
                    @if (($score ?? 0) >= 81)
                        🎉 Hebat! Nilaimu <strong>Sangat Bagus!</strong>
                    @elseif(($score ?? 0) >= 75)
                        🎉 Nilaimu sudah <strong>Bagus</strong>, tingkatkan lagi ya!
                    @elseif(($score ?? 0) >= 61)
                        🎉 Nilaimu <strong>Cukup</strong> namun harus ditingkatkan lagi!
                    @else
                        🎉 Nilaimu <strong>Kurang</strong>. Ayo semangat 💪! Jangan menyerah, belajar dan belajar lagi —
                        pasti bisa!
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

    <!-- Script animasi dan confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const score = {{ $score ?? 0 }};
            const progress = document.getElementById('progress-bar');
            const finalWidth = Math.min(score, 100) + '%';

            // Animasi bar nilai
            setTimeout(() => {
                progress.style.width = finalWidth;
            }, 300);

            // 🎉 Confetti untuk nilai >= 81
            if (score >= 81) {
                const duration = 2500;
                const animationEnd = Date.now() + duration;
                const defaults = {
                    startVelocity: 25,
                    spread: 360,
                    ticks: 60,
                    zIndex: 9999
                };

                function randomInRange(min, max) {
                    return Math.random() * (max - min) + min;
                }

                const interval = setInterval(() => {
                    const timeLeft = animationEnd - Date.now();
                    if (timeLeft <= 0) return clearInterval(interval);

                    const particleCount = 50 * (timeLeft / duration);
                    confetti({
                        ...defaults,
                        particleCount,
                        origin: {
                            x: randomInRange(0.1, 0.9),
                            y: Math.random() - 0.2
                        }
                    });
                }, 200);
            }
        });
    </script>
</x-app-layout>
