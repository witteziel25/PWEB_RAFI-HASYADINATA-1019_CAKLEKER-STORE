<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Penawaran extends Model
{
    protected $table = 'penawarans';

    protected $fillable = ['lelang_id', 'pembeli_id', 'harga_tawar'];

    public function lelang()
    {
        return $this->belongsTo(M_Lelang::class, 'lelang_id');
    }

    public function pembeli()
    {
        return $this->belongsTo(M_Akun::class, 'pembeli_id');
    }
}
