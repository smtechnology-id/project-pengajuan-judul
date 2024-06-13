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
        'judul',
        'deskripsi',
        'status',
        'catatan',
    ];

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan tabel dosens untuk dosen_satu
    public function dosenSatu()
    {
        return $this->belongsTo(Dosen::class, 'dosen_satu');
    }

    // Relasi dengan tabel dosens untuk dosen_dua
    public function dosenDua()
    {
        return $this->belongsTo(Dosen::class, 'dosen_dua');
    }   
}
