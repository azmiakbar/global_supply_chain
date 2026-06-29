# Sistem Monitoring Risiko Global Supply Chain

Sistem berbasis Laravel untuk memantau risiko pada rantai pasok global melalui data negara, pelabuhan, pengiriman, ekonomi, cuaca, dan berita internasional.

## Deskripsi

Proyek ini dikembangkan sebagai tugas akhir mata kuliah dengan tujuan membantu pengguna memantau faktor-faktor yang memengaruhi aktivitas ekspor dan impor antar negara.

Fokus utama sistem meliputi:

* Manajemen negara dan pelabuhan internasional.
* Monitoring data pengiriman barang.
* Penyimpanan data risiko supply chain.
* Monitoring berita internasional.
* Penyimpanan daftar negara favorit pengguna.
* Pengelolaan artikel analisis oleh administrator.

## Fitur yang Sudah Dibuat

### Database dan Model

* Countries
* Ports
* Items
* Shipments
* Risk Scores
* Watchlists
* News Caches
* Articles

### Relasi Data

* Country memiliki banyak Port.
* Item memiliki banyak Shipment.
* Shipment terhubung dengan negara asal, negara tujuan, pelabuhan asal, dan pelabuhan tujuan.
* User dapat memiliki banyak Watchlist.
* Country dapat memiliki banyak data Risk Score dan News Cache.

### Informasi Negara

Data negara telah mendukung penyimpanan:

* Nama negara
* Kode negara
* Mata uang
* Bahasa
* Wilayah
* Populasi
* Bendera

### Informasi Berita

Data berita mendukung kategori:

* Economy
* Logistics
* Trade
* Shipping
* Geopolitics

## Teknologi yang Digunakan

### Backend

* PHP 8
* Laravel 12
* MySQL
* Eloquent ORM

### Frontend

* Blade Template Engine
* Bootstrap 5
* JavaScript
* AJAX

### Visualisasi (Rencana Implementasi)

* Chart.js
* Leaflet.js
* OpenStreetMap

## Integrasi API (Rencana Implementasi)

* REST Countries API
* Open-Meteo API
* World Bank API
* Exchange Rate API
* GNews API
* Marine Traffic API atau sumber data alternatif

## Struktur Database

Tabel yang telah dibuat:

* users
* countries
* ports
* items
* shipments
* risk_scores
* watchlists
* news_caches
* articles

## Pengembang

Azmi Akbar Nauli Dalimunthe