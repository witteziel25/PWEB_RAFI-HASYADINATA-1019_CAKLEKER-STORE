<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class M_Akun extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'email', 'nama_lengkap', 'username', 'password', 'foto_profil',
        'reset_otp', 'otp_expires_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relasi one-to-many: user sebagai penjual
    public function lelangDibuat()
    {
        return $this->hasMany(M_Lelang::class, 'penjual_id');
    }

    // Relasi one-to-many: user sebagai pembeli (penawaran)
    public function penawaranDibuat()
    {
        return $this->hasMany(M_Penawaran::class, 'pembeli_id');
    }
}
