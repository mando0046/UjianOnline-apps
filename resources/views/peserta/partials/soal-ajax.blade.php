@if ($question)
    <div class="bg-white p-5 sm:p-6 lg:p-8 rounded-2xl shadow w-full max-w-5xl mx-auto" data-qid="{{ $question->id }}">
        <h4 class="font-bold mb-4 text-lg sm:text-xl text-gray-800">
            Soal {{ $index + 1 }}
        </h4>

        {{-- 🔹 Teks Soal --}}
        <p class="mb-4 text-gray-700 leading-relaxed text-base sm:text-lg">
            {!! nl2br(e($question->question)) !!}
        </p>

        {{-- 🔹 Gambar Soal --}}
        @if (!empty($question->question_image))
            <div class="mb-6 text-center">
                <img src="{{ asset('storage/' . $question->question_image) }}" alt="Gambar Soal {{ $index + 1 }}"
                    class="rounded-lg border max-h-[350px] mx-auto shadow-sm object-contain">
            </div>
        @endif

        {{-- 🔹 Pilihan Jawaban --}}
        <div class="space-y-4">
            @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                @php
                    $optionText = $question->{'option_' . $opt};
                    $optionImage = $question->{'option_image_' . $opt};
                    $isSelected = isset($answer) && strtolower($answer->answer) === $opt;
                @endphp

                @if ($optionText || $optionImage)
                    <button type="button"
                        class="pilihan-jawaban w-full text-left border p-4 sm:p-5 rounded-xl transition-all duration-150 
                            hover:scale-[1.02] focus:ring focus:ring-blue-200
                            {{ $isSelected
                                ? 'bg-blue-500 text-white border-blue-600 ring ring-blue-300'
                                : 'bg-gray-100 text-gray-800 border-gray-300 hover:bg-blue-50' }}"
                        data-question-id="{{ $question->id }}" data-option="{{ strtolower($opt) }}">
                        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                            {{-- Huruf & teks --}}
                            @if ($optionText)
                                <span class="text-base sm:text-lg leading-snug flex-1">
                                    <strong>{{ strtoupper($opt) }}.</strong> {{ $optionText }}
                                </span>
                            @endif

                            {{-- Gambar Opsi --}}
                            @if ($optionImage)
                                <img src="{{ asset('storage/' . $optionImage) }}" alt="Opsi {{ strtoupper($opt) }}"
                                    class="rounded-lg border max-h-32 sm:max-h-40 w-auto mx-auto sm:ml-4 object-contain shadow-sm">
                            @endif
                        </div>
                    </button>
                @endif
            @endforeach
        </div>
    </div>
@else
    <div class="text-center text-gray-500 py-10">
        ❌ Soal tidak ditemukan.
    </div>
@endif
