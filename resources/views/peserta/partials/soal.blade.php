<div class="bg-white p-5 rounded shadow" data-qid="{{ $question->id }}">
    <h4 class="font-bold mb-2 text-lg">Soal {{ $index + 1 }}</h4>

    {{-- Teks Soal --}}
    <p class="mb-3 text-gray-800 leading-relaxed">{{ $question->question }}</p>

    {{-- Gambar Soal (jika ada) --}}
    @if (!empty($question->question_image))
        <div class="mb-4 text-center">
            <img src="{{ asset('storage/' . $question->question_image) }}" alt="Gambar Soal {{ $index + 1 }}"
                class="rounded border max-h-72 mx-auto shadow-sm">
        </div>
    @endif

    {{-- Pilihan Jawaban --}}
    <div class="space-y-3">
        @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
            @php
                $optionText = $question->{'option_' . $opt};
                $optionImage = $question->{'option_image_' . $opt};
                $isSelected = isset($answer) && strtolower($answer->answer) === $opt;
            @endphp

            @if ($optionText || $optionImage)
                <button type="button"
                    class="pilihan-jawaban w-full text-left border p-3 rounded-lg transition-all duration-150 
                           hover:scale-[1.02]
                           {{ $isSelected
                               ? 'bg-blue-500 text-white ring ring-blue-300 border-blue-600'
                               : 'bg-gray-100 text-gray-800 hover:bg-blue-100 border-gray-300' }}"
                    data-question-id="{{ $question->id }}" data-option="{{ strtolower($opt) }}">
                    <div class="flex flex-col gap-2">
                        @if ($optionText)
                            <span><strong>{{ strtoupper($opt) }}.</strong> {{ $optionText }}</span>
                        @endif

                        @if ($optionImage)
                            <img src="{{ asset('storage/' . $optionImage) }}" alt="Opsi {{ strtoupper($opt) }}"
                                class="rounded border max-h-40 w-auto">
                        @endif
                    </div>
                </button>
            @endif
        @endforeach
    </div>
</div>
