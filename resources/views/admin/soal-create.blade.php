<x-app-layout>
    <x-slot name="header">Buat Soal</x-slot>


    <form action="{{ isset($question) ? route('admin.soal.update', $question->id) : route('admin.soal.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($question))
            @method('PUT')
        @endif

        <!-- Pertanyaan -->
        <div class="mb-4">
            <label for="question" class="block font-semibold mb-1">Pertanyaan</label>
            <textarea name="question" id="question" rows="4" class="w-full border p-2 rounded" required>{{ old('question', $question->question ?? '') }}</textarea>
        </div>

        <!-- Upload Gambar -->
        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Gambar (JPEG/JPG)</label>
            <input type="file" name="image" id="image" accept=".jpeg,.jpg" class="w-full border p-2 rounded">
            @if (isset($question) && $question->image)
                <p class="mt-1 text-sm text-gray-500">Gambar saat ini: <img
                        src="{{ asset('storage/' . $question->image) }}" alt="Gambar" class="h-20"></p>
            @endif
        </div>

        <!-- Jawaban Pilihan -->
        <div class="mb-4">
            <label class="block font-semibold mb-1">Jawaban Pilihan</label>
            @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                <div class="mb-4 border p-2 rounded">
                    <label class="block font-semibold">{{ strtoupper($opt) }}. Teks Jawaban</label>
                    <input type="text" name="option_{{ $opt }}" class="w-full border p-2 rounded mt-1"
                        value="{{ old('option_' . $opt, $question->{'option_' . $opt} ?? '') }}" required>

                    <label class="block font-semibold mt-2">Gambar Opsi {{ strtoupper($opt) }} (JPEG/JPG)</label>
                    <input type="file" name="option_image_{{ $opt }}" accept=".jpeg,.jpg"
                        class="w-full border p-2 rounded mt-1">

                    @if (isset($question) && $question->{'option_image_' . $opt})
                        <p class="mt-1 text-sm text-gray-500">Gambar saat ini:
                            <img src="{{ asset('storage/' . $question->{'option_image_' . $opt}) }}"
                                alt="Opsi {{ strtoupper($opt) }}" class="h-20">
                        </p>
                    @endif
                </div>
            @endforeach
        </div>


        <!-- Kunci Jawaban -->
        <div class="mb-4">
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

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.soal.create') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                {{ isset($question) ? 'Update Soal' : 'Simpan Soal' }}
            </button>
        </div>
    </form>
</x-app-layout>
