<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
            'nip' => 'required|string|max:50|unique:dosens', // unique:dosens menandakan validasi unik di tabel dosens
        ]);

        Dosen::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
        ]);

        return redirect()->back()->with('success', 'Data dosen berhasil ditambahkan!');
    }
    public function updateDosen(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'id' => 'required|exists:dosens,id',
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:dosens,nip,' . $request->id . ',id',
        ]);

        // Cari data dosen berdasarkan ID
        $dosen = Dosen::findOrFail($request->id);

        // Update data dosen
        $dosen->nama = $request->nama;

        // Check if NIP is being changed
        if ($dosen->nip !== $request->nip) {
            // Validate unique NIP if it has been changed
            $request->validate([
                'nip' => 'unique:dosens,nip',
            ]);
            $dosen->nip = $request->nip;
        }

        $dosen->save();

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
            'penguji_satu' => 'required|exists:dosens,id',
            'penguji_dua' => 'required|exists:dosens,id',
            'penguji_tiga' => 'required|exists:dosens,id',
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

        return redirect()->back()->with('success', 'Jadwal berhasil dibuat.');
    }

    public function jadwal() {
        $jadwal = Jadwal::all();
        return view ('admin.jadwal', compact('jadwal'));
    }
}
