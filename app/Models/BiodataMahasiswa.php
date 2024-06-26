<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'biodata_mahasiswa';

    protected $fillable = [
        'user_id',
        'program_studi_id',
        'nim',
        'nama',
        'jenis_kelamin',
        'no_hp',
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi dengan model ProgramStudi
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
