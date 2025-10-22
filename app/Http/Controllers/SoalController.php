<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Storage;

class SoalController extends Controller
{
    public function index()
    {
         $questions = Question::orderBy('id', 'asc')->get();
    return view('admin.soal.index', compact('questions'));
    }

    public function create()
    {
        return view('admin.soal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|in:a,b,c,d,e',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'option_e' => 'required|string',
            'option_image_a' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'option_image_b' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'option_image_c' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'option_image_d' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'option_image_e' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $validated['answer'] = strtoupper($validated['answer']);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('soal', 'public');
        }

        // Upload gambar pilihan (jika ada)
        foreach (['a', 'b', 'c', 'd', 'e'] as $opt) {
            if ($request->hasFile("option_image_$opt")) {
                $validated["option_image_$opt"] =
                    $request->file("option_image_$opt")->store('soal', 'public');
            }
        }

        Question::create($validated);

        return redirect()->route('admin.soal.index')
            ->with('success', '✅ Soal berhasil ditambahkan.');
    }

    public function edit(Question $soal)
    {
        // gunakan nama variabel $soal agar sesuai dengan route parameter {soal}
        return view('admin.soal.edit', compact('soal'));
    }

 public function update(Request $request, Question $soal)
{
    // 1️⃣ Validasi input
    $validated = $request->validate([
        'question' => 'required|string',
        'option_a' => 'required|string',
        'option_b' => 'required|string',
        'option_c' => 'required|string',
        'option_d' => 'required|string',
        'option_e' => 'required|string',
        'answer'   => 'required|in:A,B,C,D,E',

        // Gambar bersifat opsional
        'question_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'option_a_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'option_b_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'option_c_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'option_d_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'option_e_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 2️⃣ Pastikan huruf besar (A–E)
    $validated['answer'] = strtoupper($validated['answer']);

    // 3️⃣ Simpan teks ke database
    $soal->update($validated);

    // 4️⃣ Upload gambar (jika ada)
    $imageFields = [
        'question_image',
        'option_a_image',
        'option_b_image',
        'option_c_image',
        'option_d_image',
        'option_e_image'
    ];

    foreach ($imageFields as $field) {
        if ($request->hasFile($field)) {
            // Hapus gambar lama jika ada
            if ($soal->$field && \Storage::disk('public')->exists($soal->$field)) {
                \Storage::disk('public')->delete($soal->$field);
            }

            // Upload baru
            $path = $request->file($field)->store('soal_images', 'public');
            $soal->update([$field => $path]);
        }
    }

    // 5️⃣ Redirect dengan pesan sukses
    return redirect()
        ->route('admin.soal.index')
        ->with('success', '✅ Soal berhasil diperbarui.');
}



    public function destroy(Question $soal)
    {
        // Hapus semua gambar terkait
        if ($soal->image) Storage::disk('public')->delete($soal->image);
        foreach (['a', 'b', 'c', 'd', 'e'] as $opt) {
            if ($soal->{"option_image_$opt"}) {
                Storage::disk('public')->delete($soal->{"option_image_$opt"});
            }
        }

        $soal->delete();

        return redirect()->route('admin.soal.index')
            ->with('success', '🗑 Soal berhasil dihapus.');
    }

    public function reset()
{
    // Hapus semua jawaban dulu (karena ada foreign key ke questions)
    \App\Models\Answer::query()->delete();

    // Baru hapus semua soal
    \App\Models\Question::query()->delete();

    return redirect()->route('admin.soal.index')
        ->with('success', 'Semua soal dan jawaban berhasil dihapus!');
}

public function upload(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $file = $request->file('file');
    $path = $file->getRealPath();
    $content = file_get_contents($path);

    // Hilangkan karakter BOM jika ada (Excel UTF-8)
    $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);

    // Deteksi delimiter otomatis
    $firstLine = strtok($content, "\n");
    $delimiter = strpos($firstLine, ';') !== false ? ';' : ',';

    // Simpan ulang ke file sementara
    $tempPath = storage_path('app/temp_upload.csv');
    file_put_contents($tempPath, $content);

    $handle = fopen($tempPath, 'r');
    $header = fgetcsv($handle, 1000, $delimiter);

    // Normalisasi header
    $header = array_map(fn($h) => strtolower(trim($h)), $header);
    $expectedHeader = ['question', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'answer'];

    // Cek header
    if ($header !== $expectedHeader) {
        return back()->with('error', '❌ Format header CSV tidak sesuai. Harus: question,option_a,option_b,option_c,option_d,option_e,answer');
    }

    $count = 0;
    while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
        if (count($row) < 7) continue;

        \App\Models\Question::create([
            'question' => trim($row[0]),
            'option_a' => trim($row[1]),
            'option_b' => trim($row[2]),
            'option_c' => trim($row[3]),
            'option_d' => trim($row[4]),
            'option_e' => trim($row[5]),
            'answer'   => strtoupper(trim($row[6])),
        ]);

        $count++;
    }

    fclose($handle);
    unlink($tempPath);

    return redirect()->route('admin.soal.index')
        ->with('success', "✅ $count soal berhasil diunggah dari CSV!");
}



}
