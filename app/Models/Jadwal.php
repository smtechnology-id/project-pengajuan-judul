<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwal';

    protected $fillable = [
        'pengajuan_id',
        'penguji_satu',
        'penguji_dua',
        'penguji_tiga',
        'waktu',
        'ruangan',
        'catatan',
        'status',
        'duration',
    ];
    protected $dates = ['waktu'];

    // Option 2: Using $casts (for newer Laravel versions)
    protected $casts = [
        'waktu' => 'datetime',
    ];

    // Definisikan relasi dengan model Pengajuan
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    // Definisikan relasi dengan model Dosen untuk penguji satu
    public function pengujiSatu()
    {
        return $this->belongsTo(Dosen::class, 'penguji_satu');
    }

    // Definisikan relasi dengan model Dosen untuk penguji dua
    public function pengujiDua()
    {
        return $this->belongsTo(Dosen::class, 'penguji_dua');
    }

    // Definisikan relasi dengan model Dosen untuk penguji tiga
    public function pengujiTiga()
    {
        return $this->belongsTo(Dosen::class, 'penguji_tiga');
    }
}
