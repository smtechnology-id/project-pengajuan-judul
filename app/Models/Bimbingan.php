<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $table = 'bimbingan';

    protected $fillable = [
        'user_id',
        'pengajuan_id',
        'tanggal',
        'materi',
        'pembimbing',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Pengajuan model
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
