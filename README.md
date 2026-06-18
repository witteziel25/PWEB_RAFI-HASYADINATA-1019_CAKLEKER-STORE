# Cakleker Auction

Cakleker Auction adalah platform lelang daring berbasis web yang dirancang khusus untuk koleksi mobil Ferrari. Sistem ini memfasilitasi interaksi yang lancar antara penjual dan pembeli melalui mekanisme penawaran harga yang aman dan seketika (real-time).

## Fitur Utama

*   **Autentikasi dan Otorisasi Pengguna**
    *   Sistem pendaftaran dan masuk pengguna yang terenkripsi dan aman.
    *   Mekanisme pengaturan ulang kata sandi menggunakan OTP (One-Time Password) yang dikirim melalui surel (email).
    *   Manajemen profil pengguna termasuk unggahan foto profil.
*   **Manajemen Lelang**
    *   Penjual dapat membuat lelang baru dengan spesifikasi mendetail menggunakan penyunting teks kaya (CKEditor).
    *   Dukungan untuk mengunggah banyak gambar sekaligus per lelang, yang akan dioptimalkan dan dikonversi secara otomatis ke dalam format WebP.
    *   Integrasi peta interaktif (Leaflet & OpenStreetMap) untuk menandai lokasi pertemuan Cash On Delivery (COD) secara akurat.
    *   Kemampuan untuk membatalkan lelang sebelum ada penawaran yang masuk.
*   **Sistem Penawaran (Bidding)**
    *   Pengiriman penawaran harga secara waktu nyata (real-time) menggunakan permintaan AJAX asinkron.
    *   Validasi otomatis untuk memastikan penawaran melampaui harga tertinggi saat ini.
    *   Indikasi yang jelas mengenai penawar tertinggi dan riwayat transaksi.
*   **Dasbor (Dashboards)**
    *   **Dasbor Publik**: Menampilkan seluruh lelang publik yang aktif serta riwayat penawaran pribadi pengguna.
    *   **Dasbor Pribadi**: Memungkinkan pengguna untuk mengelola lelang yang telah mereka buat, melacak status barang aktif, dan meninjau penjualan yang telah selesai.
*   **Antarmuka Pengguna**
    *   Desain responsif dan modern yang dibangun menggunakan Bootstrap 5.
    *   Fitur tombol peralihan antara Mode Gelap (Dark Mode) dan Mode Terang (Light Mode) dengan penyimpanan preferensi pada peramban (browser).

## Tumpukan Teknologi (Technology Stack)

*   **Kerangka Kerja Backend**: Laravel (PHP)
*   **Basis Data**: MySQL
*   **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
*   **Pemrosesan Gambar**: Intervention Image (Driver GD)
*   **Penyunting Teks Kaya**: CKEditor 5
*   **Layanan Pemetaan**: Leaflet JS & Nominatim (OpenStreetMap)

## Persyaratan Sistem

Pastikan server atau lingkungan pengembangan lokal Anda memenuhi persyaratan berikut:
*   PHP >= 8.1
*   Composer
*   MySQL atau MariaDB
*   Node.js dan NPM (opsional, untuk kompilasi aset frontend)
*   Ekstensi GD PHP (diwajibkan untuk pemrosesan gambar)

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk mengatur proyek ini di komputer lokal Anda:

1.  **Kloning Repositori**
    Kloning proyek ke dalam direktori server lokal Anda (misalnya, di dalam Laragon, XAMPP, atau Valet).

2.  **Instalasi Dependensi**
    Arahkan terminal ke dalam direktori proyek dan jalankan Composer untuk menginstal dependensi PHP.
    ```bash
    composer install
    ```

3.  **Konfigurasi Lingkungan (Environment)**
    Salin berkas contoh lingkungan dan sesuaikan konfigurasinya dengan pengaturan basis data Anda.
    ```bash
    cp .env.example .env
    ```
    Buka berkas `.env` dan perbarui kredensial basis data:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cakleker_auction
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    Selain itu, atur pengaturan SMTP Anda agar fungsionalitas surel OTP dapat berjalan dengan baik.

4.  **Hasilkan Kunci Aplikasi**
    Buat kunci aplikasi yang aman untuk Laravel.
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi Basis Data**
    Jalankan perintah migrasi untuk membuat tabel yang dibutuhkan di dalam basis data Anda.
    ```bash
    php artisan migrate
    ```

6.  **Buat Tautan Penyimpanan (Storage Link)**
    Buat tautan simbolik (symbolic link) untuk memastikan gambar yang diunggah dapat diakses secara publik.
    ```bash
    php artisan storage:link
    ```

7.  **Jalankan Aplikasi**
    Mulai peladen pengembangan lokal (local development server).
    ```bash
    php artisan serve
    ```
    Aplikasi dapat diakses melalui peramban pada alamat `http://localhost:8000`.

## Sorotan Struktur Direktori

*   `app/Http/Controllers/`: Berisi logika bisnis aplikasi (contohnya, `C_Lelang.php`, `C_Akun.php`, `C_Penawaran.php`).
*   `app/Models/`: Model Eloquent ORM yang merepresentasikan tabel basis data.
*   `resources/views/`: Templat Blade untuk antarmuka pengguna.
*   `routes/web.php`: Mendefinisikan jalur (routes) web dan perlindungan middleware.

## Lisensi

Proyek ini bersifat hak milik (proprietary) dan ditujukan untuk penerapan khusus. Dilarang keras menyalin atau mendistribusikan basis kode ini tanpa izin.

---

# Cakleker Auction

Cakleker Auction is a web-based online auction platform specifically designed for Ferrari car collections. The system facilitates seamless interactions between sellers and buyers through a secure, real-time bidding mechanism.

## Features

*   **User Authentication and Authorization**
    *   Secure user registration and login system.
    *   Password reset mechanism utilizing OTP (One-Time Password) sent via email.
    *   Profile management including avatar uploads.
*   **Auction Management**
    *   Sellers can create new auctions with detailed specifications using a rich text editor (CKEditor).
    *   Support for multiple image uploads per auction, automatically optimized and converted to WebP format.
    *   Interactive map integration (Leaflet & OpenStreetMap) for precise Cash On Delivery (COD) location tagging.
    *   Ability to cancel auctions before any bids are placed.
*   **Bidding System**
    *   Real-time bid submission using asynchronous AJAX requests.
    *   Automatic validation to ensure bids exceed the current highest offer.
    *   Clear indication of the highest bidder and transaction history.
*   **Dashboards**
    *   **Public Dashboard**: Displays all active public auctions and the user's personal bidding history.
    *   **Personal Dashboard**: Allows users to manage their created auctions, track active listings, and review completed sales.
*   **User Interface**
    *   Responsive and modern design built with Bootstrap 5.
    *   Built-in Dark Mode and Light Mode toggle with local storage persistence.

## Technology Stack

*   **Backend Framework**: Laravel (PHP)
*   **Database**: MySQL
*   **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
*   **Image Processing**: Intervention Image (GD Driver)
*   **Rich Text Editor**: CKEditor 5
*   **Mapping Service**: Leaflet JS & Nominatim (OpenStreetMap)

## System Requirements

Ensure your server or local environment meets the following requirements:
*   PHP >= 8.1
*   Composer
*   MySQL or MariaDB
*   Node.js and NPM (optional, for frontend asset compilation)
*   GD PHP Extension (required for image processing)

## Installation Guide

Follow these steps to set up the project locally:

1.  **Clone the Repository**
    Clone the project into your local server directory (e.g., inside Laragon, XAMPP, or Valet).

2.  **Install Dependencies**
    Navigate to the project directory and run Composer to install PHP dependencies.
    ```bash
    composer install
    ```

3.  **Environment Configuration**
    Copy the example environment file and configure it according to your database setup.
    ```bash
    cp .env.example .env
    ```
    Open the `.env` file and update the database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cakleker_auction
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    Also, configure your SMTP settings for the OTP email functionality to work properly.

4.  **Generate Application Key**
    Generate a secure application key for Laravel.
    ```bash
    php artisan key:generate
    ```

5.  **Run Database Migrations**
    Run the migrations to create the required tables in your database.
    ```bash
    php artisan migrate
    ```

6.  **Create Storage Link**
    Create a symbolic link to ensure uploaded images are publicly accessible.
    ```bash
    php artisan storage:link
    ```

7.  **Run the Application**
    Start the local development server.
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://localhost:8000`.

## Directory Structure Highlights

*   `app/Http/Controllers/`: Contains the application's business logic (e.g., `C_Lelang.php`, `C_Akun.php`, `C_Penawaran.php`).
*   `app/Models/`: Eloquent ORM models representing database tables.
*   `resources/views/`: Blade templates for the user interface.
*   `routes/web.php`: Defines the web routes and middleware protections.

## License

This project is proprietary and intended for specific deployment. Unauthorized copying or distribution of this codebase is prohibited.
