# Sistem Monitoring Risiko Global Supply Chain

Sistem berbasis Laravel untuk pengelolaan data negara dan logistics nodes sebagai fondasi monitoring rantai pasok global.

## Deskripsi

Proyek ini dikembangkan sebagai tugas mata kuliah dengan fokus pada penyediaan data master negara dan lokasi logistik internasional yang akan digunakan pada tahap pengembangan berikutnya.

---

## Fitur yang Sudah Dibuat

### Master Data Negara

- Migration tabel `countries`
- Model `Country`
- Controller `CountryController`
- REST API `GET /api/countries`
- Laravel Seeder data negara
- 250 negara dunia

Informasi yang tersedia:

- Nama negara
- Kode ISO
- Mata uang
- Bahasa
- Wilayah
- Bendera

---

### Master Data Logistics Nodes

- Migration tabel `ports`
- Penambahan kolom `code`
- Penambahan kolom `transport_type`
- Model `Port`
- Controller `PortController`
- REST API `GET /api/ports`
- Laravel Seeder menggunakan dataset UN/LOCODE
- Relasi `Port -> Country`
- Pagination 100 data per halaman

Data yang berhasil diimpor:

- 26.622 logistics nodes
- Seaport
- Airport
- Dry Port

Informasi yang disimpan:

- Kode UN/LOCODE
- Nama lokasi
- Negara
- Latitude
- Longitude
- Status
- Jenis transportasi

---

## REST API

### GET /api/countries

Mengembalikan daftar 250 negara dalam format JSON.

```http
GET /api/countries
```

### GET /api/ports

Mengembalikan daftar logistics nodes dengan pagination.

```http
GET /api/ports
```

---

## Teknologi yang Digunakan

- PHP 8.2
- Laravel 12
- MySQL
- Eloquent ORM
- REST API

---

## Struktur Database

Tabel yang telah dibuat:

- users
- countries
- ports
- items
- shipments
- risk_scores
- watchlists
- news_caches
- articles

---

## Modul yang Selesai

- Countries
- Ports

---

## Pengembang

**Azmi Akbar Nauli Dalimunthe**