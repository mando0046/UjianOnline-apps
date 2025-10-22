<div class="p-4 bg-white rounded shadow">
    <h4 class="font-bold mb-3">Soal {{ $index + 1 }}</h4>
    <p class="mb-4">{{ $question->question }}</p>

    <div class="space-y-2">
        @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
            @php
                $field = 'option_' . $opt;
            @endphp
            @if (!empty($question->$field))
                {{-- kalau opsinya tidak kosong --}}
                <label class="flex items-center space-x-2">
                    <input type="radio" name="answer_{{ $question->id }}" value="{{ $opt }}" class="answer-radio"
                        data-qid="{{ $question->id }}" {{ $answer && $answer->jawaban === $opt ? 'checked' : '' }}>
                    <span>{{ strtoupper($opt) }}. {{ $question->$field }}</span>
                </label>
            @endif
        @endforeach
    </div>
</div>
