@extends('layouts.V_Layout')
@section('title', 'Verifikasi Kode OTP')

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
        margin-bottom: 1rem;
    }
    
    .clean-input {
        width: 100%;
        background-color: transparent !important;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 14px 16px;
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
                Keamanan Anda adalah <span>prioritas</span> kami.
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

            <div class="text-center mb-4">
                <div class="bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center rounded-circle mb-3 text-success" style="width: 70px; height: 70px;">
                    <i class="bi bi-shield-check fs-1"></i>
                </div>
                <h4 class="text-dark mb-2">Verifikasi OTP</h4>
                <p class="text-muted small">Masukkan kode OTP 6 digit yang telah kami kirimkan ke email Anda untuk melanjutkan.</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success border-0 small rounded-1 py-2 mb-3">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            </div>
            @endif

            <form method="POST" action="{{ route('verifikasi.otp') }}">
                @csrf
                <div class="clean-input-group">
                    <input type="text" class="clean-input text-center fw-bolder @error('otp') is-invalid @enderror" id="otp" name="otp" placeholder="••••••" style="letter-spacing: 8px; font-size: 1.25rem;" required autofocus>
                    @error('otp') <div class="invalid-feedback d-block mt-1 small text-center">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn-auth-submit mt-3">Verifikasi Kode</button>
            </form>

            <div class="text-center mt-5">
                <a href="{{ route('lupa.password') }}" class="text-decoration-none fw-semibold text-secondary small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Permintaan OTP</a>
            </div>
            
            <div class="text-center mt-4 pt-3 border-top border-light-subtle">
                <small class="text-muted fw-medium" style="font-size: 0.75rem;">&copy; {{ date('Y') }} Cakleker Auction.</small>
            </div>
        </div>
    </div>

</div>
@endsection
