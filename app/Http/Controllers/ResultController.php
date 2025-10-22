<?php

namespace App\Http\Controllers;

use App\Exports\ResultsExport;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultController extends Controller
{
    public function index()
    {
        $users = User::where('role','peserta')->get();
        $results = [];

        foreach ($users as $user) {
            $answers = Answer::where('user_id', $user->id)->get();
            $correct = $answers->where('is_correct', true)->count();
            $wrong   = $answers->count() - $correct;
            $score   = $correct * 2;

            $results[] = [
                'name' => $user->name,
                'correct' => $correct,
                'wrong' => $wrong,
                'score' => $score,
            ];
        }

        return view('admin.results', compact('results'));
    }

    public function exportExcel()
    {
        return Excel::download(new ResultsExport, 'hasil-ujian.xlsx');
    }

    public function exportPdf()
    {
        $users = User::where('role','peserta')->get();
        $results = [];

        foreach ($users as $user) {
            $answers = Answer::where('user_id', $user->id)->get();
            $correct = $answers->where('is_correct', true)->count();
            $wrong   = $answers->count() - $correct;
            $score   = $correct * 2;

            $results[] = [
                'name' => $user->name,
                'correct' => $correct,
                'wrong' => $wrong,
                'score' => $score,
            ];
        }

        $pdf = Pdf::loadView('admin.results-pdf', compact('results'));
        return $pdf->download('hasil-ujian.pdf');
    }
}
