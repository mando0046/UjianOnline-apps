@extends('layouts.app')

@section('title', 'Hasil Ujian')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Rekap Hasil Ujian Peserta</h2>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-green-600 text-white">
                        <th class="border border-gray-200 px-4 py-2 text-center">Nama Peserta</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Benar</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Salah</th>
                        <th class="border border-gray-200 px-4 py-2 text-center">Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $r)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ $r['name'] }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center text-green-700 font-semibold">
                                {{ $r['correct'] }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center text-red-600 font-semibold">
                                {{ $r['wrong'] }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center font-bold">{{ $r['score'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tombol Export --}}
        <div class="mt-6 flex justify-center gap-4">
            <a href="/admin/results/excel"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                Export ke Excel
            </a>
            <a href="/admin/results/pdf"
                class="bg-red-600 text-white px-5 py-2 rounded-lg shadow hover:bg-red-700 transition">
                Export ke PDF
            </a>
        </div>
    </div>
@endsection
