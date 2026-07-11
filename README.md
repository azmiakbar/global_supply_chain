# 🌍 Global Supply Chain Risk Intelligence Platform

## Deskripsi

Global Supply Chain Risk Intelligence Platform adalah aplikasi berbasis web yang dikembangkan menggunakan Laravel untuk membantu memantau pengiriman barang antar negara. Sistem ini menyediakan informasi monitoring negara, visualisasi jalur pengiriman, serta analisis risiko berdasarkan berbagai sumber data seperti cuaca, ekonomi, nilai tukar mata uang, dan berita.

Project ini masih dalam tahap pengembangan sebagai Tugas Akhir mata kuliah Web Programming.

---

# Fitur yang Telah Selesai

## 🔐 Authentication

- Login
- Register
- Logout
- Dashboard Authentication menggunakan Laravel Breeze

---

## 🌍 Country Management

Fitur yang telah tersedia:

- Menampilkan daftar seluruh negara
- Pagination data negara
- Menampilkan bendera negara
- Menampilkan informasi:
  - Nama Negara
  - Ibu Kota
  - Mata Uang
  - Bahasa
  - Region
- Tombol Monitoring untuk setiap negara

---

## 📦 Item Management

Fitur yang telah tersedia:

- Menampilkan daftar barang
- Menambahkan barang
- Mengubah data barang
- Menghapus barang

---

## 🚢 Shipment Management

Fitur yang telah tersedia:

- Menampilkan daftar shipment
- Menambahkan shipment
- Relasi dengan Item
- Relasi dengan Country
- Relasi dengan Port

Data shipment yang disimpan meliputi:

- Item
- Origin Country
- Destination Country
- Origin Port
- Destination Port
- Quantity
- Transport Type
- Departure Date
- Estimated Arrival
- Status
- Risk Level
- Risk Score

---

## 🗺 Global Risk Map

Visualisasi pengiriman menggunakan LeafletJS.

Fitur yang telah tersedia:

- Menampilkan lokasi shipment
- Marker negara asal
- Marker negara tujuan
- Garis penghubung (Polyline)
- Popup informasi shipment
- Auto Zoom
- Integrasi OpenStreetMap

---

## 📊 Country Monitoring

Halaman monitoring negara telah tersedia dengan informasi:

- Informasi Negara
- Live Weather
- Currency Monitoring
- Economy Information
- Latest News
- Risk Score

---

## ⚠ Risk Analysis

Sistem telah memiliki dasar analisis risiko melalui RiskService.

Komponen yang digunakan antara lain:

- Weather
- Currency
- Economy
- News

Hasil analisis ditampilkan dalam bentuk:

- Weather Score
- Currency Score
- Economy Score
- News Score
- Total Risk Score
- Risk Level

---

## 🔗 API Integration

Beberapa service yang telah diintegrasikan:

- WeatherService
- CurrencyService
- WorldBankService
- NewsService
- RiskService

Service tersebut digunakan untuk memperoleh data eksternal yang diperlukan pada halaman monitoring negara.

---

# Database Relationship

Relasi utama pada sistem:

Shipment

- belongsTo Item
- belongsTo Origin Country
- belongsTo Destination Country
- belongsTo Origin Port
- belongsTo Destination Port

Port

- belongsTo Country

Country

- hasMany Port

---

# Teknologi

- Laravel 12
- PHP 8.2
- MySQL
- Bootstrap 5
- Blade Template Engine
- JavaScript
- LeafletJS
- OpenStreetMap

---

# Progress Project

✅ Authentication

✅ Dashboard

✅ Country Management

✅ Item Management

✅ Shipment Management

✅ Country Monitoring

✅ Global Risk Map

✅ Risk Analysis

✅ API Integration

---

# Developer

Azmi Akbar Nauli Dalimunthe