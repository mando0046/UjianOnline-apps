<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // ✅ tambahkan ini
use App\Models\User;
use Illuminate\Http\Request;

class AdminPesertaController extends Controller



{
    // Daftar semua peserta
    public function index()
    {
        $peserta = User::where('role', 'peserta')->latest()->paginate(10);
        return view('admin.peserta.index', compact('peserta'));
    }

    // Hapus peserta
    public function destroy(User $user)
    {
        if ($user->role !== 'peserta') {
            return redirect()->route('admin.peserta.index')
                ->with('error', 'User ini bukan peserta.');
        }

        $user->delete();
        return redirect()->route('admin.peserta.index')
            ->with('success', 'Peserta berhasil dihapus.');
    }
}
