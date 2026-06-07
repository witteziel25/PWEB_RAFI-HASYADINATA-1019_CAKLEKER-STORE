@extends('layouts.V_Layout')
@section('title', 'Buat Akun')
@section('hide_header_footer', true)

@push('styles')
<style>
    /* Global Layout Override for Auth Pages */
    main {
        padding-top: 0 !important;
    }
    .auth-split-container {
        min-height: 100vh;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
    }

    /* Left Side: Creative & Brand */
    .auth-creative-side {
        flex: 1 1 55%;
        background-color: #000000;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
        padding: 2rem;
    }

    .auth-creative-content {
        position: relative;
        z-index: 2;
        max-width: 600px;
        text-align: center;
    }

    .auth-creative-tagline {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.3;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    
    .auth-creative-tagline span {
        color: #e10600;
    }

    /* Ambient Glow on Left Side */
    .creative-glow {
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(225,6,0,0.15) 0%, rgba(0,0,0,0) 70%);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }

    /* Floating Image Collage Mockup */
    .image-collage {
        position: relative;
        width: 100%;
        height: 300px;
        margin-top: 2rem;
    }
    .collage-item {
        position: absolute;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        border: 2px solid rgba(255,255,255,0.1);
        object-fit: cover;
    }
    .collage-1 {
        width: 200px;
        height: 280px;
        left: 50%;
        top: 10px;
        transform: translateX(-50%) rotate(0deg);
        z-index: 3;
    }
    .collage-2 {
        width: 180px;
        height: 240px;
        left: 20%;
        top: 40px;
        transform: rotate(-10deg);
        z-index: 2;
        filter: brightness(0.7);
    }
    .collage-3 {
        width: 180px;
        height: 240px;
        right: 20%;
        top: 30px;
        transform: rotate(8deg);
        z-index: 1;
        filter: brightness(0.6);
    }

    /* Right Side: Form Area */
    .auth-form-side {
        flex: 1 1 45%;
        background-color: var(--light-bg);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 4rem 2rem;
        transition: background-color 0.3s ease;
    }
    
    .auth-form-wrapper {
        width: 100%;
        max-width: 380px;
    }

    .auth-form-wrapper h4 {
        font-weight: 700;
        margin-bottom: 2rem;
    }

    /* Clean Inputs */
    .clean-input-group {
        margin-bottom: 0.8rem;
    }
    
    .clean-input {
        width: 100%;
        background-color: transparent !important;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 0.95rem;
        color: var(--text-dark);
        transition: all 0.2s ease;
    }
    
    .clean-input:focus {
        outline: none;
        border-color: #a8a29e;
        box-shadow: inset 0 0 0 1px #a8a29e;
    }

    .btn-auth-submit {
        background-color: #000000;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 12px;
        font-weight: 600;
        width: 100%;
        margin-top: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-auth-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        background-color: #1a1a1a;
    }

    /* Dark Mode Form Side */
    body.dark-mode .auth-form-side {
        background-color: #121212;
    }
    body.dark-mode .clean-input {
        border-color: #3f3f46;
        color: #f4f4f5;
    }
    body.dark-mode .clean-input:focus {
        border-color: #71717a;
        box-shadow: inset 0 0 0 1px #71717a;
    }
    body.dark-mode .btn-auth-submit {
        background-color: #e10600;
        box-shadow: 0 4px 6px rgba(225, 6, 0, 0.2);
    }
    body.dark-mode .btn-auth-submit:hover {
        background-color: #ff1a1a;
        box-shadow: 0 10px 20px rgba(225, 6, 0, 0.3);
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .auth-creative-side {
            display: none;
        }
        .auth-form-side {
            flex: 1 1 100%;
            padding: 2rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-split-container">
    
    <!-- Left Decorative Side -->
    <div class="auth-creative-side">
        <div class="creative-glow"></div>
        <div class="auth-creative-content">
            <img src="{{ asset('images/cakleker-auction-logo.png') }}" alt="Logo" style="max-width: 180px;">
            <div class="auth-creative-tagline">
                Bergabunglah dengan komunitas <span>kolektor elit</span>.
            </div>
            
            <div class="image-collage">
                <img src="https://images.unsplash.com/photo-1592198084033-aade902d1aae?auto=format&fit=crop&w=400&q=80" alt="Car 3" class="collage-item collage-3">
                <img src="https://images.unsplash.com/photo-1614200187524-dc4b892acf16?auto=format&fit=crop&w=400&q=80" alt="Car 2" class="collage-item collage-2">
                <img src="https://images.unsplash.com/photo-1583121274602-3e2820c69888?auto=format&fit=crop&w=400&q=80" alt="Car 1" class="collage-item collage-1">
            </div>
        </div>
    </div>

    <!-- Right Form Side -->
    <div class="auth-form-side">
        <div class="auth-form-wrapper">
            
            <!-- Mobile Logo -->
            <div class="text-center d-block d-lg-none mb-4">
                <img src="{{ asset('images/cakleker-auction-logo.png') }}" alt="Logo" style="max-width: 150px;" class="mb-3">
            </div>

            <h4 class="text-center text-dark mb-2">Buat Akun Baru</h4>
            <p class="text-center text-muted small mb-4">Lengkapi data diri Anda di bawah ini.</p>

            <form method="POST" action="{{ route('daftar') }}" id="formDaftar">
                @csrf
                <div class="clean-input-group">
                    <input type="text" class="clean-input @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap" required autofocus>
                    @error('nama_lengkap') <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div> @enderror
                </div>

                <div class="clean-input-group">
                    <input type="text" class="clean-input @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Nama Pengguna" required>
                    @error('username') <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div> @enderror
                </div>

                <div class="clean-input-group">
                    <input type="email" class="clean-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Alamat Email" required>
                    @error('email') <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div> @enderror
                </div>

                <div class="clean-input-group position-relative">
                    <input type="password" class="clean-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kata Sandi" required>
                    <button type="button" class="btn btn-link text-muted toggle-password" data-target="password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); text-decoration: none;">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                    @error('password') <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div> @enderror
                </div>

                <div class="clean-input-group position-relative mb-4">
                    <input type="password" class="clean-input" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                    <button type="button" class="btn btn-link text-muted toggle-password" data-target="password_confirmation" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); text-decoration: none;">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>

                <button type="submit" class="btn-auth-submit">Daftar Akun</button>
            </form>

            <div class="text-center mt-4">
                <span class="text-secondary small d-block mb-3">Punya akun? <a href="{{ route('masuk') }}" class="text-decoration-none fw-bold text-danger ms-1">Masuk Sesi</a></span>
                <a href="{{ url('/') }}" class="text-decoration-none fw-semibold text-secondary small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Landing Page</a>
            </div>
            
            <div class="text-center mt-4 pt-3 border-top border-light-subtle">
                <small class="text-muted fw-medium" style="font-size: 0.75rem;">&copy; {{ date('Y') }} Cakleker Auction.</small>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        document.getElementById('formDaftar')?.addEventListener('submit', function(e) {
            let pass = document.getElementById('password').value;
            let confirm = document.getElementById('password_confirmation').value;
            if (pass !== confirm) {
                e.preventDefault();
                alert('Konfirmasi kata sandi tidak cocok!');
            }
        });
    });
</script>
@endpush
@endsection
