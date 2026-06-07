@extends('layouts.V_Layout')
@section('title', 'Selamat Datang')

@push('styles')
<style>
    /* Split Screen Layout */
    .landing-split-container {
        display: flex;
        flex-wrap: wrap;
        height: 100vh;
        width: 100%;
        overflow: hidden;
    }
    .landing-content-side {
        flex: 1 1 45%;
        padding: 4rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #f8fafc;
    }
    @media (min-width: 992px) {
        .landing-content-side {
            padding: 5rem 5rem;
        }
    }
    .landing-image-side {
        flex: 1 1 55%;
        background: url('{{ asset('images/ferrari-scenic.png') }}') center/cover no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .landing-image-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.6) 100%);
        z-index: 1;
    }

    /* Typography Overrides */
    .landing-title {
        font-size: 3.5rem;
        font-weight: 900;
        letter-spacing: -1px;
        color: #0f172a;
        line-height: 1.15;
    }
    .landing-subtitle {
        color: #e10600;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
    .landing-desc {
        color: #475569;
        font-size: 1.15rem;
        line-height: 1.6;
        max-width: 500px;
    }

    /* Buttons */
    .btn-landing-primary {
        background-color: #e10600;
        color: #fff;
        border-radius: 50px;
        padding: 14px 36px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        box-shadow: 0 4px 6px rgba(225, 6, 0, 0.2);
    }
    .btn-landing-primary:hover {
        background-color: #c90500;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(225, 6, 0, 0.3);
        color: #fff;
    }
    .btn-landing-outline {
        background-color: #ffffff;
        color: #0f172a;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        padding: 12px 36px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-landing-outline:hover {
        border-color: #cbd5e1;
        background-color: #f1f5f9;
        transform: translateY(-3px);
        color: #0f172a;
    }

    /* Floating Environment (Right Side) */
    .bubble-container {
        position: relative;
        height: 100%;
        width: 100%;
        perspective: 1000px;
        z-index: 2;
    }

    .chat-bubble {
        position: absolute;
        padding: 18px 24px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.95rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        animation: floatBubble 6s ease-in-out infinite;
        backdrop-filter: blur(10px);
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.05);
        z-index: 5;
    }

    /* Variasi Bubble */
    .bubble-1 {
        top: 25%;
        left: 15%;
        animation-delay: 0s;
        transform: rotate(-3deg);
    }
    .bubble-1 .icon-box {
        background-color: rgba(225, 6, 0, 0.1);
        color: #e10600;
    }
    
    .bubble-2 {
        top: 45%;
        right: 10%;
        animation-delay: 1.5s;
        transform: rotate(2deg);
        z-index: 2;
    }
    .bubble-2 .highlight { color: #059669; } /* Hijau untuk penawaran */

    .bubble-3 {
        bottom: 15%;
        left: 20%;
        animation-delay: 3s;
        transform: rotate(-1deg);
        border-bottom-left-radius: 4px;
    }

    .bubble-4 {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        color: #fff;
        top: 10%;
        right: 20%;
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 0.85rem;
        animation-delay: 2s;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.2);
    }

    @keyframes floatBubble {
        0% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-15px) scale(1.02); }
        100% { transform: translateY(0px) scale(1); }
    }

</style>
@endpush

@section('content')
<div class="landing-split-container">
    
    <!-- Left Side: Copywriting -->
    <div class="landing-content-side">
        <div class="mx-auto mx-lg-0" style="max-width: 500px;">
            <img src="{{ asset('images/cakleker-auction-logo.png') }}" alt="Cakleker Logo" class="mb-4" style="max-height: 45px;">

            <div class="landing-subtitle">
                Platform Lelang Ferrari No. 1 di Indonesia
            </div>
            <h1 class="landing-title mb-4">Pelelangan Paling Update, Mudah, & Transparan.</h1>
            <p class="landing-desc mb-5">
                Sistem pelelangan digital terpercaya untuk mobil eksklusif Ferrari di Indonesia. Kami menjamin kemudahan penawaran, keamanan data, dan informasi lengkap setiap instrumen yang ditawarkan.
            </p>
            <div class="d-flex flex-column flex-sm-row gap-3">
                <a href="{{ route('masuk') }}" class="btn btn-landing-primary text-decoration-none text-center">
                    Masuk
                </a>
                <a href="{{ route('daftar') }}" class="btn btn-landing-outline text-decoration-none text-center">
                    Daftar
                </a>
            </div>
            
            <div class="mt-5 pt-4 border-top border-secondary border-opacity-10 d-flex align-items-center gap-4">
                <div>
                    <div class="text-dark fw-bolder fs-3">50+</div>
                    <div class="text-secondary small fw-medium">Pelelangan Sukses</div>
                </div>
                <div class="border-start border-secondary border-opacity-25 ps-4">
                    <div class="text-dark fw-bolder fs-3">24/7</div>
                    <div class="text-secondary small fw-medium">Pemantauan Sistem</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side: Background Image & Bubble Art -->
    <div class="landing-image-side d-none d-lg-flex">
        <div class="landing-image-overlay"></div>
        <div class="bubble-container">
            
            <div class="chat-bubble bubble-4">
                <i class="bi bi-clock-history me-2"></i> Sesi Penawaran Berakhir: 14:59:00
            </div>

            <div class="chat-bubble bubble-1">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-award-fill fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-medium">Kategori: Kendaraan Premium</div>
                        <div class="fs-6 fw-bold text-dark">Ferrari 849 Testarossa</div>
                    </div>
                </div>
            </div>

            <div class="chat-bubble bubble-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center text-secondary" style="width: 45px; height: 45px;">
                        <i class="bi bi-person-fill fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-medium">Penawar XXXXX mengirim bid</div>
                        <div class="fs-5 fw-bold highlight">Rp 8.500.000.000</div>
                    </div>
                </div>
            </div>

            <div class="chat-bubble bubble-3">
                <div class="d-flex gap-3 align-items-start">
                    <div class="text-success mt-1"><i class="bi bi-patch-check-fill fs-4"></i></div>
                    <div>
                        <div class="fw-bold text-dark">Platform Terpercaya</div>
                        <div class="small fw-medium mt-1 text-muted" style="max-width: 240px;">Telah dipercaya oleh berbagai komunitas Ferrari di penjuru Indonesia.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
