<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\BiodataMahasiswa;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index() {
        return view('mahasiswa.dashboard');
    }
    public function pengajuan() {
        $user_id = Auth::id();
        $pengajuan = Pengajuan::where('id_user', $user_id)->first();
        $dosen = Dosen::all();

        if ($pengajuan) {
            return view('mahasiswa.pengajuan', ['pengajuan' => $pengajuan]);
        } else {
            return view('mahasiswa.pengajuan', ['dosen' => $dosen]);
        }
    }
    public function profile() {
        $user_id = Auth::user()->id;
        $biodata = BiodataMahasiswa::where('user_id', $user_id)->first();
        return view('mahasiswa.profile', compact('biodata'));
    }
    public function pengajuanPost(Request $request)
    {
        $user_id = Auth::id();

        // Validasi data yang diterima
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosen_satu' => 'required|exists:dosens,id',
            'dosen_dua' => 'required|exists:dosens,id',
        ]);

        // Simpan data pengajuan
        Pengajuan::create([
            'id_user' => $user_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'dosen_satu' => $request->dosen_satu,
            'dosen_dua' => $request->dosen_dua,
            'status' => 'pending',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.pengajuan')->with('success', 'Pengajuan berhasil diajukan');
    }
}
