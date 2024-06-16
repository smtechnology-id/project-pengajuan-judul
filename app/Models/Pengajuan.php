<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';

    protected $fillable = [
        'id_user',
        'dosen_satu',
        'dosen_dua',
        'program_studi_id',
        'judul',
        'deskripsi',
        'status',
        'catatan',
        'jadwal',
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Definisikan relasi dengan model Dosen untuk dosen satu
    public function dosenSatu()
    {
        return $this->belongsTo(Dosen::class, 'dosen_satu');
    }

    // Definisikan relasi dengan model Dosen untuk dosen dua
    public function dosenDua()
    {
        return $this->belongsTo(Dosen::class, 'dosen_dua');
    }

    // Definisikan relasi dengan model ProgramStudi
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
