<x-app-layout>
    <x-slot name="header">
        Edit Soal
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.soal.update', $soal->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ================= PERTANYAAN ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Pertanyaan</label>
                <textarea name="question" rows="3" class="w-full border-gray-300 rounded-md">{{ old('question', $soal->question) }}</textarea>

                {{-- Gambar Pertanyaan --}}
                <label class="block text-gray-700 font-medium mt-2">Gambar Pertanyaan (opsional)</label>
                <input type="file" name="question_image" accept="image/*" class="w-full border-gray-300 rounded-md">

                @if ($soal->question_image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $soal->question_image) }}" alt="Gambar Pertanyaan"
                            class="w-40 rounded border">
                    </div>
                @endif
            </div>

            {{-- ================= PILIHAN A ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Pilihan A</label>
                <input type="text" name="option_a" class="w-full border-gray-300 rounded-md"
                    value="{{ old('option_a', $soal->option_a) }}">
                <label class="block text-gray-700 font-medium mt-2">Gambar Pilihan A (opsional)</label>
                <input type="file" name="option_a_image" accept="image/*" class="w-full border-gray-300 rounded-md">
                @if ($soal->option_a_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $soal->option_a_image) }}" alt="Gambar A"
                            class="w-32 rounded border">
                    </div>
                @endif
            </div>

            {{-- ================= PILIHAN B ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Pilihan B</label>
                <input type="text" name="option_b" class="w-full border-gray-300 rounded-md"
                    value="{{ old('option_b', $soal->option_b) }}">
                <label class="block text-gray-700 font-medium mt-2">Gambar Pilihan B (opsional)</label>
                <input type="file" name="option_b_image" accept="image/*" class="w-full border-gray-300 rounded-md">
                @if ($soal->option_b_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $soal->option_b_image) }}" alt="Gambar B"
                            class="w-32 rounded border">
                    </div>
                @endif
            </div>

            {{-- ================= PILIHAN C ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Pilihan C</label>
                <input type="text" name="option_c" class="w-full border-gray-300 rounded-md"
                    value="{{ old('option_c', $soal->option_c) }}">
                <label class="block text-gray-700 font-medium mt-2">Gambar Pilihan C (opsional)</label>
                <input type="file" name="option_c_image" accept="image/*" class="w-full border-gray-300 rounded-md">
                @if ($soal->option_c_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $soal->option_c_image) }}" alt="Gambar C"
                            class="w-32 rounded border">
                    </div>
                @endif
            </div>

            {{-- ================= PILIHAN D ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Pilihan D</label>
                <input type="text" name="option_d" class="w-full border-gray-300 rounded-md"
                    value="{{ old('option_d', $soal->option_d) }}">
                <label class="block text-gray-700 font-medium mt-2">Gambar Pilihan D (opsional)</label>
                <input type="file" name="option_d_image" accept="image/*" class="w-full border-gray-300 rounded-md">
                @if ($soal->option_d_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $soal->option_d_image) }}" alt="Gambar D"
                            class="w-32 rounded border">
                    </div>
                @endif
            </div>

            {{-- ================= PILIHAN E ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Pilihan E</label>
                <input type="text" name="option_e" class="w-full border-gray-300 rounded-md"
                    value="{{ old('option_e', $soal->option_e) }}">
                <label class="block text-gray-700 font-medium mt-2">Gambar Pilihan E (opsional)</label>
                <input type="file" name="option_e_image" accept="image/*" class="w-full border-gray-300 rounded-md">
                @if ($soal->option_e_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $soal->option_e_image) }}" alt="Gambar E"
                            class="w-32 rounded border">
                    </div>
                @endif
            </div>

            {{-- ================= JAWABAN BENAR ================= --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Jawaban Benar</label>
                <select name="answer" class="w-full border-gray-300 rounded-md">
                    <option value="A" {{ old('answer', $soal->answer) == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('answer', $soal->answer) == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('answer', $soal->answer) == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ old('answer', $soal->answer) == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ old('answer', $soal->answer) == 'E' ? 'selected' : '' }}>E</option>
                </select>
            </div>

            {{-- ================= TOMBOL ================= --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.soal.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
