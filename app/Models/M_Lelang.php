<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Lelang extends Model
{
    protected $table = 'lelangs';

    protected $fillable = [
        'penjual_id', 'judul', 'deskripsi', 'harga_awal',
        'waktu_mulai', 'waktu_berakhir', 'titik_pertemuan', 'is_active',
    ];

    // Relasi ke penjual
    public function penjual()
    {
        return $this->belongsTo(M_Akun::class, 'penjual_id');
    }

    // Relasi ke foto
    public function foto()
    {
        return $this->hasMany(M_FotoLelang::class, 'lelang_id')->orderBy('urutan');
    }

    // Relasi ke penawaran
    public function penawaran()
    {
        return $this->hasMany(M_Penawaran::class, 'lelang_id');
    }

    // Helper: harga tertinggi saat ini
    public function hargaTertinggi()
    {
        return $this->penawaran()->max('harga_tawar') ?? $this->harga_awal;
    }

    // Helper: pemenang (pembeli dengan harga tertinggi)
    public function pemenang()
    {
        $maxBid = $this->penawaran()->orderBy('harga_tawar', 'desc')->first();

        return $maxBid ? $maxBid->pembeli : null;
    }

    // Helper: jumlah total penawaran (bid)
    public function jumlahBid()
    {
        return $this->penawaran()->count();
    }
}
