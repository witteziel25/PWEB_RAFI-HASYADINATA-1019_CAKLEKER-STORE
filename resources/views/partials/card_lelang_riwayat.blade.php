{{-- resources/views/partials/card_lelang_riwayat.blade.php --}}
@forelse($lelangs as $lelang)
@php
    $pemenang = $lelang->pemenang();
    $userLogin = Auth::user();
    $isMenang = ($pemenang && $pemenang->id == $userLogin->id);
@endphp
<div class="lelang-card-item" style="display: {{ $loop->iteration > 5 ? 'none' : 'block' }};">
<div class="card mb-4 shadow-sm border-0" style="border-radius: 1.25rem;">
    <div class="card-body p-4">
        {{-- Judul dan Status --}}
        <div class="d-flex justify-content-between align-items-start mb-1">
            <h4 class="card-title fw-bold mb-0 text-dark">{{ $lelang->judul }}</h4>
            <div>
                <span class="badge bg-secondary shadow-sm me-1">Selesai</span>
                @if($isMenang)
                    <span class="badge bg-info shadow-sm">Dimenangkan</span>
                @else
                    <span class="badge bg-warning text-dark shadow-sm">Tidak Dimenangkan</span>
                @endif
            </div>
        </div>
        
        {{-- Username Penjual --}}
        <p class="text-muted small mb-3"><i class="bi bi-person-circle me-1"></i> Penjual: <span class="fw-bold">{{ $lelang->penjual->username }}</span></p>

        {{-- Grid Foto --}}
        <div class="row g-2 mb-3">
            @forelse($lelang->foto->take(4) as $foto)
                <div class="col-3 col-md-2">
                    <img src="{{ Storage::url($foto->path_foto) }}" class="img-fluid rounded shadow-sm img-thumbnail-clickable" style="height: 80px; width:100%; object-fit: cover; cursor: pointer;" onclick="showImageModal('{{ Storage::url($foto->path_foto) }}')" alt="Foto Lelang">
                </div>
            @empty
                <div class="col-12">
                    <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="height: 80px;">
                        <span class="text-secondary small">Tidak ada foto</span>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Deskripsi (Collapsible) --}}
        <div class="mb-4">
            <button class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center rounded-3 p-3 mb-2 border shadow-sm dropdown-desc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#descRiwayat{{ $lelang->id }}" aria-expanded="false" aria-controls="descRiwayat{{ $lelang->id }}">
                <span class="fw-semibold text-dark"><i class="bi bi-file-earmark-text text-danger me-2"></i>Deskripsi Mobil</span>
                <i class="bi bi-chevron-down text-muted"></i>
            </button>
            <div class="collapse" id="descRiwayat{{ $lelang->id }}">
                <div class="card card-body bg-light border-0 ck-content-render shadow-inner-custom p-4" style="max-height: 400px; overflow-y: auto; font-size: 0.95rem;">
                    {!! $lelang->deskripsi !!}
                </div>
            </div>
        </div>

        {{-- Metadata dan Aksi --}}
        <div class="border-top pt-3 mt-2">
            <div class="row g-3 align-items-center">
                <div class="col-md-2 col-6">
                    <span class="text-muted d-block small">Harga Awal</span>
                    <span class="fw-bold text-dark">Rp {{ number_format($lelang->harga_awal, 0, ',', '.') }}</span>
                </div>
                <div class="col-md-3 col-6">
                    <span class="text-muted d-block small">Harga Final</span>
                    <span class="fw-bold text-success">Rp {{ number_format($lelang->hargaTertinggi(), 0, ',', '.') }}</span>
                    <small class="text-muted d-block" style="font-size:0.75rem;">Pemenang: <span class="text-dark fw-bold">{{ $pemenang ? $pemenang->username : '-' }}</span></small>
                </div>
                <div class="col-md-2 col-6 mt-3 mt-md-0">
                    <span class="text-muted d-block small">Total Tawaran</span>
                    <span class="badge bg-secondary rounded-pill">{{ $lelang->jumlahBid() }} Bid</span>
                </div>
                <div class="col-md-5 col-6 text-md-end mt-3 mt-md-0">
                    <span class="text-muted d-block small">Waktu Pelaksanaan</span>
                    <span class="small fw-medium text-dark">{{ \Carbon\Carbon::parse($lelang->waktu_mulai)->translatedFormat('d M Y, H:i') }} - {{ \Carbon\Carbon::parse($lelang->waktu_berakhir)->translatedFormat('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- Tampilkan email penjual dan titik pertemuan hanya jika user menang --}}
        @if($isMenang)
            <div class="alert alert-success mt-4 border-0 shadow-sm rounded-4 mb-0">
                <h6 class="fw-bold mb-3"><i class="bi bi-check-circle-fill me-1"></i> Selamat! Anda memenangkan lelang ini.</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="small mb-2">
                            <strong>Kontak Penjual:</strong><br>
                            <a href="mailto:{{ $lelang->penjual->email }}" class="text-decoration-none">{{ $lelang->penjual->email }}</a>
                        </div>
                        <div class="small">
                            <strong>Titik Pertemuan (COD):</strong><br>
                            {{ $lelang->titik_pertemuan }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <iframe width="100%" height="150" class="rounded border shadow-sm" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ urlencode($lelang->titik_pertemuan) }}&output=embed"></iframe>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
</div>
@empty
<div class="alert alert-secondary">Belum ada riwayat lelang yang Anda ikuti.</div>
@endforelse

@if($lelangs->count() > 5)
<div class="text-center mt-4 mb-4 wrapper-load-more">
    <button type="button" class="btn btn-outline-danger px-5 rounded-pill fw-bold btn-load-more shadow-sm">Muat lebih banyak</button>
</div>
@endif
