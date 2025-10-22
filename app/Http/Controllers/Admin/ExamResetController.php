<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResetRequest;
use Illuminate\Http\Request;

class ExamResetController extends Controller
{
    public function index()
    {
        $requests = ExamResetRequest::with('user')->latest()->get();
        return view('admin.exam-reset.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = ExamResetRequest::findOrFail($id);
        $request->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Permintaan reset disetujui.');
    }

    public function reject($id)
    {
        $request = ExamResetRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Permintaan reset ditolak.');
    }
}
