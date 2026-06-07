@extends('layouts.V_Layout')

@section('title', 'Akun Saya')

@push('styles')
<style>
    .profile-banner {
        height: 140px;
        background: linear-gradient(135deg, #e10600 0%, #ff4b4b 100%);
        border-radius: 1rem 1rem 0 0;
    }
    .profile-avatar {
        width: 140px;
        height: 140px;
        border: 4px solid #ffffff;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        margin-top: -70px;
        position: relative;
        z-index: 10;
        background-color: #fff;
    }
    .detail-item {
        transition: all 0.2s ease;
    }
    .detail-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        background-color: #ffffff !important;
        border-color: #fca5a5 !important;
    }
    .input-group-text {
        transition: all 0.2s ease;
    }
    .form-control:focus + .input-group-text,
    .input-group:focus-within .input-group-text {
        color: #e10600 !important;
    }
    .form-control:focus {
        border-color: #e10600;
        box-shadow: none;
    }
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(225, 6, 0, 0.15);
        border-radius: 0.375rem;
    }
</style>
@endpush

@section('content')
<div class="container pt-4 pb-5">
    <div class="row g-4 justify-content-center">

        <!-- Kiri: Profil Singkat -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 text-center h-100 position-relative">
                <div class="profile-banner w-100"></div>

                <div class="card-body px-4 pb-4 pt-0">
                    <div class="d-flex justify-content-center">
                        @if($user->foto_profil)
                            <img src="{{ Storage::url($user->foto_profil) }}" class="rounded-circle profile-avatar object-fit-cover" alt="Foto Profil">
                        @else
                            <img src="https://ui-avatars.com/api/?background=e10600&color=fff&name={{ urlencode($user->nama_lengkap) }}&size=140" class="rounded-circle profile-avatar" alt="Avatar Bawaan">
                        @endif
                    </div>

                    <h4 class="fw-bold text-dark mt-3 mb-1">{{ $user->nama_lengkap }}</h4>
                    <p class="text-secondary mb-3"><span>@</span>{{ $user->username }}</p>
                    
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold mb-4 border border-success border-opacity-25">
                        <i class="bi bi-patch-check-fill me-1"></i> Anggota Terverifikasi
                    </span>

                    <div class="d-grid gap-3 mt-2" id="profileActions">
                        <button id="btnUbah" class="btn btn-danger py-2.5 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="transition: transform 0.2s;">
                            <i class="bi bi-pencil-square"></i> Ubah Data Profil
                        </button>

                        <form id="logoutForm" action="{{ route('keluar') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" id="btnKeluar" class="btn btn-light w-100 py-2.5 rounded-pill fw-semibold text-danger border d-flex align-items-center justify-content-center gap-2 hover-bg-danger" style="transition: all 0.2s;">
                                <i class="bi bi-box-arrow-right"></i> Keluar Aplikasi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Detail & Edit Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 p-md-5">

                    {{-- ==========================================================================
                       MODE LIHAT (VIEW MODE WITH CLEAN GRID)
                       ========================================================================== --}}
                    <div id="viewMode" class="fade show">
                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                            <div class="text-danger">
                                <i class="bi bi-person-lines-fill fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0 tracking-tight">Detail Informasi Akun</h4>
                                <p class="text-muted small mb-0">Informasi pribadi dan kontak yang terdaftar di sistem.</p>
                            </div>
                        </div>

                        <div class="row g-4 mt-2">
                            <div class="col-sm-6">
                                <div class="detail-item p-4 bg-light rounded-4 border border-light-subtle h-100">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="text-danger"><i class="bi bi-person-badge fs-3"></i></div>
                                        <div class="text-secondary small fw-medium text-uppercase tracking-wider">Nama Lengkap</div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-0">{{ $user->nama_lengkap }}</h5>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="detail-item p-4 bg-light rounded-4 border border-light-subtle h-100">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="text-danger"><i class="bi bi-at fs-3"></i></div>
                                        <div class="text-secondary small fw-medium text-uppercase tracking-wider">Nama Pengguna</div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-0">{{ $user->username }}</h5>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="detail-item p-4 bg-light rounded-4 border border-light-subtle">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="text-danger"><i class="bi bi-envelope-at fs-3"></i></div>
                                        <div class="text-secondary small fw-medium text-uppercase tracking-wider">Alamat Email Resmi</div>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-0">{{ $user->email }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ==========================================================================
                       MODE EDIT (EDIT MODE WITH VALIDATION LAYOUT)
                       ========================================================================== --}}
                    <div id="editMode" style="display: none;">
                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                            <div class="text-primary">
                                <i class="bi bi-pencil-square fs-3"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark mb-0 tracking-tight">Perbarui Informasi Akun</h4>
                                <p class="text-muted small mb-0">Pastikan data yang Anda masukkan valid dan terkini.</p>
                            </div>
                        </div>

                        <form id="formUbahAkun" action="{{ route('akun.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <!-- Foto Profil -->
                                <div class="col-12">
                                    <label class="form-label text-dark fw-bold small mb-2">Unggah Foto Profil Baru <span class="text-muted fw-normal">(Opsional)</span></label>
                                    <div class="input-group">
                                        <input type="file" class="form-control bg-light" name="foto_profil" accept="image/*" id="inputFoto">
                                        <label class="input-group-text bg-white text-secondary" for="inputFoto"><i class="bi bi-image"></i></label>
                                    </div>
                                    <div class="form-text text-muted small mt-2"><i class="bi bi-info-circle me-1"></i> Ekstensi gambar didukung: JPG, JPEG, atau PNG (Maks. 2MB).</div>
                                </div>

                                <!-- Nama & Username -->
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold small mb-2">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control border-start-0 fw-medium ps-0" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required placeholder="Masukkan nama lengkap">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold small mb-2">Nama Pengguna</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-at"></i></span>
                                        <input type="text" class="form-control border-start-0 fw-medium ps-0" name="username" value="{{ old('username', $user->username) }}" required placeholder="Ketik username baru">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <label class="form-label text-dark fw-bold small mb-2">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control border-start-0 fw-medium ps-0" name="email" value="{{ old('email', $user->email) }}" required placeholder="contoh@email.com">
                                    </div>
                                </div>

                                <!-- Divider Password -->
                                <div class="col-12 mt-4">
                                    <div class="p-3 bg-light rounded-4 border border-light-subtle d-flex gap-3 align-items-center">
                                        <div class="text-warning fs-3"><i class="bi bi-shield-lock-fill"></i></div>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">Pengaturan Kata Sandi</div>
                                            <div class="text-secondary small">Kosongkan kolom di bawah ini apabila Anda tidak berencana mengganti kata sandi.</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Baru -->
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold small mb-2">Kata Sandi Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-key"></i></span>
                                        <input type="password" class="form-control border-start-0 ps-0 border-end-0" id="password" name="password" placeholder="••••••••">
                                        <button class="btn btn-outline-secondary toggle-password bg-white border-start-0 text-muted border" type="button" data-target="password" style="border-color: #dee2e6 !important;">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold small mb-2">Konfirmasi Kata Sandi Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-key-fill"></i></span>
                                        <input type="password" class="form-control border-start-0 ps-0 border-end-0" id="password_confirmation" name="password_confirmation" placeholder="••••••••">
                                        <button class="btn btn-outline-secondary toggle-password bg-white border-start-0 text-muted border" type="button" data-target="password_confirmation" style="border-color: #dee2e6 !important;">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                    <button type="button" id="btnBatal" class="btn btn-light px-4 py-2 rounded-pill fw-bold text-secondary border border-secondary-subtle transition-all">
                                        <i class="bi bi-x-circle me-1"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-bold shadow-sm transition-all">
                                        <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const viewMode = document.getElementById('viewMode');
        const editMode = document.getElementById('editMode');
        const btnUbah = document.getElementById('btnUbah');
        const btnBatal = document.getElementById('btnBatal');
        const btnKeluar = document.getElementById('btnKeluar');

        // Navigasi Masuk ke Mode Edit Akun
        btnUbah.addEventListener('click', () => {
            viewMode.style.display = 'none';
            editMode.style.display = 'block';

            // Tambahkan animasi fade-in Bootstrap secara dinamis
            editMode.classList.add('fade', 'show');
            btnUbah.disabled = true;
            if(btnKeluar) btnKeluar.disabled = true;
        });

        // Batalkan Pengeditan dan Kembali ke Tampilan Utama
        btnBatal.addEventListener('click', () => {
            viewMode.style.display = 'block';
            editMode.style.display = 'none';
            editMode.classList.remove('fade', 'show');

            btnUbah.disabled = false;
            if(btnKeluar) btnKeluar.disabled = false;

            // Reset Form ke keadaan data asli bawaan
            document.getElementById('formUbahAkun').reset();
        });

        // Interseptor Konfirmasi Keluar Akun Aplikasi
        document.getElementById('logoutForm').addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin keluar dari sesi akun Cakleker Auction saat ini?')) {
                e.preventDefault();
            }
        });

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                if (input) {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    const icon = this.querySelector('i');
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                }
            });
        });
    });
</script>
@endpush
@endsection
