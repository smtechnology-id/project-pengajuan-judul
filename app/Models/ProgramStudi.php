<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;
     // Nama tabel di database
     protected $table = 'program_studi';

     // Field yang dapat diisi secara massal
     protected $fillable = [
         'nama',
         'jurusan',
     ];
     public function kaprodi()
    {
        return $this->hasMany(Kaprodi::class, 'program_studi_id');
    }
    public function biodataMahasiswa()
    {
        return $this->hasMany(BiodataMahasiswa::class, 'program_studi_id');
    }
}
