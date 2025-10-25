<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎓 Dashboard Peserta
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 mt-6 rounded-2xl shadow-lg space-y-6">

        {{-- === HEADER === --}}
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">
                Selamat datang, {{ Auth::user()->name }}
            </h2>
            <p class="text-gray-500 mt-1">
                Kamu dapat memulai ujian, melihat hasil, atau mengajukan reset di sini.
            </p>

            {{-- 🔧 Tombol Profil dengan hover kuning --}}
            <a href="{{ route('peserta.profil.index') }}"
                class="inline-block mt-3 px-4 py-2 bg-green-200 rounded-lg text-sm font-semibold text-gray-700 transition hover:bg-yellow-400 hover:text-black hover:font-bold">
                ⚙️ Edit Profil
            </a>
        </div>

        {{-- === NOTIFIKASI === --}}
        @if (session('success'))
            <div id="alert-success"
                class="p-3 bg-green-100 text-green-700 rounded-lg border border-green-300 text-center">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error" class="p-3 bg-red-100 text-red-700 rounded-lg border border-red-300 text-center">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        {{-- === MENU AKSI / STATUS INFORMASI === --}}
        <div class="mt-4 flex flex-wrap gap-3 items-center justify-center">

            {{-- ✅ Sudah ujian dan belum di-reset --}}
            @if ($hasTakenExam && !$resetApproved)
                <a href="{{ route('peserta.hasil.index') }}"
                    class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-500 transition">
                    📊 Lihat Hasil Ujian
                </a>

                {{-- 🚫 Batas ujian tercapai --}}
            @elseif ($examCount >= $maxAttempts && !$resetApproved)
                <span class="px-6 py-3 bg-gray-400 text-white rounded-lg font-semibold cursor-not-allowed">
                    🔒 Batas Ujian Tercapai
                </span>

                {{-- 🔁 Ajukan ujian ulang --}}
                <form action="{{ route('peserta.request.reset') }}" method="POST" class="inline-block">
                    @csrf
                    <input type="hidden" name="reason" value="Ingin mengajukan ujian ulang.">
                    <button type="submit"
                        class="px-6 py-3 bg-orange-600 text-white rounded-lg font-semibold hover:bg-orange-500 transition">
                        🔁 Ajukan Ujian Ulang
                    </button>
                </form>

                {{-- 🚀 Belum ujian atau reset disetujui --}}
            @else
                <button id="startExamBtn"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-500 transition">
                    🚀 Ikut Ujian Sekarang
                </button>
            @endif
        </div>

        {{-- === INFORMASI STATUS === --}}
        <div class="text-gray-700 text-center mt-4 leading-relaxed">
            @if ($hasTakenExam && !$resetApproved)
                Anda telah menyelesaikan ujian. Klik <b>"Lihat Hasil Ujian"</b> untuk melihat skor Anda.
            @elseif ($examCount >= $maxAttempts && !$resetApproved)
                Anda sudah mengikuti ujian sebanyak <b>{{ $examCount }}</b> kali.
                Batas maksimum ujian (<b>{{ $maxAttempts }}</b> kali) telah tercapai. <br>
                Silakan klik <b>"Ajukan Ujian Ulang"</b> untuk meminta izin ke admin.
            @else
                Klik tombol <b>"Ikut Ujian Sekarang"</b> untuk memulai mengerjakan soal. <br>
                <span class="text-sm text-gray-500">(Durasi ujian: {{ $duration }} menit)</span>
            @endif
        </div>

        {{-- === TEMPAT MENAMPILKAN SOAL (Partial Ujian) === --}}
        <div id="examContainer" class="mt-6 hidden">
            @include('peserta.partials.ujian')
        </div>
    </div>

    {{-- === SCRIPT === --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startBtn = document.getElementById('startExamBtn');
            const examContainer = document.getElementById('examContainer');

            if (startBtn) {
                startBtn.addEventListener('click', () => {
                    examContainer.classList.remove('hidden');
                    startBtn.classList.add('hidden');
                    window.scrollTo({
                        top: examContainer.offsetTop,
                        behavior: 'smooth'
                    });
                });
            }

            setTimeout(() => {
                document.getElementById('alert-success')?.remove();
                document.getElementById('alert-error')?.remove();
            }, 4000);
        });
    </script>
</x-app-layout>
