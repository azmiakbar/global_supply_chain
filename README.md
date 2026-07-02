# Sistem Monitoring Risiko Global Supply Chain

Sistem berbasis Laravel untuk memantau risiko pada rantai pasok global melalui integrasi data negara, ekonomi, cuaca, kurs mata uang, dan berita internasional.

## Deskripsi

Proyek ini dikembangkan sebagai tugas mata kuliah untuk membantu monitoring aktivitas ekspor dan impor antar negara.

Tahap pengembangan saat ini difokuskan pada penyediaan master data negara sebagai fondasi untuk integrasi API dan fitur monitoring berikutnya.

---

## Progress Saat Ini

### ✅ Master Data Negara

Fitur yang telah berhasil dibuat:

- Migration tabel `countries`
- Model `Country`
- Controller `CountryController`
- REST API `GET /api/countries`
- Laravel Seeder untuk import data negara
- Dataset 250 negara dunia
- Pencegahan data duplikat menggunakan `updateOrCreate()`

---

## Informasi Negara

Data negara yang tersedia saat ini meliputi:

- Nama negara
- Kode negara (ISO 2)
- Mata uang
- Bahasa utama
- Wilayah
- Bendera negara

Data populasi, GDP, inflasi, ekspor, dan impor akan diintegrasikan melalui World Bank API pada tahap pengembangan berikutnya.

---

## REST API

### GET /api/countries

Mengembalikan daftar 250 negara dalam format JSON.

Contoh request:

```http
GET /api/countries
```

---

## Teknologi yang Digunakan

### Backend

- PHP 8.2
- Laravel 12
- MySQL
- Eloquent ORM
- REST API

### Frontend (Tahap Berikutnya)

- Blade Template Engine
- Bootstrap 5
- JavaScript
- AJAX

---

## Integrasi API

### Sudah Digunakan

- Dataset negara dunia melalui Laravel Seeder.

### Akan Diintegrasikan

- World Bank API
- Open-Meteo API
- Exchange Rate API
- GNews API

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

Saat ini, modul yang telah diimplementasikan dan digunakan adalah modul **Countries**. Tabel lainnya masih akan dikembangkan pada tahap berikutnya.

---

## Catatan Pengembangan

- Data negara menggunakan Laravel Seeder sesuai arahan dosen.
- Endpoint `GET /api/countries` telah tersedia dan mengembalikan data dalam format JSON.
- Data ekonomi seperti populasi, GDP, inflasi, ekspor, dan impor akan diperoleh melalui World Bank API.
- Pengembangan berikutnya akan difokuskan pada integrasi API eksternal dan dashboard monitoring.

---

## Pengembang

**Azmi Akbar Nauli Dalimunthe**
