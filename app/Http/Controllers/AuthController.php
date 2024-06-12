<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BiodataMahasiswa;
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
        return view('register');
    }
    public function registerPost(Request $request)
    {
        // Validasi data yang dikirimkan dari form register
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nim' => 'required|string|max:255|unique:biodata_mahasiswa',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'jurusan' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);
    
        // Membuat biodata mahasiswa baru
        BiodataMahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'jurusan' => $request->jurusan,
            'program_studi' => $request->program_studi,
        ]);
    
        // Login user setelah registrasi
        auth()->login($user);
    
        // Redirect ke dashboard mahasiswa
        return redirect()->route('mahasiswa.dashboard');
    }
    
}
