<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Rekap Hasil Ujian Peserta</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
        }

        td {
            vertical-align: middle;
        }

        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h2>Rekap Hasil Ujian Peserta</h2>

    <table class="w-full text-left border border-gray-200 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-3 py-2 border">No</th>
                <th class="px-3 py-2 border">Nama Peserta</th>
                <th class="px-3 py-2 border">Email</th>
                <th class="px-3 py-2 border">Benar</th>
                <th class="px-3 py-2 border">Salah</th>
                <th class="px-3 py-2 border">Total Soal</th>
                <th class="px-3 py-2 border">Nilai Akhir</th>
                <th class="px-3 py-2 border text-center">Waktu Pengerjaan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hasilPeserta as $index => $hasil)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-3 py-2 border text-center">{{ $index + 1 }}</td>
                    <td class="px-3 py-2 border">{{ $hasil['nama'] ?? '-' }}</td>
                    <td class="px-3 py-2 border">{{ $hasil['email'] ?? '-' }}</td>
                    <td class="px-3 py-2 border text-center">{{ $hasil['benar'] ?? 0 }}</td>
                    <td class="px-3 py-2 border text-center">
                        {{ max(0, ($hasil['total'] ?? 0) - ($hasil['benar'] ?? 0)) }}
                    </td>
                    <td class="px-3 py-2 border text-center">{{ $hasil['total'] ?? 0 }}</td>
                    <td class="px-3 py-2 border text-center font-semibold text-blue-700">
                        {{ number_format($hasil['nilai'] ?? 0, 2, ',', '.') }}
                    </td>
                    <td class="px-3 py-2 border text-center text-gray-700">
                        @php
                            $tanggal = '-';
                            if (!empty($hasil['created_at'])) {
                                try {
                                    $tanggal = \Carbon\Carbon::parse($hasil['created_at'])->format('d-m-Y H:i');
                                } catch (\Exception $e) {
                                    $tanggal = '-';
                                }
                            }
                        @endphp
                        {{ $tanggal }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-3 py-4 border text-center text-gray-600">
                        Belum ada peserta yang mengikuti ujian.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d/m/Y H:i') }}
    </div>
</body>

</html>
