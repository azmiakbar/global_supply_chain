# 🌍 Global Supply Chain Risk Intelligence Platform

## 📖 Deskripsi

Global Supply Chain Risk Intelligence Platform merupakan aplikasi berbasis web yang dikembangkan menggunakan Laravel untuk membantu memonitor kondisi dan risiko dalam proses pengiriman barang antar negara.

Sistem ini memanfaatkan data cuaca, nilai tukar mata uang, kondisi ekonomi, serta berita internasional untuk memberikan informasi risiko pada suatu negara sebagai pendukung keputusan dalam aktivitas supply chain.

---

# 🎯 Tujuan

- Mempermudah monitoring kondisi negara tujuan pengiriman.
- Menampilkan informasi risiko berdasarkan beberapa indikator.
- Membantu pengelolaan data pengiriman internasional.
- Menampilkan visualisasi data melalui dashboard.

---

# 🛠️ Teknologi

- Laravel 12
- PHP 8.2
- MySQL
- Bootstrap 5
- Chart.js
- Leaflet.js

---

# 🌐 API yang Digunakan

### Open Meteo API

Digunakan untuk memperoleh data:

- Temperature
- Humidity
- Rain
- Wind Speed

---

### Exchange Rate API

Digunakan untuk memperoleh nilai tukar mata uang terhadap USD.

---

### World Bank API

Digunakan untuk memperoleh informasi ekonomi negara, seperti:

- GDP
- Inflation
- Export
- Import

---

### News API

Digunakan untuk memperoleh berita berdasarkan nama negara.

---

# ✨ Fitur yang Telah Dibuat

## 📊 Dashboard

Menampilkan ringkasan data sistem berupa:

- Total Countries
- Total Ports
- Total Items
- Total Shipments
- Risk Summary
- Grafik Risk Distribution
- Grafik Shipment Status

---

## 🌍 Countries

Master data negara yang berisi:

- Nama Negara
- Capital
- Currency
- Language
- Region
- Population
- Latitude
- Longitude

---

## 📦 Items

Pengelolaan data barang.

Fitur:

- Tambah Item
- Edit Item
- Hapus Item
- Daftar Item

---

## 🚢 Shipments

Pengelolaan data pengiriman internasional.

Fitur:

- Tambah Shipment
- Daftar Shipment
- Origin Country
- Destination Country
- Origin Port
- Destination Port
- Quantity
- Estimated Arrival (ETA) otomatis berdasarkan jarak
- Status Shipment

---

## ⚠ Risk Monitoring

Monitoring kondisi suatu negara berdasarkan:

- Live Weather
- Currency
- Economy
- Latest News
- Risk Score
- Risk Level

---

## 📊 Country Comparison

Membandingkan dua negara berdasarkan:

- Currency
- Population
- GDP
- Inflation
- Risk Score

---

## 📰 News Intelligence

Struktur awal halaman News Intelligence untuk menampilkan berita berdasarkan negara menggunakan News API.

---

## 🗺️ Global Risk Map

Visualisasi lokasi pengiriman menggunakan Leaflet Map.

---

# 📈 Risk Scoring

Risk dihitung berdasarkan beberapa indikator.

| Faktor | Maksimum Skor |
|---------|---------------|
| Weather | 25 |
| Currency | 20 |
| Economy | 25 |
| News | 30 |

Total maksimum:

100

Kategori Risiko:

- LOW
- MEDIUM
- HIGH

---


# 🚀 Cara Menjalankan Project

```bash
git clone https://github.com/USERNAME/global_supply_chain.git

cd global_supply_chain

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve
```

---

# 👨‍💻 Developer

**Azmi Akbar Nauli Dalimunthe**