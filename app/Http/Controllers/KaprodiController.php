<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index()
    {
        return view('kaprodi.dashboard');
    }
    public function pengajuan()
    {
        $pengajuan = Pengajuan::all();
        return view('kaprodi.pengajuan', compact('pengajuan'));
    }
    public function updateStatus(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'pengajuan_id' => 'required|exists:pengajuan,id', // Memastikan pengajuan_id ada dalam tabel pengajuans
            'status' => 'required|in:pending,rejected,accepted', // Memastikan status hanya bisa 'pending', 'rejected', atau 'accepted'
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
