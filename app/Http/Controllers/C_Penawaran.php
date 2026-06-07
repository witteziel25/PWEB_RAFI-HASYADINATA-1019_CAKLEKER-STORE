<?php

namespace App\Http\Controllers;

use App\Models\M_Lelang;
use App\Models\M_Penawaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Penawaran extends Controller
{
    // AJAX: Membuat penawaran tanpa reload halaman
    public function buatPenawaran(Request $req, $lelangId)
    {
        $lelang = M_Lelang::findOrFail($lelangId);
        $hargaTertinggi = $lelang->hargaTertinggi();
        $req->validate([
            'harga_tawar' => 'required|numeric|min:'.($hargaTertinggi + 1),
        ], [
            'harga_tawar.min' => 'Nominal penawaran harus lebih tinggi dari harga tertinggi saat ini.',
        ]);

        // Cek apakah lelang masih aktif dan belum berakhir
        if (! $lelang->is_active || now()->gt($lelang->waktu_berakhir)) {
            return response()->json(['error' => 'Lelang sudah tidak aktif.'], 400);
        }

        // Mencegah penawaran pada lelang milik sendiri
        if ($lelang->penjual_id == Auth::id()) {
            return response()->json(['error' => 'Anda tidak bisa menawar lelang milik Anda sendiri.'], 400);
        }

        M_Penawaran::create([
            'lelang_id' => $lelangId,
            'pembeli_id' => Auth::id(),
            'harga_tawar' => $req->harga_tawar,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penawaran berhasil dibuat!',
            'harga_baru' => $req->harga_tawar,
            'jumlah_bid' => $lelang->jumlahBid() + 1,
        ]);
    }
}
