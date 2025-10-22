<x-app-layout>
    <div class="w-full max-w-[100vw] p-2 sm:p-4 md:p-6 lg:p-8">

        <!-- Judul dan Timer -->
        <div class="text-center mb-4">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2">🧠 Ujian Online</h2>
            <div class="flex justify-center items-center gap-2">
                <span class="text-gray-700 font-medium">⏱️ Waktu Tersisa:</span>
                <span id="timer"
                    class="text-red-600 text-lg sm:text-xl font-semibold bg-red-50 px-4 py-1 rounded-lg shadow-inner">
                    60:00
                </span>
            </div>
        </div>

        <!-- 🔹 Kontainer Utama -->
        <div class="flex flex-col lg:flex-row gap-4 bg-white p-4 sm:p-6 lg:p-8 rounded-xl shadow">

            <!-- BAGIAN SOAL -->
            <div class="flex-1">
                <div id="soal-container"
                    class="min-h-[250px] sm:min-h-[350px] flex justify-center items-center text-gray-600 text-sm sm:text-base lg:text-lg text-center leading-relaxed">
                    Memuat soal...
                </div>

                <div class="text-center mt-6">
                    <button id="btn-submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 text-base transition-all">
                        ✅ Selesai Ujian
                    </button>
                </div>
            </div>

            <!-- BAGIAN NAVIGASI -->
            <div class="w-full lg:w-52 xl:w-60 bg-gray-50 rounded-xl p-3 sm:p-4 shadow-inner">
                <h3 class="text-center font-semibold mb-3 text-base lg:text-lg">Navigasi Soal</h3>
                <div id="nav-soal"
                    class="grid grid-cols-[repeat(auto-fill,minmax(35px,1fr))] sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-5 xl:grid-cols-5 gap-2 justify-items-center">
                    @foreach ($questions as $i => $q)
                        <button
                            class="btn-soal w-9 h-9 flex items-center justify-center rounded-full 
                                font-semibold text-gray-800 bg-gray-200 hover:bg-blue-400 transition-all shadow-sm 
                                text-sm leading-none"
                            data-index="{{ $i }}">
                            {{ $i + 1 }}
                        </button>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentIndex = 0;
            const totalSoal = {{ count($questions) }};
            const soalContainer = document.getElementById('soal-container');
            const btnSubmit = document.getElementById('btn-submit');
            const timerEl = document.getElementById('timer');

            // =============================
            // 🕒 TIMER COUNTDOWN 60 MENIT
            // =============================
            let duration = 60 * 60; // 60 menit = 3600 detik
            const timerInterval = setInterval(() => {
                let minutes = Math.floor(duration / 60);
                let seconds = duration % 60;
                timerEl.textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                duration--;

                if (duration < 0) {
                    clearInterval(timerInterval);
                    timerEl.textContent = '00:00';
                    autoSubmitExam();
                }
            }, 1000);

            // =============================
            // 🔹 FUNGSI MUAT SOAL
            // =============================
            function loadSoal(index) {
                fetch(`{{ route('peserta.ujian.soal.ajax') }}?index=${index}`)
                    .then(res => res.text())
                    .then(html => {
                        soalContainer.innerHTML = html;
                        currentIndex = index;
                        highlightActive(index);
                        attachOptionEvents();
                    })
                    .catch(() => {
                        soalContainer.innerHTML =
                            '<div class="text-center text-red-500">❌ Gagal memuat soal.</div>';
                    });
            }

            // 🔹 Simpan jawaban
            function saveAnswer(questionId, answer) {
                fetch(`{{ route('peserta.ujian.save') }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            question_id: questionId,
                            answer
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'ok') {
                            markAnswered(currentIndex);
                            nextQuestion();
                        }
                    });
            }

            // 🔹 Event klik opsi jawaban
            function attachOptionEvents() {
                soalContainer.querySelectorAll('.pilihan-jawaban').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const qid = this.dataset.questionId;
                        const ans = this.dataset.option;

                        soalContainer.querySelectorAll('.pilihan-jawaban').forEach(b => {
                            b.classList.remove('bg-blue-500', 'text-white', 'ring',
                                'border-blue-600');
                            b.classList.add('bg-gray-100', 'text-gray-800',
                                'border-gray-300');
                        });

                        this.classList.remove('bg-gray-100', 'text-gray-800');
                        this.classList.add('bg-blue-500', 'text-white', 'ring', 'border-blue-600');

                        saveAnswer(qid, ans);
                    });
                });
            }

            // 🔹 Navigasi tombol soal
            document.querySelectorAll('.btn-soal').forEach(btn => {
                btn.addEventListener('click', () => {
                    const index = parseInt(btn.dataset.index);
                    loadSoal(index);
                });
            });

            // 🔹 Sorot soal aktif
            function highlightActive(index) {
                document.querySelectorAll('.btn-soal').forEach(btn => {
                    btn.classList.remove('bg-blue-500', 'text-white', 'ring');
                    btn.classList.add('bg-gray-200');
                });
                const activeBtn = document.querySelector(`.btn-soal[data-index="${index}"]`);
                if (activeBtn) activeBtn.classList.add('bg-blue-500', 'text-white', 'ring');
            }

            // 🔹 Tandai soal dijawab
            function markAnswered(index) {
                const btn = document.querySelector(`.btn-soal[data-index="${index}"]`);
                if (btn) {
                    btn.classList.remove('bg-gray-200', 'bg-blue-500');
                    btn.classList.add('bg-green-400', 'text-white');
                }
            }

            // 🔹 Soal berikutnya
            function nextQuestion() {
                if (currentIndex < totalSoal - 1) {
                    loadSoal(++currentIndex);
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: '📘 Soal Terakhir',
                        text: 'Kamu sudah sampai soal terakhir.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }

            // =============================
            // 🔹 KIRIM HASIL UJIAN
            // =============================
            btnSubmit.addEventListener('click', () => {
                confirmSubmitExam();
            });

            function confirmSubmitExam() {
                Swal.fire({
                    title: 'Selesai Ujian?',
                    text: 'Pastikan semua jawaban sudah diisi. Klik "Ya" untuk kirim hasil ujian.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Selesai!',
                    cancelButtonText: 'Batal'
                }).then(result => {
                    if (result.isConfirmed) {
                        submitExam();
                    }
                });
            }

            // 🔹 Kirim otomatis jika waktu habis
            function autoSubmitExam() {
                Swal.fire({
                    icon: 'warning',
                    title: '⏰ Waktu Habis!',
                    text: 'Ujian kamu akan dikirim otomatis.',
                    timer: 2000,
                    showConfirmButton: false
                });
                submitExam();
            }

            // 🔹 Submit ujian ke backend
            function submitExam() {
                fetch(`{{ route('peserta.ujian.submit') }}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'ok') {
                            Swal.fire({
                                icon: 'success',
                                title: '✅ Ujian Selesai!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = data.redirect;
                            });
                        }
                    });
            }

            // 🔹 Muat soal pertama
            loadSoal(0);
        });
    </script>
</x-app-layout>
