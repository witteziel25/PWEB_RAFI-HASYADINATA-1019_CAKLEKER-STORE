<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataLelangSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'harirafi25@gmail.com',
                'nama_lengkap' => 'Rafi Hasyadinata',
                'username' => 'rafihasya',
                'password' => '$2y$12$0nKG3qi64CwFSURz2n2Um.2DM7WZQlSBpPr8osbtuc.YhrYUQUgEu',
                'foto_profil' => null,
                'reset_otp' => null,
                'otp_expires_at' => null,
                'remember_token' => null,
                'created_at' => '2026-06-04 20:44:05',
                'updated_at' => '2026-06-06 18:09:25',
            ],
            [
                'id' => 2,
                'email' => 'wittezielofficial@gmail.com',
                'nama_lengkap' => 'El Adinata',
                'username' => 'witteziel',
                'password' => '$2y$12$fuMo5iNuwTnOd6XdcjCgQufi12tCmZN.IIpZzW4oQzVL.YlkWfrEC',
                'foto_profil' => null,
                'reset_otp' => null,
                'otp_expires_at' => null,
                'remember_token' => null,
                'created_at' => '2026-06-07 09:03:11',
                'updated_at' => '2026-06-07 09:03:11',
            ],
            [
                'id' => 3,
                'email' => '242410101019@mail.unej.ac.id',
                'nama_lengkap' => 'El Rafi',
                'username' => 'dinatarf',
                'password' => '$2y$12$M/5xub8HSo15rzMYsP.8/.rGokp7TLRVHwXPFTMD1YKlT2HOI1uzm',
                'foto_profil' => null,
                'reset_otp' => null,
                'otp_expires_at' => null,
                'remember_token' => null,
                'created_at' => '2026-06-07 16:26:56',
                'updated_at' => '2026-06-07 16:26:56',
            ],
        ]);

        DB::table('lelangs')->insert([
            [
                'id' => 1,
                'penjual_id' => 1,
                'judul' => 'Ferrari Roma Spider',
                'deskripsi' => '<p><strong>\"La Nuova Dolce Vita\" – Kehidupan Manis yang Baru.</strong> Ferrari Roma ini hadir memadukan keanggunan desain Gran Turismo klasik tahun 1960-an dengan performa <i>supercar</i> modern. Unit ini merupakan permata langka karena menyandang status <strong>1st Owner (Tangan Pertama dari Baru)</strong> dan masuk dalam kategori <i>garage queen</i>—sangat jarang digunakan oleh pemiliknya, namun dirawat secara perfeksionis.</p><p><strong>Kondisi Eksterior:</strong> 100% <i>original paint</i>. Siluet bodi bergaya <i>shark-nose</i> yang minimalis bebas dari <i>stone chips</i> maupun baret halus. Seluruh panel aerodinamis aktif, termasuk <i>mobile rear spoiler</i> di kaca belakang, berfungsi sempurna tanpa kendala.</p><p><strong>Kondisi Interior:</strong> Aroma kulit mewah khas Maranello masih pekat. Interior berkonsep <i>Dual-Cockpit</i> digital bersih tanpa cacat (<i>no sticky buttons</i>), dan balutan kulit pada jok maupun setir tidak menunjukkan tanda-tanda aus (<i>creasing</i> sangat minim).</p><p><strong>Kondisi Mekanis:</strong> Mesin V8 Twin-Turbo yang memenangkan penghargaan <i>International Engine of the Year</i> berada dalam kondisi prima. Rekam jejak servis (<i>service record</i>) tercatat lengkap di bengkel resmi Ferrari, memastikan seluruh sistem elektrikal, transmisi 8-percepatan DCT, dan oli berada pada spesifikasi pabrikan terbaik.</p><p><strong>1. Jantung Pacu (Engine &amp; Powertrain)</strong></p><p><strong>Tipe Mesin:</strong> Ferrari F154BH, 90° V8 Twin-Turbocharged (Bensin)</p><p><strong>Kapasitas Mesin:</strong> 3.855 cc (3.9 Liter)</p><p><strong>Output Tenaga Maksimum:</strong> 620 cv / 612 HP @ 5.750 – 7.500 RPM</p><p><strong>Torsi Maksimum:</strong> 760 Nm @ 3.000 – 5.750 RPM</p><p><strong>Bore x Stroke:</strong> 86,5 mm x 82 mm</p><p><strong>Rasio Kompresi:</strong> 9.45:1</p><p><strong>2. Transmisi &amp; Penggerak (Transmission &amp; Drivetrain)</strong></p><p><strong>Sistem Transmisi:</strong> 8-speed F1 Dual-Clutch Transmission (DCT) – basis teknologi yang sama dengan Ferrari SF90 Stradale.</p><p><strong>Sistem Penggerak:</strong> Front-Mid Engine, Rear-Wheel Drive (Mesin di depan-tengah, penggerak roda belakang).</p><p><strong>3. Performa (Performance Figures)</strong></p><p><strong>Akselerasi 0-100 km/jam:</strong> 3,4 detik</p><p><strong>Akselerasi 0-200 km/jam:</strong> 9,3 detik</p><p><strong>Kecepatan Maksimum (Top Speed):</strong> &gt; 320 km/jam (&gt; 199 mph)</p>',
                'harga_awal' => 7000000000.00,
                'waktu_mulai' => '2026-06-07 03:15:00',
                'waktu_berakhir' => '2026-06-07 03:30:00',
                'titik_pertemuan' => 'Universitas Jember, Jember, Jawa Timur, Jawa, 68121, Indonesia',
                'is_active' => 0,
                'created_at' => '2026-06-06 20:14:11',
                'updated_at' => '2026-06-06 20:30:21',
            ],
            [
                'id' => 2,
                'penjual_id' => 1,
                'judul' => 'Ferrari Roma Spider',
                'deskripsi' => '<p><strong>Kondisi Eksterior:</strong> 100% <i>original paint</i>. Siluet bodi bergaya <i>shark-nose</i> yang minimalis bebas dari <i>stone chips</i> maupun baret halus. Seluruh panel aerodinamis aktif, termasuk <i>mobile rear spoiler</i> di kaca belakang, berfungsi sempurna tanpa kendala.</p><p><strong>Kondisi Interior:</strong> Aroma kulit mewah khas Maranello masih pekat. Interior berkonsep <i>Dual-Cockpit</i> digital bersih tanpa cacat (<i>no sticky buttons</i>), dan balutan kulit pada jok maupun setir tidak menunjukkan tanda-tanda aus (<i>creasing</i> sangat minim).</p><p><strong>Kondisi Mekanis:</strong> Mesin V8 Twin-Turbo yang memenangkan penghargaan <i>International Engine of the Year</i> berada dalam kondisi prima. Rekam jejak servis (<i>service record</i>) tercatat lengkap di bengkel resmi Ferrari, memastikan seluruh sistem elektrikal, transmisi 8-percepatan DCT, dan oli berada pada spesifikasi pabrikan terbaik.</p><p>Berikut adalah spesifikasi otentik dan detail dari Ferrari Roma:</p><p><strong>1. Jantung Pacu (Engine &amp; Powertrain)</strong></p><p><strong>Tipe Mesin:</strong> Ferrari F154BH, 90° V8 Twin-Turbocharged (Bensin)</p><p><strong>Kapasitas Mesin:</strong> 3.855 cc (3.9 Liter)</p><p><strong>Output Tenaga Maksimum:</strong> 620 cv / 612 HP @ 5.750 – 7.500 RPM</p><p><strong>Torsi Maksimum:</strong> 760 Nm @ 3.000 – 5.750 RPM</p><p><strong>Bore x Stroke:</strong> 86,5 mm x 82 mm</p><p><strong>Rasio Kompresi:</strong> 9.45:1</p><p><strong>Sistem Manajemen Torsi:</strong> <i>Variable Boost Management</i> (Mengeliminasi <i>turbo lag</i> dan mengoptimalkan dorongan di setiap gigi).</p><p><strong>2. Transmisi &amp; Penggerak (Transmission &amp; Drivetrain)</strong></p><p><strong>Sistem Transmisi:</strong> 8-speed F1 Dual-Clutch Transmission (DCT) – basis teknologi yang sama dengan Ferrari SF90 Stradale.</p><p><strong>Sistem Penggerak:</strong> Front-Mid Engine, Rear-Wheel Drive (Mesin di depan-tengah, penggerak roda belakang).</p><p><strong>3. Performa (Performance Figures)</strong></p><p><strong>Akselerasi 0-100 km/jam:</strong> 3,4 detik</p><p><strong>Akselerasi 0-200 km/jam:</strong> 9,3 detik</p><p><strong>Kecepatan Maksimum (Top Speed):</strong> &gt; 320 km/jam (&gt; 199 mph)</p>',
                'harga_awal' => 6000000000.00,
                'waktu_mulai' => '2026-06-07 16:05:00',
                'waktu_berakhir' => '2026-06-07 16:10:00',
                'titik_pertemuan' => 'Alun alun Jember, Jember, Jawa Timur, Jawa, Indonesia',
                'is_active' => 1,
                'created_at' => '2026-06-07 09:00:55',
                'updated_at' => '2026-06-07 09:00:55',
            ],
            [
                'id' => 4,
                'penjual_id' => 3,
                'judul' => 'Ferrari Roma Spider La Argento',
                'deskripsi' => '<p><strong>Kondisi Eksterior:</strong> 100% <i>original paint</i>. Siluet bodi bergaya <i>shark-nose</i> yang minimalis bebas dari <i>stone chips</i> maupun baret halus. Seluruh panel aerodinamis aktif, termasuk <i>mobile rear spoiler</i> di kaca belakang, berfungsi sempurna tanpa kendala.</p><p><strong>Kondisi Interior:</strong> Aroma kulit mewah khas Maranello masih pekat. Interior berkonsep <i>Dual-Cockpit</i> digital bersih tanpa cacat (<i>no sticky buttons</i>), dan balutan kulit pada jok maupun setir tidak menunjukkan tanda-tanda aus (<i>creasing</i> sangat minim).</p><p><strong>Kondisi Mekanis:</strong> Mesin V8 Twin-Turbo yang memenangkan penghargaan <i>International Engine of the Year</i> berada dalam kondisi prima. Rekam jejak servis (<i>service record</i>) tercatat lengkap di bengkel resmi Ferrari, memastikan seluruh sistem elektrikal, transmisi 8-percepatan DCT, dan oli berada pada spesifikasi pabrikan terbaik.</p><p>Mobil ini sangat cocok bagi kolektor atau antusias yang menginginkan sensasi memiliki Ferrari baru langsung dari <i>showroom</i>, namun tanpa waktu tunggu (<i>inden</i>) yang lama.</p><p><strong>1. Jantung Pacu (Engine &amp; Powertrain)</strong></p><p><strong>Tipe Mesin:</strong> Ferrari F154BH, 90° V8 Twin-Turbocharged (Bensin)</p><p><strong>Kapasitas Mesin:</strong> 3.855 cc (3.9 Liter)</p><p><strong>Output Tenaga Maksimum:</strong> 620 cv / 612 HP @ 5.750 – 7.500 RPM</p><p><strong>Torsi Maksimum:</strong> 760 Nm @ 3.000 – 5.750 RPM</p><p><strong>Bore x Stroke:</strong> 86,5 mm x 82 mm</p><p><strong>Rasio Kompresi:</strong> 9.45:1</p><p><strong>Sistem Manajemen Torsi:</strong> <i>Variable Boost Management</i> (Mengeliminasi <i>turbo lag</i> dan mengoptimalkan dorongan di setiap gigi).</p><p><strong>2. Transmisi &amp; Penggerak (Transmission &amp; Drivetrain)</strong></p><p><strong>Sistem Transmisi:</strong> 8-speed F1 Dual-Clutch Transmission (DCT) – basis teknologi yang sama dengan Ferrari SF90 Stradale.</p><p><strong>Sistem Penggerak:</strong> Front-Mid Engine, Rear-Wheel Drive (Mesin di depan-tengah, penggerak roda belakang).</p><p><strong>3. Performa (Performance Figures)</strong></p><p><strong>Akselerasi 0-100 km/jam:</strong> 3,4 detik</p><p><strong>Akselerasi 0-200 km/jam:</strong> 9,3 detik</p><p><strong>Kecepatan Maksimum (Top Speed):</strong> &gt; 320 km/jam (&gt; 199 mph)</p>',
                'harga_awal' => 5000000000.00,
                'waktu_mulai' => '2026-06-07 16:33:00',
                'waktu_berakhir' => '2026-06-07 16:45:00',
                'titik_pertemuan' => 'Lippo Mall, Jalan Gajah Mada, Jember, Jawa Timur, Jawa, 68131, Indonesia',
                'is_active' => 1,
                'created_at' => '2026-06-07 16:32:19',
                'updated_at' => '2026-06-07 16:32:19',
            ],
        ]);

        DB::table('foto_lelangs')->insert([
            [
                'id' => 1,
                'lelang_id' => 1,
                'path_foto' => 'foto_lelang/liInrjTxnyCBszHAYZS8S7KzyPWw7oTKyCbvLSnM.jpg',
                'urutan' => 0,
                'created_at' => '2026-06-06 20:14:12',
                'updated_at' => '2026-06-06 20:14:12',
            ],
            [
                'id' => 2,
                'lelang_id' => 1,
                'path_foto' => 'foto_lelang/vFYrkLhsUnWEDRwFJPq8pkZwEPZTSHO2sat03yGv.jpg',
                'urutan' => 1,
                'created_at' => '2026-06-06 20:14:12',
                'updated_at' => '2026-06-06 20:14:12',
            ],
            [
                'id' => 3,
                'lelang_id' => 1,
                'path_foto' => 'foto_lelang/J5bJG9GOsZV0odLYxaem4AFl6xGF6to14MOyFq63.jpg',
                'urutan' => 2,
                'created_at' => '2026-06-06 20:14:12',
                'updated_at' => '2026-06-06 20:14:12',
            ],
            [
                'id' => 4,
                'lelang_id' => 2,
                'path_foto' => 'foto_lelang/osDzGLBKFmDYMcbLJyC0mrhc0IMLxKvjiLdQQCjt.jpg',
                'urutan' => 0,
                'created_at' => '2026-06-07 09:00:55',
                'updated_at' => '2026-06-07 09:00:55',
            ],
            [
                'id' => 5,
                'lelang_id' => 2,
                'path_foto' => 'foto_lelang/OY4mId0gsirBDmXOIs4dBwsIwk7nb1VUoULb12Am.jpg',
                'urutan' => 1,
                'created_at' => '2026-06-07 09:00:55',
                'updated_at' => '2026-06-07 09:00:55',
            ],
            [
                'id' => 6,
                'lelang_id' => 2,
                'path_foto' => 'foto_lelang/zsOauThx8CvqcU3u90muoDmb4YlvXigl3n4VAZBL.jpg',
                'urutan' => 2,
                'created_at' => '2026-06-07 09:00:55',
                'updated_at' => '2026-06-07 09:00:55',
            ],
            [
                'id' => 7,
                'lelang_id' => 4,
                'path_foto' => 'foto_lelang/KQK3forZUSR2iN8MH7HULT5NlJh4sqhul55cIc6R.jpg',
                'urutan' => 0,
                'created_at' => '2026-06-07 16:32:19',
                'updated_at' => '2026-06-07 16:32:19',
            ],
            [
                'id' => 8,
                'lelang_id' => 4,
                'path_foto' => 'foto_lelang/YbdNWl4NkemVR14IAXLFcJ3PeYom2wZeTpKhtVCg.jpg',
                'urutan' => 1,
                'created_at' => '2026-06-07 16:32:19',
                'updated_at' => '2026-06-07 16:32:19',
            ],
            [
                'id' => 9,
                'lelang_id' => 4,
                'path_foto' => 'foto_lelang/q1aae5SjGle6jBYD4Kzksy5zeRVb5tDvgK3MoAsH.jpg',
                'urutan' => 2,
                'created_at' => '2026-06-07 16:32:19',
                'updated_at' => '2026-06-07 16:32:19',
            ],
        ]);

        DB::table('penawarans')->insert([
            [
                'id' => 1,
                'lelang_id' => 2,
                'pembeli_id' => 2,
                'harga_tawar' => 7000000000.00,
                'created_at' => '2026-06-07 09:03:43',
                'updated_at' => '2026-06-07 09:03:43',
            ],
            [
                'id' => 2,
                'lelang_id' => 4,
                'pembeli_id' => 1,
                'harga_tawar' => 5001000000.00,
                'created_at' => '2026-06-07 16:33:27',
                'updated_at' => '2026-06-07 16:33:27',
            ],
            [
                'id' => 3,
                'lelang_id' => 4,
                'pembeli_id' => 2,
                'harga_tawar' => 5001001000.00,
                'created_at' => '2026-06-07 16:37:19',
                'updated_at' => '2026-06-07 16:37:19',
            ],
            [
                'id' => 4,
                'lelang_id' => 4,
                'pembeli_id' => 1,
                'harga_tawar' => 6000000000.00,
                'created_at' => '2026-06-07 16:40:40',
                'updated_at' => '2026-06-07 16:40:40',
            ],
        ]);

    }
}
