<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            ✏️ Edit Soal
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6">
        <form action="{{ route('admin.soal.update', $soal->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- 📝 Pertanyaan -->
            <div>
                <label for="question" class="block font-semibold mb-1">Pertanyaan</label>
                <textarea name="question" id="question" rows="4" class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                    required>{{ old('question', $soal->question) }}</textarea>
            </div>

            <!-- 🖼️ Gambar Pertanyaan -->
            <div>
                <label for="image" class="block font-semibold mb-1">Gambar Pertanyaan (JPEG/JPG)</label>
                <input type="file" name="image" id="image" accept=".jpeg,.jpg"
                    class="w-full border p-2 rounded" onchange="previewImage(event, 'preview-image')">

                <!-- Preview gambar baru -->
                <img id="preview-image" class="hidden h-32 mt-2 rounded border shadow-sm" alt="Preview Gambar Baru">

                <!-- ✅ Gambar lama -->
                @if ($soal->question_image && file_exists(public_path('storage/' . $soal->question_image)))
                    <div class="mt-3">
                        <p class="text-sm text-gray-600">🖼️ Gambar pertanyaan saat ini:</p>
                        <img src="{{ asset('storage/' . $soal->question_image) }}" alt="Gambar Soal Lama"
                            class="h-32 rounded border shadow-md mt-1">

                        <!-- Checkbox hapus gambar lama -->
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="delete_old_image" value="1" class="mr-2">
                                <span class="text-sm text-gray-700">Hapus gambar lama ini</span>
                            </label>
                        </div>
                    </div>
                @endif
            </div>

            <!-- 🧩 Pilihan Jawaban -->
            <div>
                <label class="block font-semibold mb-2">Jawaban Pilihan</label>

                @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                    @php $imgField = "option_image_$opt"; @endphp
                    <div class="mb-5 border rounded-lg p-4 bg-gray-50">
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Teks Jawaban -->
                            <div>
                                <label class="block font-semibold mb-1">Teks Jawaban {{ strtoupper($opt) }}</label>
                                <input type="text" name="option_{{ $opt }}"
                                    class="w-full border p-2 rounded focus:ring focus:ring-blue-300"
                                    value="{{ old('option_' . $opt, $soal->{'option_' . $opt}) }}" required>
                            </div>

                            <!-- Gambar Jawaban -->
                            <div>
                                <label class="block font-semibold mb-1">Gambar Jawaban {{ strtoupper($opt) }}
                                    (JPEG/JPG)
                                </label>
                                <input type="file" name="option_image_{{ $opt }}" accept=".jpeg,.jpg"
                                    class="w-full border p-2 rounded"
                                    onchange="previewImage(event, 'preview-{{ $opt }}')">

                                <!-- Preview gambar baru -->
                                <img id="preview-{{ $opt }}" class="hidden h-24 mt-2 rounded border shadow-sm">

                                <!-- Gambar lama -->
                                @if ($soal->$imgField && file_exists(public_path('storage/' . $soal->$imgField)))
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600">📷 Gambar jawaban {{ strtoupper($opt) }} saat
                                            ini:</p>
                                        <img src="{{ asset('storage/' . $soal->$imgField) }}"
                                            alt="Opsi {{ strtoupper($opt) }}"
                                            class="h-24 rounded border shadow-md mt-1">

                                        <!-- Checkbox hapus gambar -->
                                        <div class="mt-2">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox"
                                                    name="delete_old_option_image_{{ $opt }}" value="1"
                                                    class="mr-2">
                                                <span class="text-sm text-gray-700">Hapus gambar lama ini</span>
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
                            {{ old('answer', $soal->answer) == $opt ? 'selected' : '' }}>
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
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- 🔹 Preview Gambar Baru -->
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
</x-app-layout>
