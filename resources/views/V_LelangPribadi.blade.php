@extends('layouts.V_Layout')
@section('title', 'Manajemen Lelang Saya')
@section('content')
<div class="container py-4">
    <!-- Top Action Panel -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-5 mt-2">
        <div class="btn-group custom-switch-group bg-light p-1 rounded-pill shadow-sm">
            <button class="btn btn-danger active switch-btn shadow-sm" data-tipe="aktif">Aktif</button>
            <button class="btn btn-light switch-btn text-dark" data-tipe="riwayat">Riwayat</button>
        </div>
        <div class="d-flex align-items-center gap-2">
            <input type="text" id="searchPribadi" class="form-control rounded-pill shadow-sm" style="min-width: 220px;" placeholder="Cari data lelang...">
            <a href="{{ route('lelang.buat') }}" class="btn btn-danger px-4 rounded-pill fw-bold shadow-sm text-nowrap"><i class="bi bi-plus-lg me-1"></i> Buat Lelang</a>
        </div>
    </div>

    <div id="kontenLelangPribadi">
        {{-- List Unit Aktif --}}
        <div id="aktifList">
            @forelse($lelangAktifSaya as $lelang)
                <div class="lelang-card-item" style="display: {{ $loop->iteration > 5 ? 'none' : 'block' }};">
                <div class="card mb-4 shadow-sm border-danger" style="border-radius: 1.25rem;">
                    <div class="card-body p-4">
                        {{-- Judul dan Status --}}
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h4 class="card-title fw-bold mb-0 text-dark">{{ $lelang->judul }}</h4>
                            <span class="badge bg-success shadow-sm">Aktif</span>
                        </div>
                        
                        {{-- Username Penjual (Diri Sendiri) --}}
                        <p class="text-muted small mb-3"><i class="bi bi-person-circle me-1"></i> Penjual: <span class="fw-bold">{{ $lelang->penjual->username }} (Anda)</span></p>

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
                            <button class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center rounded-3 p-3 mb-2 border shadow-sm dropdown-desc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#descPribadiAktif{{ $lelang->id }}" aria-expanded="false" aria-controls="descPribadiAktif{{ $lelang->id }}">
                                <span class="fw-semibold text-dark"><i class="bi bi-file-earmark-text text-danger me-2"></i>Deskripsi Mobil</span>
                                <i class="bi bi-chevron-down text-muted"></i>
                            </button>
                            <div class="collapse" id="descPribadiAktif{{ $lelang->id }}">
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
                                    <span class="small fw-medium text-dark">{{ \Carbon\Carbon::parse($lelang->waktu_mulai)->translatedFormat('d M Y, H:i') }} - {{ \Carbon\Carbon::parse($lelang->waktu_berakhir)->translatedFormat('d M Y, H:i') }}</span>
                                </div>
                                <div class="col-md-2 col-12 text-md-end mt-3 mt-md-0">
                                    @if($lelang->penawaran()->count() == 0 && $lelang->waktu_berakhir > now())
                                        <form method="POST" action="{{ route('lelang.batalkan', $lelang->id) }}" onsubmit="return confirm('Yakin batalkan lelang?')">
                                            @csrf
                                            <button class="btn btn-outline-secondary btn-sm rounded-pill w-100 fw-bold">Batalkan</button>
                                        </form>
                                    @else
                                        <button class="btn btn-light btn-sm text-muted rounded-pill w-100 border" disabled style="font-size: 0.8rem;"><i class="bi bi-lock-fill me-1"></i> Terkunci</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @empty
                <div class="text-center py-5"><p class="text-secondary">Tidak ada lelang aktif yang Anda buat.</p></div>
            @endforelse

            @if(count($lelangAktifSaya) > 5)
            <div class="text-center mt-4 mb-4 wrapper-load-more">
                <button type="button" class="btn btn-outline-danger px-5 rounded-pill fw-bold btn-load-more shadow-sm">Muat lebih banyak</button>
            </div>
            @endif
        </div>

        {{-- List Riwayat --}}
        <div id="riwayatList" style="display:none;">
            @forelse($riwayatSaya as $lelang)
                <div class="lelang-card-item" style="display: {{ $loop->iteration > 5 ? 'none' : 'block' }};">
                <div class="card mb-4 shadow-sm border-0" style="border-radius: 1.25rem;">
                    <div class="card-body p-4">
                        {{-- Judul dan Status --}}
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h4 class="card-title fw-bold mb-0 text-dark">{{ $lelang->judul }}</h4>
                            <div>
                                <span class="badge bg-secondary shadow-sm me-1">Selesai</span>
                                @if($lelang->pemenang() && $lelang->pemenang()->id == Auth::id())
                                    <span class="badge bg-info shadow-sm">Dimenangkan (Anda Pemenangnya)</span>
                                @elseif($lelang->pemenang())
                                    <span class="badge bg-success shadow-sm">Terjual</span>
                                @else
                                    <span class="badge bg-warning text-dark shadow-sm">Tidak Terjual</span>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Username Penjual --}}
                        <p class="text-muted small mb-3"><i class="bi bi-person-circle me-1"></i> Penjual: <span class="fw-bold">{{ $lelang->penjual->username }} (Anda)</span></p>

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
                            <button class="btn btn-light w-100 text-start d-flex justify-content-between align-items-center rounded-3 p-3 mb-2 border shadow-sm dropdown-desc-btn" type="button" data-bs-toggle="collapse" data-bs-target="#descPribadiRiwayat{{ $lelang->id }}" aria-expanded="false" aria-controls="descPribadiRiwayat{{ $lelang->id }}">
                                <span class="fw-semibold text-dark"><i class="bi bi-file-earmark-text text-danger me-2"></i>Deskripsi Mobil</span>
                                <i class="bi bi-chevron-down text-muted"></i>
                            </button>
                            <div class="collapse" id="descPribadiRiwayat{{ $lelang->id }}">
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
                                    <span class="text-muted d-block small">Harga Transaksi Akhir</span>
                                    <span class="fw-bold text-success">Rp {{ number_format($lelang->hargaTertinggi(), 0, ',', '.') }}</span>
                                    <small class="text-muted d-block" style="font-size:0.75rem;">Pemenang: <span class="text-dark fw-bold">{{ $lelang->pemenang() ? $lelang->pemenang()->username : '-' }}</span></small>
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

                        {{-- Tampilkan email pemenang dan titik pertemuan jika ada pemenang --}}
                        @if($lelang->pemenang())
                            <div class="alert alert-info mt-4 border-0 shadow-sm rounded-4 mb-0">
                                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle-fill me-1"></i> Informasi Pemenang & Lokasi COD</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="small mb-2">
                                            <strong>Kontak Pemenang:</strong><br>
                                            <a href="mailto:{{ $lelang->pemenang()->email }}" class="text-decoration-none">{{ $lelang->pemenang()->email }}</a>
                                        </div>
                                        <div class="small">
                                            <strong>Titik Pertemuan:</strong><br>
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
                <div class="text-center py-5"><p class="text-secondary">Belum ada riwayat lelang pribadi.</p></div>
            @endforelse

            @if(count($riwayatSaya) > 5)
            <div class="text-center mt-4 mb-4 wrapper-load-more">
                <button type="button" class="btn btn-outline-danger px-5 rounded-pill fw-bold btn-load-more shadow-sm">Muat lebih banyak</button>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    const searchInput = document.getElementById('searchPribadi');
    let currentTipe = 'aktif';

    function loadData() {
        let search = searchInput.value;
        let url = `{{ route('lelang.pribadi') }}?search=${search}&tipe=${currentTipe}`;
        fetch(url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = currentTipe === 'aktif' ? doc.getElementById('aktifList').innerHTML : doc.getElementById('riwayatList').innerHTML;
                document.getElementById('kontenLelangPribadi').innerHTML = `<div id="aktifList" style="${currentTipe === 'aktif' ? '' : 'display:none'}">${currentTipe === 'aktif' ? newContent : ''}</div>
                                                                         <div id="riwayatList" style="${currentTipe === 'riwayat' ? '' : 'display:none'}">${currentTipe === 'riwayat' ? newContent : ''}</div>`;
            });
    }

    document.querySelectorAll('.switch-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentTipe = this.dataset.tipe;
            document.querySelectorAll('.switch-btn').forEach(b => {
                b.classList.remove('btn-danger', 'btn-light', 'active', 'shadow-sm', 'text-dark');
                if(b.dataset.tipe === currentTipe) b.classList.add('btn-danger', 'active', 'shadow-sm');
                else b.classList.add('btn-light', 'text-dark');
            });
            loadData();
        });
    });
    searchInput.addEventListener('keyup', () => loadData());
</script>
@endpush
@endsection
