<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cakleker Auction - @yield('title')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Cakleker" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar hanya untuk user yang sudah login --}}
    @auth
    <nav class="navbar navbar-expand-lg sticky-top glass-navbar shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('lelang.umum') }}">
                <img src="{{ asset('images/cakleker-auction-logo.png') }}" alt="Logo" height="45">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto gap-1 ps-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('lelang.umum') ? 'active-menu' : '' }}" href="{{ route('lelang.umum') }}">
                            Lelang Umum
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('lelang.pribadi') || Request::routeIs('lelang.buat') ? 'active-menu' : '' }}" href="{{ route('lelang.pribadi') }}">
                            Lelang Saya
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3 ms-auto mt-3 mt-lg-0">
                    <button id="darkModeToggle" class="btn btn-link text-dark p-2 fs-5 text-decoration-none" title="Ubah Tema">
                        <i class="bi bi-moon-stars-fill" id="darkModeIcon"></i>
                    </button>

                    <div class="dropdown">
                        <a class="btn btn-outline-dark dropdown-toggle rounded-pill px-3 fw-semibold d-flex align-items-center gap-2" href="#" role="button" id="dropdownAkun" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-5"></i>
                            <span>{{ Auth::user()->nama_lengkap ?? Auth::user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-3 mt-2" aria-labelledby="dropdownAkun">
                            <li>
                                <div class="dropdown-header text-muted small">
                                    Masuk sebagai: <br>
                                    <strong class="text-dark d-block text-truncate">{{ Auth::user()->email }}</strong>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider opacity-50"></li>

                            <li>
                                <a class="dropdown-item fw-medium d-flex align-items-center gap-2 py-2 {{ Request::routeIs('akun') ? 'active text-white' : '' }}" href="{{ route('akun') }}">
                                    <i class="bi bi-person-gear fs-5 text-secondary"></i> Akun Saya
                                </a>
                            </li>

                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li>
                                <form method="POST" action="{{ route('keluar') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger fw-bold d-flex align-items-center gap-2 py-2">
                                        <i class="bi bi-box-arrow-right fs-5"></i> Keluar Aplikasi
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    @endauth

    {{-- Main Content --}}
    <main class="flex-grow-1 @auth pt-5 @else pt-0 @endauth">
        @yield('content')
    </main>

    {{-- Footer Terkunci Hitam Pekat Konsisten --}}
    @auth
    <footer class="footer mt-auto py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <img src="{{ asset('images/cakleker-auction-logo.png') }}" alt="Logo" height="40" class="mb-3 footer-logo">
                    <p class="text-footer-muted small">Sistem pelelangan daring khusus koleksi Ferrari. Temukan mobil impian Anda.</p>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-footer-white fw-bold uppercase tracking-wider mb-3">Alamat</h6>
                    <p class="text-footer-muted small mb-1"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Jl. Gajah Mada Gang 18 Nomor 16 Kaliwates</p>
                    <p class="text-footer-muted small ps-4">Jember, Jawa Timur, Indonesia</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="text-footer-white fw-bold uppercase tracking-wider mb-3">Kontak</h6>
                    <p class="text-footer-muted small mb-1"><i class="bi bi-envelope-fill text-danger me-2"></i>Email: info@cakleker.com</p>
                    <p class="text-footer-muted small"><i class="bi bi-telephone-fill text-danger me-2"></i>Tel: +62 21 12345678</p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="text-footer-white fw-bold uppercase tracking-wider mb-3">Status Jaringan</h6>
                    @php
                        $onlineUsersCount = \Illuminate\Support\Facades\DB::table('sessions')
                            ->whereNotNull('user_id')
                            ->where('last_activity', '>=', time() - 300) // 5 minutes
                            ->distinct('user_id')
                            ->count('user_id');
                    @endphp
                    <div class="d-flex align-items-center gap-2">
                        <span class="position-relative d-flex" style="width: 10px; height: 10px;">
                          <span class="position-absolute w-100 h-100 rounded-circle bg-success opacity-75" style="animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;"></span>
                          <span class="position-relative rounded-circle w-100 h-100 bg-success"></span>
                        </span>
                        <p class="text-footer-muted small mb-0"><span id="onlineCounter" class="fw-bold text-white">{{ $onlineUsersCount }}</span> User Aktif</p>
                    </div>
                </div>
            </div>
            <div class="text-center pt-4 mt-4 border-top border-secondary border-opacity-25">
                <small class="text-footer-muted">&copy; {{ date('Y') }} Cakleker Auction. All rights reserved.</small>
            </div>
        </div>
    </footer>
    @endauth

    {{-- Global Image Lightbox Modal --}}
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0 pb-0 justify-content-end">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="" id="modalImageSource" class="img-fluid rounded shadow-lg" style="max-height: 80vh;" alt="Preview Foto">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script Fungsionalitas Operasional Tema Dark Mode & Image Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('darkModeToggle');
            const toggleIcon = document.getElementById('darkModeIcon');

            if (toggleBtn) {
                // Cek status penyimpanan tema di local storage browser
                if (localStorage.getItem('theme') === 'dark') {
                    document.body.classList.add('dark-mode');
                    toggleIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
                }

                toggleBtn.addEventListener('click', function() {
                    document.body.classList.toggle('dark-mode');
                    if (document.body.classList.contains('dark-mode')) {
                        localStorage.setItem('theme', 'dark');
                        toggleIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
                    } else {
                        localStorage.setItem('theme', 'light');
                        toggleIcon.classList.replace('bi-sun-fill', 'bi-moon-stars-fill');
                    }
                });
            }


        });

        // Fungsi Global untuk Image Modal
        function showImageModal(imageSrc) {
            document.getElementById('modalImageSource').src = imageSrc;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }

        // Fungsi Global Muat Lebih Banyak (Load More)
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-load-more')) {
                const wrapper = e.target.closest('.wrapper-load-more');
                const parentList = wrapper.parentElement;
                const hiddenCards = parentList.querySelectorAll('.lelang-card-item[style*="display: none"]');
                
                for (let i = 0; i < 5 && i < hiddenCards.length; i++) {
                    hiddenCards[i].style.display = 'block';
                }
                
                // Sembunyikan tombol jika tidak ada lagi card yang disembunyikan
                const remainingHidden = parentList.querySelectorAll('.lelang-card-item[style*="display: none"]');
                if (remainingHidden.length === 0) {
                    wrapper.style.display = 'none';
                }
            }
        });
    </script>
    <style>
        @keyframes ping {
            0% { transform: scale(1); opacity: 0.8; }
            75%, 100% { transform: scale(2.5); opacity: 0; }
        }
    </style>
    @stack('scripts')
</body>
</html>
