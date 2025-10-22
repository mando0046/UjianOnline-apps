<x-app-layout>
    <x-slot name="header">
        {{ isset($question) ? 'Edit Soal' : 'Buat Soal' }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">

        <!-- 🔹 Tombol Kembali ke Dashboard -->


        <form action="{{ isset($question) ? route('admin.soal.update', $question->id) : route('admin.soal.store') }}"
            method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if (isset($question))
                @method('PUT')
            @endif

            <!-- Pertanyaan -->
            <div>
                <label for="question" class="block font-semibold mb-1">Pertanyaan</label>
                <textarea name="question" id="question" rows="4" class="w-full border p-2 rounded" required>{{ old('question', $question->question ?? '') }}</textarea>
            </div>

            <!-- Upload Gambar -->
            <div>
                <label for="image" class="block font-semibold mb-1">Gambar Pertanyaan (JPEG/JPG)</label>
                <input type="file" name="image" id="image" accept=".jpeg,.jpg"
                    class="w-full border p-2 rounded">
                @if (isset($question) && $question->image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar"
                            class="h-24 rounded border">
                    </div>
                @endif
            </div>

            <!-- Jawaban Pilihan -->
            <div>
                <label class="block font-semibold mb-1">Jawaban Pilihan</label>
                @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                    <div class="mb-4 border p-3 rounded">
                        <label class="block font-semibold">{{ strtoupper($opt) }}. Teks Jawaban</label>
                        <input type="text" name="option_{{ $opt }}" class="w-full border p-2 rounded mt-1"
                            value="{{ old('option_' . $opt, $question->{'option_' . $opt} ?? '') }}" required>

                        <label class="block font-semibold mt-3">Gambar Opsi {{ strtoupper($opt) }} (JPEG/JPG)</label>
                        <input type="file" name="option_image_{{ $opt }}" accept=".jpeg,.jpg"
                            class="w-full border p-2 rounded mt-1">

                        @if (isset($question) && $question->{'option_image_' . $opt})
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $question->{'option_image_' . $opt}) }}"
                                    alt="Opsi {{ strtoupper($opt) }}" class="h-20 rounded border">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Kunci Jawaban -->
            <div>
                <label for="answer" class="block font-semibold mb-1">Kunci Jawaban</label>
                <select name="answer" id="answer" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Jawaban --</option>
                    @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                        <option value="{{ $opt }}"
                            {{ old('answer', $question->answer ?? '') == $opt ? 'selected' : '' }}>
                            {{ strtoupper($opt) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-2 border-t pt-4">
                <a href="{{ route('admin.soal.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Batal
                </a>

                <!-- 🔹 Kembali ke Daftar Soal -->
                <a href="{{ route('admin.soal.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Kembali ke Daftar Soal
                </a>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    {{ isset($question) ? 'Update Soal' : 'Simpan Soal' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
