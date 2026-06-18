<?php

namespace App\Http\Controllers;

use App\Models\M_FotoLelang;
use App\Models\M_Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

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
            ->orderBy('created_at', 'desc')
            ->get();

        // Riwayat lelang umum: lelang yang sudah berakhir dan user pernah menawar
        $riwayat = M_Lelang::where('waktu_berakhir', '<=', now())
            ->whereHas('penawaran', fn ($q) => $q->where('pembeli_id', $user->id))
            ->when($search, fn ($q) => $q->where('judul', 'like', "%$search%"))
            ->orderBy('waktu_berakhir', 'desc')
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
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayatSaya = M_Lelang::where('penjual_id', $user->id)
            ->where(function ($q) {
                $q->where('waktu_berakhir', '<=', now())
                    ->orWhere('is_active', false);
            })
            ->when($search, fn ($q) => $q->where('judul', 'like', "%$search%"))
            ->orderBy('waktu_berakhir', 'desc')
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
            'foto.*' => 'file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
        ], [
            'foto.*.max' => 'Salah satu ukuran foto mobil melebihi 2 MB. Harap perkecil ukuran foto.',
            'foto.*.mimes' => 'File yang diunggah harus berupa gambar yang valid (JPG, PNG, GIF, WEBP, AVIF).',
            'foto.*.file' => 'Gagal mengunggah file foto.',
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

        $manager = new ImageManager(new Driver);

        // Upload banyak foto dengan konversi ke WebP
        foreach ($req->file('foto') as $index => $foto) {
            $image = $manager->decodePath($foto->getPathname());
            $encoded = $image->encode(new WebpEncoder(quality: 85));
            $filename = 'foto_lelang/'.Str::random(40).'.webp';

            Storage::disk('public')->put($filename, $encoded->toString());

            M_FotoLelang::create([
                'lelang_id' => $lelang->id,
                'path_foto' => $filename,
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
