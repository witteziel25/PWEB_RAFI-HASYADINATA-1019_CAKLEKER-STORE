<?php

namespace App\Http\Controllers;

use App\Models\M_FotoLelang;
use App\Models\M_Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Lelang extends Controller
{
    // Tampilan Lelang Umum (Aktif & Riwayat)
    public function umum(Request $req)
    {
        $user = Auth::user();
        $search = $req->query('search');
        $lelangAktif = M_Lelang::where('is_active', true)
            ->where('waktu_berakhir', '>', now())
            ->when($search, fn ($q) => $q->where('judul', 'like', "%$search%"))
            ->get();

        // Riwayat lelang umum: lelang yang sudah berakhir dan user pernah menawar
        $riwayat = M_Lelang::where('waktu_berakhir', '<=', now())
            ->whereHas('penawaran', fn ($q) => $q->where('pembeli_id', $user->id))
            ->when($search, fn ($q) => $q->where('judul', 'like', "%$search%"))
            ->get();

        return view('V_LelangUmum', compact('lelangAktif', 'riwayat', 'search'));
    }

    // Tampilan Lelang Pribadi (Aktif & Riwayat milik sendiri)
    public function pribadi(Request $req)
    {
        $user = Auth::user();
        $search = $req->query('search');
        $lelangAktifSaya = M_Lelang::where('penjual_id', $user->id)
            ->where('is_active', true)
            ->where('waktu_berakhir', '>', now())
            ->when($search, fn ($q) => $q->where('judul', 'like', "%$search%"))
            ->get();

        $riwayatSaya = M_Lelang::where('penjual_id', $user->id)
            ->where(function ($q) {
                $q->where('waktu_berakhir', '<=', now())
                    ->orWhere('is_active', false);
            })
            ->when($search, fn ($q) => $q->where('judul', 'like', "%$search%"))
            ->get();

        return view('V_LelangPribadi', compact('lelangAktifSaya', 'riwayatSaya', 'search'));
    }

    // Form Buat Lelang Baru
    public function formBuat()
    {
        return view('V_BuatLelang');
    }

    // Proses Simpan Lelang Baru
    public function simpanLelang(Request $req)
    {
        $req->validate([
            'judul' => 'required|max:100',
            'deskripsi' => 'required|max:10000',
            'harga_awal' => 'required|numeric|min:0',
            'waktu_mulai' => 'required|date',
            'waktu_berakhir' => 'required|date|after:waktu_mulai',
            'titik_pertemuan' => 'required|string',
            'foto' => 'required|array',
            'foto.*' => 'image|max:2048',
        ]);

        $lelang = M_Lelang::create([
            'penjual_id' => Auth::id(),
            'judul' => $req->judul,
            'deskripsi' => $req->deskripsi,
            'harga_awal' => $req->harga_awal,
            'waktu_mulai' => $req->waktu_mulai,
            'waktu_berakhir' => $req->waktu_berakhir,
            'titik_pertemuan' => $req->titik_pertemuan,
            'is_active' => true,
        ]);

        // Upload banyak foto
        foreach ($req->file('foto') as $index => $foto) {
            $path = $foto->store('foto_lelang', 'public');
            M_FotoLelang::create([
                'lelang_id' => $lelang->id,
                'path_foto' => $path,
                'urutan' => $index,
            ]);
        }

        return redirect()->route('lelang.umum')->with('success', 'Pelelangan berhasil dibuat!');
    }

    // Batalkan lelang (hanya jika belum ada penawaran)
    public function batalkan($id)
    {
        $lelang = M_Lelang::where('penjual_id', Auth::id())->findOrFail($id);
        if ($lelang->penawaran()->count() == 0 && $lelang->waktu_berakhir > now()) {
            $lelang->is_active = false;
            $lelang->save();

            return back()->with('success', 'Lelang berhasil dibatalkan.');
        }

        return back()->with('error', 'Tidak dapat membatalkan lelang karena sudah ada penawaran.');
    }
}
