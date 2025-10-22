<x-app-layout>
    <x-slot name="header">
        Ujian Online
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        @if ($questions->isEmpty())
            <p class="text-gray-600">Belum ada soal tersedia.</p>
        @else
            <form action="{{ route('peserta.ujian.submit') }}" method="POST">
                @csrf

                @foreach ($questions as $index => $q)
                    <div class="mb-6 border p-4 rounded-lg">
                        <p class="font-semibold mb-3">{{ $index + 1 }}. {{ $q->question }}</p>

                        @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                            @php $optionText = $q->{'option_' . $opt} ?? ''; @endphp
                            @if ($optionText)
                                <label class="block mb-1 cursor-pointer">
                                    <input type="radio" name="jawaban[{{ $q->id }}]" value="{{ $opt }}"
                                        required class="mr-2">
                                    {{ strtoupper($opt) }}. {{ $optionText }}
                                </label>
                            @endif
                        @endforeach
                    </div>
                @endforeach

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-500 transition w-full">
                    Selesai & Simpan Jawaban
                </button>
            </form>
        @endif
    </div>
</x-app-layout>
