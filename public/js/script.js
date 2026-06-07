// Dark mode toggle
const toggle = document.getElementById('darkModeToggle');
if (localStorage.getItem('dark') === 'enabled') {
    document.body.classList.add('dark-mode');
}
toggle?.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('dark', document.body.classList.contains('dark-mode') ? 'enabled' : 'disabled');
});

// Inisialisasi CKEditor untuk textarea deskripsi
document.querySelectorAll('.ckeditor').forEach((el) => {
    ClassicEditor.create(el).catch(err => console.error(err));
});

// Fungsi untuk menampilkan lightbox (popup) sederhana
function showPopup(pesan, isError = false) {
    let popup = document.createElement('div');
    popup.className = 'alert alert-' + (isError ? 'danger' : 'success') + ' position-fixed top-50 start-50 translate-middle shadow-lg';
    popup.style.zIndex = '9999';
    popup.innerHTML = pesan + '<button class="btn-close float-end" data-bs-dismiss="alert"></button>';
    document.body.appendChild(popup);
    setTimeout(() => popup.remove(), 3000);
}

// AJAX untuk membuat penawaran (tanpa reload)
function buatPenawaran(lelangId, formElement) {
    let harga = formElement.querySelector('input[name="harga_tawar"]').value;
    fetch(`/penawaran/${lelangId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ harga_tawar: harga })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showPopup(data.message);
            // Update tampilan harga tertinggi & jumlah penawar
            let card = formElement.closest('.card');
            card.querySelector('.harga-tertinggi').innerText = 'Rp ' + data.harga_baru;
            card.querySelector('.jumlah-penawar').innerText = data.jumlah_penawar;
            formElement.reset();
        } else {
            showPopup(data.error || 'Gagal membuat penawaran', true);
        }
    })
    .catch(err => showPopup('Terjadi kesalahan server', true));
}

// Inisialisasi Google Maps untuk titik pertemuan (di halaman buat lelang)
function initMap() {
    const input = document.getElementById('titik_pertemuan');
    if (input) {
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setFields(['formatted_address']);
    }
}
window.initMap = initMap;
