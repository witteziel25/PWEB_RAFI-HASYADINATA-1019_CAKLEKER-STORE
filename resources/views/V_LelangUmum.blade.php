@extends('layouts.V_Layout')

@section('title', 'Koleksi Lelang Umum')

@section('content')
<div class="container py-4">
    <!-- Top Action Row: Filter Kapsul & Pencarian (Diselaraskan dengan Lelang Pribadi) -->
    <div class="row align-items-center g-3 mb-5 mt-2">
        <div class="col-md-6">
            <div class="btn-group custom-switch-group bg-light p-1 rounded-pill shadow-sm" style="max-width: fit-content;">
                <button class="btn btn-danger active switch-btn shadow-sm" data-tipe="aktif">Aktif</button>
                <button class="btn btn-light switch-btn text-dark" data-tipe="riwayat">Riwayat</button>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="d-inline-block position-relative" style="max-width: 350px; width: 100%;">
                <input type="text" id="searchUmum" class="form-control rounded-pill ps-4 shadow-sm" placeholder="Cari tipe Ferrari...">
            </div>
        </div>
    </div>

    <!-- Main Content Container (Berisi Partial View untuk Data atau Tampilan Kosong) -->
    <div id="kontenLelangUmum" class="row">
        <!-- Section Unit Aktif -->
        <div id="aktifUmum" class="w-100">
            @if(isset($lelangAktif) && $lelangAktif->count() > 0)
                @include('partials.card_lelang_aktif', ['lelangs' => $lelangAktif])
            @else
                <div class="col-12 text-center py-5">
                    <p class="empty-state-text fs-5 mb-0">Belum ada lelang umum aktif saat ini.</p>
                </div>
            @endif
        </div>

        <!-- Section Riwayat Lelang -->
        <div id="riwayatUmum" class="w-100" style="display:none;">
            @if(isset($riwayat) && $riwayat->count() > 0)
                @include('partials.card_lelang_riwayat', ['lelangs' => $riwayat])
            @else
                <div class="col-12 text-center py-5">
                    <p class="empty-state-text fs-5 mb-0">Tidak ada riwayat lelang umum saat ini.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentTipe = 'aktif';
    const searchInput = document.getElementById('searchUmum');

    // Mengambil data terfilter menggunakan fetch API secara asynchronous
    function loadUmum() {
        let search = searchInput.value;
        fetch(`{{ route('lelang.umum') }}?search=${search}&tipe=${currentTipe}`)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                document.getElementById('aktifUmum').innerHTML = doc.getElementById('aktifUmum').innerHTML;
                document.getElementById('riwayatUmum').innerHTML = doc.getElementById('riwayatUmum').innerHTML;
                attachBidEvents();
            });
    }

    // Melampirkan event handler submit penawaran pada kartu lelang yang baru dimuat
    function attachBidEvents() {
        document.querySelectorAll('.btn-ikuti').forEach(btn => {
            btn.onclick = function() {
                const lelangId = this.dataset.lelangId;
                const formDiv = document.getElementById('formPenawaran' + lelangId);
                if (formDiv.style.display === 'none' || formDiv.style.display === '') {
                    formDiv.style.display = 'block';
                    this.textContent = 'Tutup';
                } else {
                    formDiv.style.display = 'none';
                    this.textContent = 'Ikuti';
                }
            };
        });

        document.querySelectorAll('.form-penawaran').forEach(form => {
            form.onsubmit = async function(e) {
                e.preventDefault();
                let lelangId = this.dataset.lelangId;
                let hargaInputHidden = this.querySelector('input[name="harga_tawar"]');
                let hargaTampil = this.querySelector('.format-rupiah');
                if (hargaTampil && hargaTampil.value) {
                    hargaInputHidden.value = hargaTampil.value.replace(/\./g, '');
                }
                let harga = hargaInputHidden.value;
                let csrf = document.querySelector('meta[name="csrf-token"]').content;

                let response = await fetch(`/penawaran/${lelangId}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                    body: JSON.stringify({ harga_tawar: harga })
                });

                let result = await response.json();
                if (result.success) {
                    alert(result.message);
                    loadUmum();
                } else {
                    alert(result.error || 'Gagal membuat penawaran');
                }
            };
        });
    }

    // Mengendalikan pergantian tab navigasi antara Unit Aktif & Riwayat Lelang
    document.querySelectorAll('.switch-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentTipe = this.dataset.tipe;
            document.getElementById('aktifUmum').style.display = currentTipe === 'aktif' ? 'block' : 'none';
            document.getElementById('riwayatUmum').style.display = currentTipe === 'riwayat' ? 'block' : 'none';

            document.querySelectorAll('.switch-btn').forEach(b => {
                b.classList.remove('btn-danger', 'btn-light', 'active', 'shadow-sm', 'text-dark');
                if(b.dataset.tipe === currentTipe) {
                    b.classList.add('btn-danger', 'active', 'shadow-sm');
                } else {
                    b.classList.add('btn-light', 'text-dark');
                }
            });
            loadUmum();
        });
    });

    // Event listener untuk input pencarian tipe kendaraan
    searchInput.addEventListener('keyup', () => loadUmum());

    // Inisialisasi awal saat halaman pertama kali dibuka
    attachBidEvents();

    // Format Rupiah formatter attached to body for dynamically added elements
    document.body.addEventListener('keyup', function(e) {
        if (e.target && e.target.classList.contains('format-rupiah')) {
            e.target.value = formatRupiah(e.target.value);
            const hiddenInput = e.target.closest('.d-flex').querySelector('input[name="harga_tawar"]');
            if (hiddenInput) {
                hiddenInput.value = e.target.value.replace(/\./g, '');
            }
        }
    });

    function formatRupiah(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }
</script>
@endpush
@endsection
