# Fix Error 500 — Sessions Table

## Masalah
Semua halaman (akun, lelang-umum, lelang-pribadi, dll) menampilkan **Error 500** setelah login.

## Penyebab
Layout website (`V_Layout.blade.php`) query tabel `sessions` untuk fitur "online users". Tapi tabel `sessions` belum ada di database, sehingga Laravel crash.

Error di log:
```
Table 'cakleker_store.sessions' doesn't exist
```

## Fix

### 1. Buat migration file
Jalankan command ini di terminal project lokal:
```bash
php artisan session:table
```

Ini akan membuat file migration baru di `database/migrations/xxxx_xx_xx_xxxxxx_create_sessions_table.php`

### 2. Isi migration file (kalau command di atas tidak jalan)
Buat file manual di `database/migrations/2026_06_18_000000_create_sessions_table.php`:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
```

### 3. Commit & push
```bash
git add database/migrations/*_create_sessions_table.php
git commit -m "feat: add sessions table migration for online users feature"
git push
```

### 4. Deploy
Push ke GitHub akan otomatis trigger deploy (kalau webhook sudah di-setup), atau deploy manual via Coolify.

## Catatan
- Migration ini dijalankan otomatis saat deploy (`php artisan migrate --force`)
- Tabel `sessions` dipakai Laravel untuk menyimpan data session user + fitur "online users" di layout
- Tanpa tabel ini, semua halaman yang pakai layout akan error 500
