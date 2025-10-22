<!DOCTYPE html>
<html>

<head>
    <title>Hasil Ujian</title>
</head>

<body>
    <h2>Hasil Ujian</h2>
    <p>Nama: {{ $user->name }}</p>
    <p>Benar: {{ $correct }}</p>
    <p>Salah: {{ $wrong }}</p>
    <p>Total Nilai: {{ $score }}</p>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    @if (session('warning'))
        <p style="color:orange">{{ session('warning') }}</p>
    @endif
    @if (session('info'))
        <p style="color:blue">{{ session('info') }}</p>
    @endif



</body>

</html>
