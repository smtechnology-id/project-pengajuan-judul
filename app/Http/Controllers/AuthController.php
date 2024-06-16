<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Bimbingan;
use App\Models\Pengajuan;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Models\BiodataMahasiswa;
use App\Models\Kaprodi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginPost(Request $request)
    {
        // Validasi data yang dikirimkan dari form login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Coba untuk mengautentikasi user
        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil

            $user = Auth::user();

            // Redirect sesuai dengan peran pengguna
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard'); // Ganti dengan nama route admin jika ada
            } elseif ($user->role == 'kaprodi') {
                return redirect()->route('kaprodi.dashboard'); // Ganti dengan nama route kaprodi jika ada
            } elseif ($user->role == 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard'); // Ganti dengan nama route mahasiswa jika ada
            } else {
                // Jika perlu, tambahkan logika untuk peran lainnya di sini
                return redirect()->intended('/dashboard'); // Redirect ke dashboard umum jika peran tidak cocok
            }
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout()
    {
        Auth::logout(); // Memanggil metode logout dari Auth

        // Invalidasi sesi user
        session()->invalidate();

        // Regenerate CSRF token
        session()->regenerateToken();

        // Redirect ke halaman utama atau halaman login
        return redirect('/login');
    }

    public function register()
    {
        $program_studis = ProgramStudi::all();
        return view('register', compact('program_studis'));
    }
    public function registerPost(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|max:50|unique:biodata_mahasiswa',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|string|max:20',
            'program_studi_id' => 'required|exists:program_studi,id',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->nama,
            'role' => 'mahasiswa',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create biodata mahasiswa
        $mahasiswa = BiodataMahasiswa::create([
            'user_id' => $user->id,
            'program_studi_id' => $request->program_studi_id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        // Redirect or do something after registration
        auth()->login($user);
        // Redirect ke dashboard mahasiswa
        return redirect()->route('mahasiswa.dashboard');
    }


    public function detailJadwal($id)
    {
        $jadwal = Jadwal::where('pengajuan_id', $id)->first();
        $pengajuan = Pengajuan::where('id', $jadwal->pengajuan_id)->first();
        $user = User::where('id', $pengajuan->id_user)->first();
        $biodata = BiodataMahasiswa::where('user_id', $user->id)->first();
        return view('jadwal', compact('jadwal', 'pengajuan', 'user', 'biodata'));
    }
    public function cetakKartu($id)
    {
        $user_id = Auth::id();
        $pengajuan = Pengajuan::where('id_user', $id)->first();
        $bimbinganSatu = Bimbingan::where('user_id', $id)->where('pembimbing', '1')->get();
        $bimbinganDua = Bimbingan::where('user_id', $id)->where('pembimbing', '2')->get();
        $tanggalNow = now()->format('Y-m-d'); // Contoh format tanggal YYYY-MM-DD
        $kaprodi = Kaprodi::where('program_studi_id', $pengajuan->program_studi_id)->first();
        return view('cetakKartu', compact('pengajuan', 'bimbinganDua', 'bimbinganSatu', 'tanggalNow', 'kaprodi'));
    }
}
