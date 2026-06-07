# Cakleker Auction

**Cakleker Auction** adalah platform lelang mobil *supercar* berbasis web profesional. Aplikasi ini memungkinkan kolektor untuk mencari dan menawar (*bidding*) mobil impian mereka, atau bahkan mendaftar sebagai penjual untuk melelang koleksi pribadinya.

---

## Fitur Unggulan

1. **Sistem Otentikasi & Keamanan Ketat**
   - Registrasi pengguna baru.
   - Verifikasi email via OTP (One-Time Password) 6-digit.
   - Login dengan validasi kredensial (Hanya *Username* & Kata Sandi).
   - Pemulihan akun (Lupa Kata Sandi) melalui *email reset link*.

2. **Manajemen Akun Terintegrasi**
   - Pengaturan informasi profil pribadi.
   - Pengunggahan foto profil dengan optimisasi gambar otomatis.

3. **Dasbor Penjual (Lelang Pribadi)**
   - Form pembuatan lelang yang interaktif (Judul, Harga Awal, Titik Lokasi COD, Rentang Waktu Pelaksanaan).
   - Editor Teks Kaya (Rich Text/CKEditor) untuk penulisan spesifikasi kendaraan.
   - Unggah hingga maksimal 5 lembar foto pameran mobil.
   - Pemantauan tawaran aktif secara langsung.
   - Manajemen riwayat lelang yang telah usai (Terjual / Tidak Terjual).

4. **Sistem Penawaran (Bidding System)**
   - Daftar Lelang Umum yang menampilkan seluruh lelang yang sedang berlangsung.
   - Validasi angka *bidding* agar tawaran selalu melampaui harga puncak saat ini.
   - Format mata uang Rupiah dinamis saat mengetik angka nominal tawaran.
   - Detail informasi kontak pemenang di sesi pelelangan yang sukses diselesaikan.

5. **Pengalaman Antarmuka yang Nyaman**
   - Mode Gelap / Mode Terang (*Dark/Light Mode Toggle*) di seluruh platform web.
   - Kartu daftar lelang yang rapi dengan efek interaktif.

6. **Optimisasi Sisi Server**
   - Konversi dan kompresi file gambar yang diunggah ke format `WebP` berkualitas tinggi menggunakan pustaka *Intervention Image*, untuk kecepatan memuat data halaman.
   - Pembatasan batas kapasitas berkas unggah maksimal 2 MB per foto.

---

## Tech Stack

Aplikasi ini dibangun menggunakan beberapa teknologi berikut:

- **Bahasa Pemrograman**: PHP (v8.2+)
- **Kerangka Kerja (Backend)**: [Laravel 11.x](https://laravel.com/)
- **Kerangka Kerja (Frontend)**: [Bootstrap 5.3](https://getbootstrap.com/)
- **Mesin Tampilan**: Blade Template Engine
- **Basis Data**: MySQL
- **Pengolah Gambar**: [Intervention Image v4](https://image.intervention.io/)

---

## 📜 Lisensi
Aplikasi ini dibangun menggunakan kerangka kerja [Laravel](https://laravel.com/docs/11.x/license). Lisensi proyek ini tunduk pada Lisensi MIT (MIT License). Anda bebas memodifikasi, dan menggunakan kembali kerangka sumber kode dalam platform ini.
