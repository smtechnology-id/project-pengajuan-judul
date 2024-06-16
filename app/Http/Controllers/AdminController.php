<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Kaprodi;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\BiodataMahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $mahasiswa = BiodataMahasiswa::all()->count();
        $dosen = Dosen::all()->count();
        $pengajuan = Pengajuan::all()->count();
        $jadwal = Jadwal::all()->count();
        return view('admin.dashboard', compact('mahasiswa', 'dosen', 'pengajuan', 'jadwal'));
    }
    public function dosen()
    {
        $dosen = Dosen::all();
        return view('admin.dosen', compact('dosen'));
    }
    public function addDosen(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosen', // unique:dosen menandakan validasi unik di tabel dosen
            'jabatan' => 'required|string|max:255',
        ]);

        Dosen::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Data dosen berhasil ditambahkan!');
    }

    public function updateDosen(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:dosen,id',
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosen,nip,' . $request->id,
            'jabatan' => 'required|string|max:255',
        ]);

        $dosen = Dosen::findOrFail($request->id);
        $dosen->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Data dosen berhasil diperbarui!');
    }

    public function deleteDosen($id)
    {
        // Temukan data dosen berdasarkan ID
        $dosen = Dosen::findOrFail($id);

        // Lakukan penghapusan
        $dosen->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.dashboard')->with('success', 'Data dosen berhasil dihapus');
    }


    public function prodi()
    {
        $program_studis = ProgramStudi::all();
        return view('admin.prodi', compact('program_studis'));
    }

    public function addProgramStudi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        ProgramStudi::create([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->back()->with('success', 'Program studi berhasil ditambahkan.');
    }

    public function updateProgramStudi(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:program_studi,id',
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        $programStudi = ProgramStudi::findOrFail($request->id);
        $programStudi->update([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->back()->with('success', 'Program studi berhasil diperbarui.');
    }

    public function deleteProgramStudi($id)
    {
        $programStudi = ProgramStudi::findOrFail($id);
        $programStudi->delete();

        return redirect()->back()->with('success', 'Program studi berhasil dihapus.');
    }

    public function kaprodi()
    {
        $kaprodi = kaprodi::all();
        $program_studis = ProgramStudi::all();
        return view('admin.kaprodi', compact('kaprodi', 'program_studis'));
    }

    public function addKaprodi(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:kaprodi',
            'jabatan' => 'required|string|max:255',
            'program_studi_id' => 'required|exists:program_studi,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kaprodi', // Set role sebagai kaprodi
        ]);

        // Buat kaprodi baru
        Kaprodi::create([
            'program_studi_id' => $request->program_studi_id,
            'user_id' => $user->id, // Relasi ke user_id
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Data Kaprodi berhasil ditambahkan!');
    }

    public function updateKaprodi(Request $request)
    {
        $kaprodi = Kaprodi::findOrFail($request->id);
        $user = $kaprodi->user;

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'program_studi_id' => 'required|exists:program_studi,id',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update Kaprodi data
        $kaprodi->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'program_studi_id' => $request->program_studi_id,
        ]);

        // Update User data
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Data Kaprodi berhasil diperbarui!');
    }

    public function deleteKaprodi($id)
    {
        $kaprodi = Kaprodi::findOrFail($id);

        // Hapus user terkait
        $user = $kaprodi->user;
        if ($user) {
            $user->delete();
        }

        // Hapus kaprodi
        $kaprodi->delete();

        return redirect()->back()->with('success', 'Data Kaprodi berhasil dihapus!');
    }




    public function pengajuan()
    {
        $dosen = Dosen::all();
        $pengajuan = Pengajuan::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('admin.pengajuan', compact('pengajuan', 'dosen'));
    }


    public function createJadwal(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengajuan_id' => 'required|exists:pengajuan,id',
            'penguji_satu' => 'required|exists:dosen,id',
            'penguji_dua' => 'required|exists:dosen,id',
            'penguji_tiga' => 'required|exists:dosen,id',
            'waktu' => 'required|date',
            'ruangan' => 'required|string|max:255',
        ]);

        // Periksa apakah status pengajuan sudah disetujui
        $pengajuan = Pengajuan::find($request->pengajuan_id);
        if ($pengajuan->status !== 'approved') {
            return redirect()->back()->with('error', 'Pengajuan belum disetujui.');
        }

        // Buat jadwal baru
        Jadwal::create([
            'pengajuan_id' => $request->pengajuan_id,
            'penguji_satu' => $request->penguji_satu,
            'penguji_dua' => $request->penguji_dua,
            'penguji_tiga' => $request->penguji_tiga,
            'waktu' => $request->waktu,
            'ruangan' => $request->ruangan,
        ]);

        // Update kolom jadwal di table pengajuan
        $pengajuan->jadwal = 1;
        $pengajuan->save();

        return redirect()->back()->with('success', 'Jadwal berhasil dibuat dan pengajuan diupdate.');
    }

    public function jadwal()
    {
        $jadwal = Jadwal::all();
        return view('admin.jadwal', compact('jadwal'));
    }

    public function mahasiswa()
    {
        $mahasiswa = BiodataMahasiswa::all();
        return view('admin.mahasiswa', compact('mahasiswa'));
    }
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('123456');
        $user->save();

        return redirect()->back()->with('success', 'Password has been reset to 123456');
    }
}
