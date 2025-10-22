<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Hasil Ujian - {{ $user->name }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .summary {
            margin-bottom: 20px;
            border: 1px solid #000;
            padding: 10px;
            border-radius: 6px;
        }

        .summary p {
            margin: 3px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 11px;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .status-benar {
            color: green;
            font-weight: bold;
        }

        .status-salah {
            color: red;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>

<body>
    <h2>Hasil Ujian Peserta</h2>

    <div class="summary">
        <p><strong>Nama Peserta:</strong> {{ $user->name }}</p>
        <p><strong>Jumlah Soal:</strong> {{ $totalSoal }}</p>
        <p><strong>Jumlah Benar:</strong> {{ $benar }}</p>
        <p><strong>Jumlah Salah:</strong> {{ $salah }}</p>
        <p><strong>Total Nilai:</strong> {{ $total_nilai }}</p>
        <p><strong>Nilai Akhir:</strong> {{ number_format($nilaiAkhir, 2, ',', '.') }}%</p>
    </div>

    <h3>Detail Jawaban</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 45%">Soal</th>
                <th style="width: 15%">Jawaban Peserta</th>
                <th style="width: 15%">Kunci Jawaban</th>
                <th style="width: 20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($answers as $i => $ans)
                @php
                    $question = $ans->question;
                    $isCorrect = $question && $ans->answer === $question->answer;
                @endphp
                <tr>
                    <td style="text-align:center">{{ $i + 1 }}</td>
                    <td>{{ $question->question ?? 'Soal tidak ditemukan' }}</td>
                    <td style="text-align:center">{{ strtoupper($ans->answer ?? '-') }}</td>
                    <td style="text-align:center">{{ strtoupper($question->answer ?? '-') }}</td>
                    <td style="text-align:center">
                        @if ($isCorrect)
                            <span class="status-benar">✅ Benar</span>
                        @else
                            <span class="status-salah">❌ Salah</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y, H:i') }}
    </div>
</body>

</html>
