<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
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
            'nip' => 'required|string|max:50|unique:dosens,nip,'.$request->id.',id',
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
}
