<div>
    <h2>Soal {{ $current + 1 }} dari {{ $totalQuestions }}</h2>
    <p>{{ $question->text ?? '' }}</p>

    @foreach (['a', 'b', 'c', 'd', 'e'] as $option)
        <label>
            <input type="radio" wire:model.live="jawaban.{{ $current }}" value="{{ $option }}"
                wire:change="saveAnswer({{ $current }})">
            {{ $option }}. {{ $question->{'option_' . $option} }}
        </label><br>
    @endforeach

    <div class="mt-4 flex gap-2">
        <button wire:click="prev" @if ($current == 0) disabled @endif>Prev</button>
        <button wire:click="next" @if ($current == $totalQuestions - 1) disabled @endif>Next</button>
        <button wire:click="finishUjian">Selesai</button>
    </div>

    {{-- Navigasi soal --}}
    <div class="mt-4 flex flex-wrap gap-2">
        @foreach ($questions as $i => $q)
            <button wire:click="goTo({{ $i }})"
                class="px-3 py-1 rounded 
                       {{ !empty($jawaban[$i]) ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                {{ $i + 1 }}
            </button>
        @endforeach
    </div>

    <div id="timer" class="mt-4 font-bold"></div>
</div>

<script>
    let time = @json($waktu);
    let timer = setInterval(() => {
        if (time <= 0) {
            clearInterval(timer);
            Livewire.emit('timerEnded');
        } else {
            let minutes = Math.floor(time / 60);
            let seconds = time % 60;
            document.getElementById('timer').innerText =
                `${minutes}:${seconds.toString().padStart(2,'0')}`;
            time--;
        }
    }, 1000);
</script>
