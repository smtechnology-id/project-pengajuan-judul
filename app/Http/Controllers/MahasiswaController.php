<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Bimbingan;
use App\Models\Pengajuan;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\BiodataMahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $pengajuan = Pengajuan::where('id_user', $user_id)->first();
        $bimbingan = Bimbingan::where('user_id', $user_id)->count();
        return view('mahasiswa.dashboard', compact('pengajuan', 'bimbingan'));
    }
    public function pengajuan()
    {
        $user_id = Auth::id();
        $pengajuan = Pengajuan::where('id_user', $user_id)->first();
        $dosen = Dosen::all();

        return view('mahasiswa.pengajuan', compact('dosen', 'pengajuan'));
    }
    public function profile()
    {
        $user_id = Auth::user()->id;
        $program_studis = ProgramStudi::all();
        $biodata = BiodataMahasiswa::where('user_id', $user_id)->first();
        return view('mahasiswa.profile', compact('biodata', 'program_studis'));
    }
    public function pengajuanPost(Request $request)
    {
        $user_id = Auth::id();
        $program_studi_id = Auth::user()->BiodataMahasiswa->program_studi_id;

        // Validasi data yang diterima
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosen_satu' => 'required|exists:dosen,id',
            'dosen_dua' => 'required|exists:dosen,id',
        ]);

        // Simpan data pengajuan
        Pengajuan::create([
            'id_user' => $user_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'dosen_satu' => $request->dosen_satu,
            'dosen_dua' => $request->dosen_dua,
            'program_studi_id' => $program_studi_id,
            'status' => 'pending',
            'jadwal' => '0',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.pengajuan')->with('success', 'Pengajuan berhasil diajukan');
    }
    public function updatePengajuan(Request $request)
    {
        // Validate the request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dosen_satu' => 'required|exists:dosen,id',
            'dosen_dua' => 'required|exists:dosen,id',
        ]);



        // Find the pengajuan by its ID or another unique identifier
        $pengajuan = Pengajuan::find($request->input('id')); // Adjust this line as needed to find the correct pengajuan

        // Update the pengajuan data
        $pengajuan->judul = $request->input('judul');
        $pengajuan->deskripsi = $request->input('deskripsi');
        $pengajuan->dosen_satu = $request->input('dosen_satu');
        $pengajuan->dosen_dua = $request->input('dosen_dua');
        $pengajuan->status = 'pending'; // Set the status to pending

        // Save the updated pengajuan
        $pengajuan->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Pengajuan updated successfully and set to pending.');
    }

    public function bimbingan()
    {
        $user_id = Auth::id();
        $pengajuan = Pengajuan::where('id_user', $user_id)->first();
        $bimbinganSatu = Bimbingan::where('user_id', $user_id)->where('pembimbing', '1')->get();
        $bimbinganDua = Bimbingan::where('user_id', $user_id)->where('pembimbing', '2')->get();
        return view('mahasiswa.bimbingan', compact('pengajuan', 'bimbinganDua', 'bimbinganSatu'));
    }
    public function addBimbingan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'materi' => 'required|string',
        ]);

        $user_id = Auth::user()->id;

        Bimbingan::create([
            'user_id' => $user_id,
            'pengajuan_id' => $request->pengajuan_id, // Pastikan pengajuan_id tersedia di form atau dapatkan dari Auth::user() jika perlu
            'tanggal' => $request->tanggal,
            'pembimbing' => $request->pembimbing,
            'materi' => $request->materi,
        ]);

        return redirect()->back()->with('success', 'Bimbingan berhasil ditambahkan!');
    }
    public function updateBimbingan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'materi' => 'required|string',
        ]);

        $user_id = Auth::user()->id;

        // Cari bimbingan berdasarkan user_id dan pengajuan_id
        $bimbingan = Bimbingan::where('user_id', $user_id)
            ->where('pengajuan_id', $request->pengajuan_id)
            ->first();

        if (!$bimbingan) {
            return redirect()->back()->with('error', 'Data bimbingan tidak ditemukan!');
        }

        // Update data bimbingan
        $bimbingan->update([
            'pembimbing' => $request->pembimbing,
            'tanggal' => $request->tanggal,
            'materi' => $request->materi,
        ]);

        return redirect()->back()->with('success', 'Bimbingan berhasil diperbarui!');
    }
    public function deleteBimbingan ($id)
    {
        // Cari data bimbingan berdasarkan ID
        $bimbingan = Bimbingan::findOrFail($id);

        // Lakukan penghapusan
        $bimbingan->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data bimbingan berhasil dihapus!');
    }

    public function updateMahasiswa(Request $request)
    {
        $user = Auth::user();

        // Validasi data
        $request->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'no_hp' => 'required|string|max:15',
            'program_studi_id' => 'required|exists:program_studi,id',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update User data
        $user->update([
            'email' => $request->email,
        ]);

        // Update Mahasiswa data
        $user->biodataMahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'program_studi_id' => $request->program_studi_id,
        ]);

        // Update password if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diperbarui!');
    }
}

