<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KaprodiController extends Controller
{
    public function index() {
        return view('kaprodi.dashboard');
    }
    public function pengajuan() {
        $pengajuan = Pengajuan::all();
        return view('kaprodi.pengajuan');
    }
}
