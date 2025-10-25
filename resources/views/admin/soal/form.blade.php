<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
    <form action="{{ isset($question) ? route('admin.soal.update', $question->id) : route('admin.soal.store') }}"
        method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if (isset($question))
            @method('PUT')
        @endif

        <!-- 📝 Pertanyaan -->
        <div>
            <label for="question" class="block font-semibold mb-1">Pertanyaan</label>
            <textarea name="question" id="question" rows="4" class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                required>{{ old('question', $question->question ?? '') }}</textarea>
        </div>

        <!-- 🖼️ Gambar Pertanyaan -->
        <div>
            <label for="image" class="block font-semibold mb-1">Gambar Pertanyaan (JPEG/JPG)</label>
            <input type="file" name="image" id="image" accept=".jpeg,.jpg" class="w-full border p-2 rounded"
                onchange="previewImage(event, 'preview-image')">

            <!-- Preview gambar baru -->
            <img id="preview-image" class="hidden h-28 mt-2 rounded border shadow-sm" alt="Preview Gambar Baru">

            <!-- ✅ Gambar lama jika ada -->
            @if (!empty($question?->question_image) && file_exists(public_path('storage/' . $question->question_image)))
                <div class="mt-3">
                    <p class="text-sm text-gray-500">Gambar lama pertanyaan:</p>
                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Gambar Soal Lama"
                        class="h-28 rounded border shadow-sm mt-1">

                    <!-- Checkbox hapus gambar lama -->
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="delete_old_image" value="1" class="mr-2">
                            <span class="text-sm text-gray-600">Hapus gambar lama ini</span>
                        </label>
                    </div>
                </div>
            @endif
        </div>

        <!-- 🧩 Pilihan Jawaban -->
        <div>
            <label class="block font-semibold mb-2">Jawaban Pilihan</label>
            @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                <div class="mb-4 border rounded-lg p-3">
                    <div class="grid md:grid-cols-2 gap-4">
                        <!-- Teks Jawaban -->
                        <div>
                            <label class="block font-semibold mb-1">Teks Jawaban {{ strtoupper($opt) }}</label>
                            <input type="text" name="option_{{ $opt }}"
                                class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                                value="{{ old('option_' . $opt, $question->{'option_' . $opt} ?? '') }}" required>
                        </div>

                        <!-- Gambar Jawaban -->
                        <div>
                            <label class="block font-semibold mb-1">Gambar Jawaban {{ strtoupper($opt) }}
                                (JPEG/JPG)</label>
                            <input type="file" name="option_image_{{ $opt }}" accept=".jpeg,.jpg"
                                class="w-full border p-2 rounded"
                                onchange="previewImage(event, 'preview-{{ $opt }}')">

                            <!-- Preview gambar baru -->
                            <img id="preview-{{ $opt }}" class="hidden h-20 mt-2 rounded border shadow-sm">

                            <!-- Gambar lama jika ada -->
                            @php $imgField = 'option_image_' . $opt; @endphp
                            @if (!empty($question?->$imgField) && file_exists(public_path('storage/' . $question->$imgField)))
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Gambar lama jawaban {{ strtoupper($opt) }}:</p>
                                    <img src="{{ asset('storage/' . $question->$imgField) }}"
                                        alt="Opsi {{ strtoupper($opt) }}" class="h-20 rounded border shadow-sm">

                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="delete_old_option_image_{{ $opt }}"
                                                value="1" class="mr-2">
                                            <span class="text-sm text-gray-600">Hapus gambar lama ini</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 🔑 Kunci Jawaban -->
        <div>
            <label for="answer" class="block font-semibold mb-1">Kunci Jawaban</label>
            <select name="answer" id="answer" class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                required>
                <option value="">-- Pilih Jawaban Benar --</option>
                @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                    <option value="{{ $opt }}"
                        {{ old('answer', $question->answer ?? '') == $opt ? 'selected' : '' }}>
                        {{ strtoupper($opt) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end items-center gap-3 pt-4 border-t">
            <a href="{{ route('admin.soal.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                ← Kembali
            </a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                {{ isset($question) ? '💾 Update Soal' : '💾 Simpan Soal' }}
            </button>
        </div>
    </form>
</div>

<!-- 🔹 Script Preview Gambar Baru -->
<script>
    function previewImage(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
            preview.src = '';
        }
    }
</script>
