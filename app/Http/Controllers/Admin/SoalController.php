<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Storage;

class SoalController extends Controller
{
    // 🟢 Tampilkan semua soal
    public function index()
    {
        $questions = Question::orderBy('id', 'asc')->get();
        return view('admin.soal.index', compact('questions'));
    }

    // 🟢 Form tambah soal
    public function create()
    {
        return view('admin.soal.create');
    }

    // 🟢 Simpan soal baru
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'answer' => 'required|string|in:a,b,c,d,e',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'option_e' => 'required|string',
            'option_image_a' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_image_b' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_image_c' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_image_d' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_image_e' => 'nullable|image|mimes:jpeg,jpg|max:2048',
        ], [
            '*.max' => 'Ukuran gambar melebihi 2048 MB'
        ]);

        $data = $request->only([
            'question', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'answer'
        ]);

        // Simpan gambar pertanyaan
        if ($request->hasFile('image')) {
            $data['question_image'] = $request->file('image')->store('soal_images', 'public');
        }

        // Simpan gambar pilihan jawaban
        foreach (['a', 'b', 'c', 'd', 'e'] as $opt) {
            if ($request->hasFile("option_image_$opt")) {
                $data["option_image_$opt"] = $request->file("option_image_$opt")->store('soal_images', 'public');
            }
        }

        Question::create($data);
        return redirect()->route('admin.soal.index')->with('success', '✅ Soal berhasil disimpan!');
    }

    // 🟡 Form edit soal
    public function edit(Question $soal)
    {
        return view('admin.soal.edit', compact('soal'));
    }

    // 🟡 Update soal lama
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_a' => 'required|string',
            'option_image_a' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_b' => 'required|string',
            'option_image_b' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_c' => 'required|string',
            'option_image_c' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_d' => 'required|string',
            'option_image_d' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'option_e' => 'required|string',
            'option_image_e' => 'nullable|image|mimes:jpeg,jpg|max:2048',
            'answer' => 'required|in:a,b,c,d,e',
        ], [
            '*.max' => 'Ukuran gambar melebihi 2048 MB'
        ]);

        $path = 'soal_images';

        // Hapus gambar pertanyaan lama jika diminta
        if ($request->has('delete_old_image') && $question->question_image) {
            Storage::disk('public')->delete($question->question_image);
            $question->question_image = null;
        }

        // Hapus gambar opsi lama jika dicentang
        foreach (['a','b','c','d','e'] as $opt) {
            if ($request->has("delete_old_option_image_{$opt}") && $question->{"option_image_{$opt}"}) {
                Storage::disk('public')->delete($question->{"option_image_{$opt}"});
                $question->{"option_image_{$opt}"} = null;
            }
        }

        // Upload gambar pertanyaan baru
        if ($request->hasFile('image')) {
            if ($question->question_image) {
                Storage::disk('public')->delete($question->question_image);
            }
            $question->question_image = $request->file('image')->store($path, 'public');
        }

        // Upload gambar tiap opsi baru
        foreach (['a','b','c','d','e'] as $opt) {
            $field = "option_image_{$opt}";
            if ($request->hasFile($field)) {
                if ($question->$field) {
                    Storage::disk('public')->delete($question->$field);
                }
                $question->$field = $request->file($field)->store($path, 'public');
            }
        }

        // Update data teks
        $question->update([
            'question' => $validated['question'],
            'option_a' => $validated['option_a'],
            'option_b' => $validated['option_b'],
            'option_c' => $validated['option_c'],
            'option_d' => $validated['option_d'],
            'option_e' => $validated['option_e'],
            'answer' => $validated['answer'],
            'question_image' => $question->question_image,
            'option_image_a' => $question->option_image_a,
            'option_image_b' => $question->option_image_b,
            'option_image_c' => $question->option_image_c,
            'option_image_d' => $question->option_image_d,
            'option_image_e' => $question->option_image_e,
        ]);

        return redirect()->route('admin.soal.index')->with('success', '✅ Soal berhasil diperbarui.');
    }

    // 🗑️ Hapus soal
    public function destroy(Question $soal)
    {
        if ($soal->question_image) Storage::disk('public')->delete($soal->question_image);
        foreach (['a', 'b', 'c', 'd', 'e'] as $opt) {
            if ($soal->{"option_image_$opt"}) {
                Storage::disk('public')->delete($soal->{"option_image_$opt"});
            }
        }

        $soal->delete();
        return redirect()->route('admin.soal.index')->with('success', '🗑 Soal berhasil dihapus.');
    }

    // 🔄 Reset semua soal & jawaban
    public function reset()
    {
        Answer::query()->delete();
        Question::query()->delete();

        return redirect()->route('admin.soal.index')
            ->with('success', '🧹 Semua soal dan jawaban berhasil dihapus!');
    }

    // 📤 Upload soal dari CSV
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $content = preg_replace('/^\xEF\xBB\xBF/', '', file_get_contents($path));

        $firstLine = strtok($content, "\n");
        $delimiter = strpos($firstLine, ';') !== false ? ';' : ',';

        $tempPath = storage_path('app/temp_upload.csv');
        file_put_contents($tempPath, $content);

        $handle = fopen($tempPath, 'r');
        $header = fgetcsv($handle, 1000, $delimiter);
        $header = array_map(fn($h) => strtolower(trim($h)), $header);

        $expected = ['question', 'option_a', 'option_b', 'option_c', 'option_d', 'option_e', 'answer'];
        if ($header !== $expected) {
            return back()->with('error', '❌ Format header CSV tidak sesuai.');
        }

        $count = 0;
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
            if (count($row) < 7) continue;

            Question::create([
                'question' => trim($row[0]),
                'option_a' => trim($row[1]),
                'option_b' => trim($row[2]),
                'option_c' => trim($row[3]),
                'option_d' => trim($row[4]),
                'option_e' => trim($row[5]),
                'answer' => strtolower(trim($row[6])),
            ]);
            $count++;
        }

        fclose($handle);
        unlink($tempPath);

        return redirect()->route('admin.soal.index')
            ->with('success', "✅ $count soal berhasil diunggah dari CSV!");
    }
}
