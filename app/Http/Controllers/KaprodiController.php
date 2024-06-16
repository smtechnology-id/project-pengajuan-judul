<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\BiodataMahasiswa;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    public function index()
    {
        $mahasiswa = BiodataMahasiswa::all()->count();
        $dosen = Dosen::all()->count();
        $pengajuan = Pengajuan::all()->count();
        $jadwal = Jadwal::all()->count();
        return view('admin.dashboard', compact('mahasiswa', 'dosen', 'pengajuan', 'jadwal'));
    }
    public function pengajuan()
    {
        $program_studi_id = Auth::user()->kaprodi->program_studi_id;
        $pengajuan = Pengajuan::where('program_studi_id', $program_studi_id)->get();
        return view('kaprodi.pengajuan', compact('pengajuan'));
    }
    public function updateStatus(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'pengajuan_id' => 'required|exists:pengajuan,id', // Memastikan pengajuan_id ada dalam tabel pengajuans
            'status' => 'required|in:pending,rejected,approved', // Memastikan status hanya bisa 'pending', 'rejected', atau 'accepted'
            'catatan' => 'nullable|string', // Catatan bisa kosong atau berisi string
        ]);

        try {
            // Cari pengajuan berdasarkan ID
            $pengajuan = Pengajuan::findOrFail($validatedData['pengajuan_id']);

            // Update status pengajuan
            $pengajuan->status = $validatedData['status'];

            // Jika ada catatan, tambahkan ke dalam pengajuan
            if (isset($validatedData['catatan'])) {
                $pengajuan->catatan = $validatedData['catatan'];
            }

            // Simpan perubahan
            $pengajuan->save();

            // Beri pesan sukses atau lakukan tindakan lain seperti redirect
            return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan, misalnya pengajuan tidak ditemukan
            return redirect()->back()->with('error', 'Gagal memperbarui status pengajuan: ' . $e->getMessage());
        }
    }
}
