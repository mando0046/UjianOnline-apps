<x-app-layout>
    <x-slot name="header">✏️ Edit Soal</x-slot>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form edit --}}
    <form action="{{ route('admin.soal.update', $question->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Pertanyaan --}}
        <div>
            <label class="font-semibold">Pertanyaan</label>
            <textarea name="question" class="w-full border p-2 rounded">{{ old('question', $question->question) }}</textarea>
        </div>

        {{-- Gambar Soal --}}
        <div>
            <label class="font-semibold">Gambar Soal</label>
            @if ($question->question_image)
                <div class="mb-2">
                    <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Gambar Soal"
                        class="max-h-40 border rounded">
                </div>
            @endif
            <input type="file" name="question_image" class="w-full border p-2 rounded">
        </div>

        {{-- Opsi Jawaban A–E --}}
        @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
            <div>
                <label class="font-semibold">Jawaban {{ strtoupper($opt) }}</label>
                <input type="text" name="option_{{ $opt }}" class="w-full border p-2 rounded mb-2"
                    value="{{ old('option_' . $opt, $question->{'option_' . $opt}) }}">

                {{-- Gambar opsi --}}
                <label class="font-semibold">Gambar Jawaban {{ strtoupper($opt) }}</label>
                @php
                    $imgField = 'option_image_' . $opt;
                @endphp
                @if ($question->$imgField)
                    <div class="mb-2">
                        <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $question->$imgField) }}" alt="Opsi {{ strtoupper($opt) }}"
                            class="max-h-32 border rounded">
                    </div>
                @endif
                <input type="file" name="option_image_{{ $opt }}" class="w-full border p-2 rounded">
            </div>
        @endforeach

        {{-- Kunci Jawaban --}}
        <div>
            <label class="font-semibold">Kunci Jawaban</label>
            <select name="answer" class="border p-2 rounded">
                @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                    <option value="{{ $opt }}"
                        {{ old('answer', $question->answer) == $opt ? 'selected' : '' }}>
                        {{ strtoupper($opt) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            💾 Simpan Perubahan
        </button>
    </form>
</x-app-layout>
