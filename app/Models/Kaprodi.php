<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;
    protected $table = 'kaprodi';

    protected $fillable = [
        'program_studi_id',
        'user_id',
        'nama',
        'nip',
        'jabatan',
    ];

    // Define the relationship with ProgramStudi
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
