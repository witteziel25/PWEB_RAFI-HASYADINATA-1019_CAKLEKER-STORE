# Fix HTTPS di Cakleker Auction

## Masalah
Setelah deploy ke server, beberapa link di website masih menggunakan `http://` padahal website sudah pakai `https://`. Ini menyebabkan:
- Browser menampilkan "Not Secure"
- Form action menggunakan `http://` (tidak aman)
- Mixed content warning di browser

## Penyebab
Website di-deploy di belakang **reverse proxy** (Traefik). Laravel tidak otomatis tahu bahwa request dari user itu HTTPS, karena yang sampai ke Laravel adalah request HTTP dari proxy.

## Fix
Edit file `app/Providers/AppServiceProvider.php`:

### Sebelum:
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}
```

### Sesudah:
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
```

### Yang ditambahkan:
1. Tambah `use Illuminate\Support\Facades\URL;` di bagian import
2. Tambah `URL::forceScheme('https');` di dalam method `boot()`

## Cara Apply
1. Edit file `app/Providers/AppServiceProvider.php` sesuai contoh di atas
2. Commit dan push ke GitHub
3. Deploy ulang (otomatis atau manual via Coolify)

## Catatan
- Fix ini hanya aktif di `production` (tidak mengganggu development lokal)
- Tanpa commit ini, fix hanya sementara dan hilang setiap deploy
