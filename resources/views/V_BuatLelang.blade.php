@extends('layouts.V_Layout')
@section('title', 'Buat Pelelangan Baru')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .hover-upload-box {
        transition: all 0.3s ease;
        border: 2px dashed #cbd5e1;
        cursor: pointer;
    }
    .hover-upload-box:hover {
        border-color: var(--primary-red);
        background-color: rgba(225, 6, 0, 0.02) !important;
    }
    body.dark-mode .hover-upload-box {
        border-color: #475569;
    }
    body.dark-mode .hover-upload-box:hover {
        border-color: var(--primary-red);
    }
    .shadow-inner-custom {
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
    }
    /* CKEditor Custom Dark Mode Override */
    body.dark-mode .ck-editor__main .ck-content {
        background-color: #2a2a35 !important;
        color: #ffffff !important;
        border-color: #475569 !important;
    }
    body.dark-mode .ck-editor__top .ck-toolbar {
        background-color: #252530 !important;
        border-color: #475569 !important;
    }
    body.dark-mode .ck.ck-button {
        color: #ffffff !important;
    }
    body.dark-mode .ck.ck-button:hover {
        background-color: #3f3f4e !important;
    }
    /* Mengatur tinggi editor agar seimbang */
    .ck-editor__editable_inline {
        min-height: 250px !important;
    }
    .pac-container {
        z-index: 10000 !important;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: none !important;
    }
</style>
@endpush

@section('content')
<div class="container pt-2 pb-5" style="max-width: 1000px;">
    <!-- Top Action Panel: Tombol Kembali & Sub-teks yang diselaraskan -->
    <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
        <a href="{{ route('lelang.pribadi') }}" class="text-decoration-none fw-bold text-danger small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Lelang Saya
        </a>
        <span class="text-muted small fw-medium">
            <i class="bi bi-info-circle me-1"></i> Isi detail mobil atau koleksi terbaik Anda untuk mulai melelang.
        </span>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4 rounded-4 py-3">
            <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal Menyimpan Pelelangan:</h6>
            <ul class="mb-0 mt-2 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('lelang.simpan') }}" enctype="multipart/form-data" id="formBuatLelang">
        @csrf
        
        <!-- Section 1: Informasi Mobil -->
        <div class="mb-5">
            <h5 class="fw-bold text-dark mb-4 border-bottom pb-3"><i class="bi bi-car-front-fill text-danger me-2"></i> Detail Mobil</h5>
            
            <div class="mb-4">
                <label class="form-label text-dark fw-bold small">Judul Pelelangan</label>
                <input type="text" name="judul" class="form-control form-control-lg" placeholder="Contoh: Ferrari 458 Italia 2012" value="{{ old('judul') }}" required maxlength="100">
            </div>

            <div class="mb-4">
                <label class="form-label text-dark fw-bold small">Spesifikasi & Deskripsi Mobil</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Tuliskan kondisi fisik, kelengkapan, minus, dll...">{{ old('deskripsi') }}</textarea>
                <div id="charCount" class="text-end small mt-1 text-danger fw-bold">0/2000 karakter</div>
            </div>

            <div class="mb-0">
                <label class="form-label text-dark fw-bold small">Foto-foto Mobil Pendukung</label>
                <div class="p-4 bg-light rounded-4 text-center position-relative hover-upload-box" style="min-height: 150px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <i class="bi bi-cloud-upload text-danger fs-2 mb-2"></i>
                    <span class="d-block fw-bold text-dark small">Pilih Berkas Foto Mobil</span>
                    <span class="text-secondary small d-block mb-0" style="font-size: 0.75rem;">Maks. 2MB per berkas (Dukung banyak foto sekaligus, otomatis bertambah)</span>
                    <input type="file" name="foto[]" class="form-control" accept="image/*" multiple required style="opacity: 0; position: absolute; top:0; left:0; width:100%; height:100%; cursor:pointer;" id="fotoUpload">
                </div>
                <div id="filePreview" class="row g-3 mt-2 justify-content-start"></div>
            </div>
        </div>

        <!-- Section 2: Harga, Jadwal & Lokasi (2 Kolom Seimbang) -->
        <div class="row g-4 mb-4">
            <!-- Kolom Kiri: Harga & Jadwal -->
            <div class="col-md-6">
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-4 border-bottom pb-3"><i class="bi bi-tags-fill text-danger me-2"></i> Harga & Jadwal</h5>
                    
                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold small">Harga Batas Minimum Awal (Rp)</label>
                        <div class="input-group custom-input-group">
                            <span class="input-group-text fw-bold">IDR</span>
                            <input type="text" id="harga_awal_tampil" class="form-control format-rupiah" placeholder="0" required>
                            <input type="hidden" name="harga_awal" id="harga_awal_hidden" value="{{ old('harga_awal') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-dark fw-bold small">Waktu Mulai Penawaran</label>
                        <input type="datetime-local" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label text-dark fw-bold small">Waktu Penutupan Penawaran</label>
                        <input type="datetime-local" name="waktu_berakhir" class="form-control" value="{{ old('waktu_berakhir') }}" required>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Lokasi -->
            <div class="col-md-6">
                <div class="mb-4">
                    <h5 class="fw-bold text-dark mb-4 border-bottom pb-3"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Verifikasi Lokasi Mobil</h5>
                    
                    <div class="mb-3">
                        <label class="form-label text-dark fw-bold small">Titik Lokasi Pertemuan</label>
                        <div class="input-group custom-input-group mb-2">
                            <span class="input-group-text text-danger"><i class="bi bi-geo-alt-fill"></i></span>
                            <input type="text" id="titik_pertemuan" name="titik_pertemuan" class="form-control" placeholder="Ketik alamat atau nama tempat..." value="{{ old('titik_pertemuan') }}" required>
                        </div>
                    </div>

                    <div id="map" class="rounded-3 shadow-inner-custom border border-secondary border-opacity-25 mb-3" style="height: 250px; width:100%; z-index: 1;"></div>

                    <div class="mb-0">
                        <label class="form-label text-dark fw-bold small">Detail Lokasi (Opsional)</label>
                        <input type="text" name="detail_lokasi" class="form-control" placeholder="Contoh: Lantai 2, lobi utama, ruko nomer 5..." value="{{ old('detail_lokasi') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-5 pt-4 border-top d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-danger px-5 py-3 fw-bold rounded-pill">Buat Pelelangan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- CKEditor Standard CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let map, marker;

    // Inisialisasi OpenStreetMap via Leaflet
    function initMap() {
        const defaultLoc = [-6.2088, 106.8456]; // Jakarta
        
        map = L.map('map').setView(defaultLoc, 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        marker = L.marker(defaultLoc, { draggable: true }).addTo(map);
        
        const input = document.getElementById("titik_pertemuan");
        
        // Pencarian Lokasi dengan Nominatim saat input enter/lepas fokus
        input.addEventListener('change', function() {
            let query = this.value;
            if (query.trim() === '') return;
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const latLng = new L.LatLng(data[0].lat, data[0].lon);
                        map.setView(latLng, 17);
                        marker.setLatLng(latLng);
                        input.value = data[0].display_name;
                    } else {
                        alert('Lokasi tidak ditemukan');
                    }
                })
                .catch(err => console.error(err));
        });
        
        // Reverse Geocoding saat marker digeser
        marker.on('dragend', function(e) {
            geocodePosition(marker.getLatLng());
        });
        
        // Event klik di map untuk memindahkan penanda
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            geocodePosition(e.latlng);
        });
    }
    
    // Fungsi reverse geocoding untuk mendapatkan alamat dari koordinat
    function geocodePosition(latlng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latlng.lat}&lon=${latlng.lng}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.display_name) {
                    document.getElementById("titik_pertemuan").value = data.display_name;
                }
            })
            .catch(err => console.error(err));
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();

        // Inisialisasi CKEditor Standard
        let myEditor;
        ClassicEditor
            .create(document.querySelector('#deskripsi'))
            .then(editor => {
                myEditor = editor;
                const charCountEl = document.getElementById('charCount');
                
                editor.model.document.on('change:data', () => {
                    const data = editor.getData();
                    const text = data.replace(/<[^>]*>?/gm, '').trim();
                    const count = text.length;
                    
                    if(count > 2000) {
                        charCountEl.innerHTML = `<i class="bi bi-exclamation-circle me-1"></i> ${count}/2000 karakter (Maksimal!)`;
                    } else {
                        charCountEl.innerHTML = `${count}/2000 karakter`;
                    }
                });

                // Inisialisasi awal
                const text = editor.getData().replace(/<[^>]*>?/gm, '').trim();
                charCountEl.innerHTML = `${text.length}/2000 karakter`;
            })
            .catch(error => {
                console.error(error);
            });

        // Dynamic File Preview (mendukung banyak file sekaligus dengan DataTransfer)
        const dt = new DataTransfer();
        document.getElementById('fotoUpload').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('filePreview');
            previewContainer.innerHTML = '';
            
            // Tambahkan file baru ke dt
            for (let i = 0; i < e.target.files.length; i++) {
                dt.items.add(e.target.files[i]);
            }
            
            // Perbarui file input dengan list file yang terakumulasi
            e.target.files = dt.files;
            
            // Render ulang preview
            for (let i = 0; i < dt.files.length; i++) {
                const file = dt.files[i];
                if (!file.type.startsWith('image/')) continue;
                
                const reader = new FileReader();
                reader.onload = function(event) {
                    const col = document.createElement('div');
                    col.className = 'col-4 col-md-3 col-lg-2 position-relative';
                    col.innerHTML = `
                        <img src="${event.target.result}" class="img-thumbnail object-fit-cover rounded-3 shadow-sm" style="width:100%; height:90px;" alt="preview">
                    `;
                    previewContainer.appendChild(col);
                };
                reader.readAsDataURL(file);
            }
        });

        // Validasi Form sebelum kirim
        document.getElementById('formBuatLelang').addEventListener('submit', function(e) {
            let valid = true;
            const mulai = new Date(document.querySelector('[name="waktu_mulai"]').value);
            const berakhir = new Date(document.querySelector('[name="waktu_berakhir"]').value);
            
            if (myEditor) {
                const data = myEditor.getData();
                const text = data.replace(/<[^>]*>?/gm, '').trim();
                if (text.length > 2000) {
                    alert("Deskripsi tidak boleh lebih dari 2000 karakter.");
                    valid = false;
                }
            }
        
        // Toleransi waktu 10 menit
        const now = new Date();
        now.setMinutes(now.getMinutes() - 10);
        
        if (mulai <= now) {
            alert("Waktu mulai tidak boleh di masa lampau.");
            valid = false;
        }
        if (berakhir <= mulai) {
            alert("Waktu berakhir harus setelah waktu mulai.");
            valid = false;
        }
        
        const fotoFiles = document.getElementById('fotoUpload').files;
        for (let i = 0; i < fotoFiles.length; i++) {
            if (fotoFiles[i].size > 2 * 1024 * 1024) {
                alert("Ukuran foto melebihi 2 MB: " + fotoFiles[i].name);
                valid = false;
                break;
            }
        }
        if (!valid) e.preventDefault();
    });

    // Format Rupiah untuk harga_awal
    const hargaTampil = document.getElementById('harga_awal_tampil');
    const hargaHidden = document.getElementById('harga_awal_hidden');

    if(hargaTampil && hargaHidden) {
        hargaTampil.addEventListener('keyup', function(e) {
            this.value = formatRupiah(this.value);
            hargaHidden.value = this.value.replace(/\./g, '');
        });

        // Initialize if old value exists
        if(hargaHidden.value) {
            hargaTampil.value = formatRupiah(hargaHidden.value);
        }
    }

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
});
</script>
@endpush



