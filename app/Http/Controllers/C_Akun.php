<?php

namespace App\Http\Controllers;

use App\Models\M_Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class C_Akun extends Controller
{
    // Tampilan Landing Page
    public function landing()
    {
        return view('V_Landing');
    }

    // Form Daftar
    public function formDaftar()
    {
        return view('auth.V_Daftar');
    }

    // Proses Daftar
    public function daftar(Request $req)
    {
        $req->validate([
            'email' => 'required|email|unique:users,email',
            'nama_lengkap' => 'required',
            'username' => 'required|min:6|unique:users,username',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.min' => 'Nama pengguna minimal 6 karakter.',
            'username.unique' => 'Nama pengguna sudah ada.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = M_Akun::create([
            'email' => $req->email,
            'nama_lengkap' => $req->nama_lengkap,
            'username' => $req->username,
            'password' => Hash::make($req->password),
        ]);

        return redirect()->route('masuk')->with('success', 'Akun berhasil dibuat!');
    }

    // Form Masuk
    public function formMasuk()
    {
        return view('auth.V_Masuk');
    }

    // Proses Masuk
    public function masuk(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password])) {
            $req->session()->regenerate();

            return redirect()->intended('/lelang-umum')->with('success', 'Berhasil masuk ke aplikasi.');
        }

        return back()->withErrors(['login' => 'Username atau password yang Anda masukkan salah!'])->withInput();
    }

    // Logout
    public function keluar()
    {
        Auth::logout();

        return redirect()->route('landing');
    }

    // Form Lupa Password (Kirim OTP)
    public function formLupaPassword()
    {
        return view('auth.V_LupaPassword');
    }

    // Kirim OTP via Email
    public function kirimOTP(Request $req)
    {
        $req->validate(['email' => 'required|email|exists:users,email']);
        $user = M_Akun::where('email', $req->email)->first();
        $otp = rand(100000, 999999);
        $user->reset_otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::raw("Kode OTP Anda: $otp", function ($msg) use ($user) {
            $msg->to($user->email)->subject('Reset Password Cakleker Auction');
        });
        session(['reset_email' => $user->email]);

        return redirect()->route('verifikasi.otp')->with('success', 'Kode OTP dikirim ke email Anda.');
    }

    // Form Verifikasi OTP
    public function formVerifikasiOTP()
    {
        return view('auth.V_VerifikasiOTP');
    }

    // Verifikasi OTP
    public function verifikasiOTP(Request $req)
    {
        $req->validate(['otp' => 'required|numeric']);
        $email = session('reset_email');
        $user = M_Akun::where('email', $email)->first();
        if ($user && $user->reset_otp == $req->otp && now()->lt($user->otp_expires_at)) {
            session(['verify_ok' => true]);

            return redirect()->route('ubah.password');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
    }

    // Form Ubah Password Baru
    public function formUbahPassword()
    {
        if (! session('verify_ok')) {
            return redirect()->route('lupa.password');
        }

        return view('auth.V_UbahPassword');
    }

    // Proses Ubah Password
    public function ubahPassword(Request $req)
    {
        $req->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $email = session('reset_email');
        $user = M_Akun::where('email', $email)->first();
        $user->password = Hash::make($req->password);
        $user->reset_otp = null;
        $user->otp_expires_at = null;
        $user->save();
        session()->forget(['reset_email', 'verify_ok']);

        return redirect()->route('masuk')->with('success', 'Password berhasil diubah, silakan login.');
    }

    // Halaman Akun (Profil)
    public function akun()
    {
        $user = Auth::user();

        return view('V_Akun', compact('user'));
    }

    // Update Profil (termasuk foto & password opsional)
    public function updateProfil(Request $req)
    {
        $user = Auth::user();
        $rules = [
            'email' => 'required|email|unique:users,email,'.$user->id,
            'nama_lengkap' => 'required',
            'username' => 'required|min:6|unique:users,username,'.$user->id,
            'foto_profil' => 'nullable|image|max:2048',
        ];
        if ($req->filled('password')) {
            $rules['password'] = 'required|min:8|confirmed';
        }
        $req->validate($rules, [
            'foto_profil.max' => 'Ukuran foto profil tidak boleh lebih dari 2 MB.',
            'foto_profil.image' => 'File yang diunggah harus berupa gambar.',
        ]);

        $user->email = $req->email;
        $user->nama_lengkap = $req->nama_lengkap;
        $user->username = $req->username;
        if ($req->filled('password')) {
            $user->password = Hash::make($req->password);
        }
        if ($req->hasFile('foto_profil')) {
            $manager = new ImageManager(new Driver);
            $image = $manager->decodePath($req->file('foto_profil')->getPathname());
            $encoded = $image->encode(new WebpEncoder(quality: 85));
            $filename = 'foto_profil/'.Str::random(40).'.webp';

            Storage::disk('public')->put($filename, $encoded->toString());
            $user->foto_profil = $filename;
        }
        $user->save();

        return redirect()->route('akun')->with('success', 'Data akun berhasil diubah!');
    }
}
