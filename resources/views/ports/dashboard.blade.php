@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    ⚓ Port Location Dashboard
</h2>

<div class="row">

    {{-- SEARCH PANELS --}}
    <div class="col-md-3 mb-4">

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white fw-bold">
                🔎 Cari Pelabuhan
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label for="search-input" class="form-label fw-bold">Nama Pelabuhan</label>
                    <input 
                        type="text" 
                        id="search-input" 
                        class="form-control" 
                        placeholder="Ketik nama pelabuhan...">
                </div>

                <div class="mb-3">
                    <label for="country-select" class="form-label fw-bold">Cari Negara</label>
                    <select id="country-select" class="form-select">
                        <option value="">-- Semua Negara --</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button id="search-btn" class="btn btn-primary w-100 fw-bold">
                    <i class="bi bi-search"></i> Terapkan Filter
                </button>

            </div>

        </div>

        <div class="alert alert-info mt-3 shadow-sm" style="font-size:13px">
            <i class="bi bi-info-circle-fill"></i> Peta menggunakan data pelabuhan global. Hasil pencarian dibatasi maksimal 250 data teratas demi performa rendering peta.
        </div>

    </div>

    {{-- MAP DISPLAY --}}
    <div class="col-md-9 mb-4">

        <div class="card shadow border-0">

            <div class="card-body p-0">
                <div id="ports-map" style="height:650px; border-radius:0.5rem;"></div>
            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
document.addEventListener("DOMContentLoaded", function () {

    // 1. Inisialisasi Map
    const map = L.map('ports-map', {
        worldCopyJump: true,
        minZoom: 2
    }).setView([15, 10], 2);

    // 2. Load OpenStreetMap Layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // 3. Cluster Group untuk performa tinggi
    let markerClusterGroup = L.markerClusterGroup();
    map.addLayer(markerClusterGroup);

    // 4. Fungsi Mengambil & Menampilkan Data Pelabuhan
    function fetchAndMapPorts() {
        const query = document.getElementById('search-input').value;
        const countryId = document.getElementById('country-select').value;

        // Tampilkan loading state sederhana di tombol
        const searchBtn = document.getElementById('search-btn');
        searchBtn.disabled = true;
        searchBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mencari...';

        // Panggil REST API ports/search
        const url = `/api/ports/search?q=${encodeURIComponent(query)}&country_id=${countryId}`;

        fetch(url)
            .then(response => response.json())
            .then(ports => {
                // Clear marker lama
                markerClusterGroup.clearLayers();

                if (ports.length === 0) {
                    alert("Tidak ada pelabuhan yang cocok dengan kriteria pencarian.");
                    searchBtn.disabled = false;
                    searchBtn.innerHTML = '<i class="bi bi-search"></i> Terapkan Filter';
                    return;
                }

                const bounds = [];

                ports.forEach(port => {
                    if (port.latitude && port.longitude) {
                        const lat = parseFloat(port.latitude);
                        const lng = parseFloat(port.longitude);
                        const latLng = [lat, lng];

                        bounds.push(latLng);

                        const countryName = port.country ? port.country.name : 'Unknown';

                        // Custom Marker Pelabuhan
                        const marker = L.marker(latLng)
                            .bindPopup(`
                                <div style="min-width: 200px;">
                                    <h5 class="fw-bold mb-1">⚓ ${port.name}</h5>
                                    <hr class="my-2">
                                    <p class="mb-1"><b>Negara:</b> ${countryName}</p>
                                    <p class="mb-1"><b>Kode Pelabuhan:</b> ${port.code || '-'}</p>
                                    <p class="mb-1"><b>Status:</b> <span class="badge bg-success">${port.status || 'Active'}</span></p>
                                    <p class="mb-0"><b>Transport:</b> Sea</p>
                                </div>
                            `);

                        markerClusterGroup.addLayer(marker);
                    }
                });

                // Auto pan & zoom sesuai sebaran koordinat pelabuhan yang ditemukan
                if (bounds.length > 0) {
                    map.fitBounds(bounds, { padding: [50, 50], maxZoom: 8 });
                }

                searchBtn.disabled = false;
                searchBtn.innerHTML = '<i class="bi bi-search"></i> Terapkan Filter';
            })
            .catch(error => {
                console.error("Gagal mengambil data pelabuhan:", error);
                alert("Terjadi kesalahan koneksi saat memuat data.");
                searchBtn.disabled = false;
                searchBtn.innerHTML = '<i class="bi bi-search"></i> Terapkan Filter';
            });
    }

    // Bind event klik & input enter
    document.getElementById('search-btn').addEventListener('click', fetchAndMapPorts);
    document.getElementById('search-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            fetchAndMapPorts();
        }
    });

    // Jalankan pencarian default pertama kali halaman dibuka
    fetchAndMapPorts();
});
</script>

@endpush
