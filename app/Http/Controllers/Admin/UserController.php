<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * 🔹 Tampilkan daftar semua pengguna
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.peserta', compact('users'));
    }

    /**
     * 🔹 Tampilkan form edit user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * 🔹 Update data user (nama, email, role, dan password opsional)
     */
    public function update(Request $request, User $user)
    {
        // Cegah user mengedit dirinya sendiri (opsional)
        if (auth()->id() === $user->id && $request->role !== $user->role) {
            return back()->withErrors(['Anda tidak dapat mengubah role akun Anda sendiri.']);
        }

        // Validasi input
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,peserta,guest',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Update field dasar
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Jika password baru diisi, hash dan simpan
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', '✅ Data user berhasil diperbarui.');
    }

    /**
     * 🔹 Reset password user ke default (123456)
     */
    public function resetPassword(User $user)
    {
        // Cegah admin reset password dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->withErrors(['Anda tidak dapat mereset password akun Anda sendiri.']);
        }

        $user->password = Hash::make('123456');
        $user->save();

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', '🔄 Password berhasil direset ke default: 123456');
    }

    /**
     * 🔹 Tampilkan form tambah user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * 🔹 Simpan user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:admin,peserta,guest',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', '✅ User baru berhasil ditambahkan.');
    }

    /**
     * 🔹 Hapus user
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors(['Anda tidak dapat menghapus akun Anda sendiri.']);
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', '🗑️ User berhasil dihapus.');
    }

    /**
     * 🔹 Update role langsung via dropdown (tanpa form edit)
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,peserta,guest',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Role user berhasil diperbarui!');
    }
}
