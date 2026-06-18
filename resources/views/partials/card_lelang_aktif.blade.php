@forelse($lelangs as $lelang)
<div class="lelang-card-item" style="display: {{ $loop->iteration > 5 ? 'none' : 'block' }};">
<div class="card mb-4 shadow-sm border-danger" style="border-radius: 1.25rem;">
    <div class="card-body p-4">
        {{-- Judul dan Status --}}
        <div class="d-flex justify-content-between align-items-start mb-1">
            <h4 class="card-title fw-bold mb-0 text-dark">{{ $lelang->judul }}</h4>
            <span class="badge bg-success shadow-sm">Aktif</span>
        </div>
        
        {{-- Username Penjual --}}
        <p class="text-muted small mb-3 d-flex align-items-center gap-1">
            @if($lelang->penjual->foto_profil)
                <img src="{{ Storage::url($lelang->penjual->foto_profil) }}" alt="Profil" class="rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
            @else
                <i class="bi bi-person-circle"></i>
            @endif
            Penjual: <span class="fw-bold">{{ $lelang->penjual->username }}</span>
        </p>

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
            <button class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center rounded-3 p-3 mb-2 border shadow-sm dropdown-desc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#descAktif{{ $lelang->id }}" aria-expanded="false" aria-controls="descAktif{{ $lelang->id }}">
                <span class="fw-semibold text-dark"><i class="bi bi-file-earmark-text text-danger me-2"></i>Deskripsi Mobil</span>
                <i class="bi bi-chevron-down text-muted"></i>
            </button>
            <div class="collapse" id="descAktif{{ $lelang->id }}">
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
                    <span class="text-muted d-block small">Tertinggi Saat Ini</span>
                    <span class="fw-bold text-danger">Rp {{ number_format($lelang->hargaTertinggi(), 0, ',', '.') }}</span>
                    <small class="text-muted d-block" style="font-size:0.75rem;">Oleh: <span class="text-dark fw-bold">{{ $lelang->pemenang() ? $lelang->pemenang()->username : '-' }}</span></small>
                </div>
                <div class="col-md-2 col-6 mt-3 mt-md-0">
                    <span class="text-muted d-block small">Total Tawaran</span>
                    <span class="badge bg-secondary rounded-pill">{{ $lelang->jumlahBid() }} Bid</span>
                </div>
                <div class="col-md-3 col-6 text-md-center mt-3 mt-md-0">
                    <span class="text-muted d-block small">Waktu Pelaksanaan</span>
                    <span class="small fw-medium text-dark">{{ \Carbon\Carbon::parse($lelang->waktu_mulai)->translatedFormat('d M Y, H:i') }} WIB - {{ \Carbon\Carbon::parse($lelang->waktu_berakhir)->translatedFormat('d M Y, H:i') }} WIB</span>
                </div>
                <div class="col-md-2 col-12 text-md-end mt-3 mt-md-0">
                    @if(Auth::id() == $lelang->penjual_id)
                        <button class="btn btn-secondary btn-sm rounded-pill w-100 fw-bold shadow-sm" disabled>Milik Anda</button>
                    @else
                        <button class="btn btn-danger btn-sm rounded-pill w-100 btn-ikuti fw-bold shadow-sm" data-lelang-id="{{ $lelang->id }}">Ikuti</button>
                    @endif
                </div>
            </div>
        </div>

        {{-- Form ikut lelang (AJAX) Hidden by default --}}
        <div id="formPenawaran{{ $lelang->id }}" style="display: none;" class="mt-3 bg-light p-3 rounded-4 border">
            <form class="form-penawaran" data-lelang-id="{{ $lelang->id }}">
                @csrf
                <label class="form-label small fw-bold text-dark">Buat Penawaran Lebih Tinggi</label>
                <div class="d-flex align-items-center gap-2">
                    <div class="input-group custom-input-group shadow-sm flex-grow-1">
                        <span class="input-group-text fw-bold">Rp</span>
                        <input type="text" class="form-control format-rupiah" placeholder="Nominal tawaran..." required>
                        <input type="hidden" name="harga_tawar" min="{{ $lelang->hargaTertinggi() > 0 ? $lelang->hargaTertinggi() + 1 : $lelang->harga_awal + 1 }}">
                    </div>
                    <button type="submit" class="btn btn-danger px-4 fw-bold rounded-3 shadow-sm">Kirim</button>
                </div>
                <div class="invalid-feedback" style="display: none;">Nominal harus lebih tinggi dari harga tertinggi saat ini.</div>
            </form>
        </div>
    </div>
</div>
</div>
@empty
<div class="alert alert-info">Belum ada lelang umum aktif saat ini.</div>
@endforelse

@if($lelangs->count() > 5)
<div class="text-center mt-4 mb-4 wrapper-load-more">
    <button type="button" class="btn btn-outline-danger px-5 rounded-pill fw-bold btn-load-more shadow-sm">Muat lebih banyak</button>
</div>
@endif

