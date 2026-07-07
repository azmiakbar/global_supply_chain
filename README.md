# 🌍 Global Supply Chain Monitoring System

Sistem Monitoring Risiko Global Supply Chain berbasis Laravel yang dikembangkan sebagai proyek akademik untuk membantu memantau proses pengiriman internasional, mengelola data master supply chain, serta menganalisis potensi risiko yang dapat memengaruhi distribusi barang.

---

## 📖 About Project

Global Supply Chain Monitoring System merupakan aplikasi berbasis web yang dibangun menggunakan Laravel. Sistem ini bertujuan untuk membantu pengelolaan data supply chain internasional melalui data negara, pelabuhan, barang (item), serta pengiriman (shipment).

Pada tahap pengembangan selanjutnya, sistem akan mendukung analisis risiko berdasarkan kondisi cuaca, perubahan nilai tukar mata uang, dan berita global menggunakan API eksternal.

---

## ✨ Current Features

### ✅ Completed

- Database Design
- Database Migration
- Database Seeder
- Countries Data
- Ports Data (26,660+ Logistics Nodes)
- Item Management (CRUD)
  - View Item
  - Add Item
  - Edit Item
  - Delete Item

### 🚧 In Progress

- Shipment Management Module

### ⏳ Planned

- Risk Score Calculation
- Dashboard Monitoring
- Weather API Integration
- Currency API Integration
- News API Integration
- Interactive Map (Leaflet)
- Statistics Dashboard (Chart.js)

---

## 🗄 Database Structure

### Master Data

- Countries
- Ports
- Items

### Transaction Data

- Shipments

### Monitoring Data

- Risk Scores
- Watchlists
- News Caches
- Articles

---

## 🛠 Technology Stack

- Laravel 12
- PHP 8.2
- MySQL
- Laragon
- Bootstrap 5
- JavaScript

---

## ⚙️ Installation

Clone repository

```bash
git clone https://github.com/azmiakbar/global-supply-chain.git
```

Masuk ke folder project

```bash
cd global-supply-chain
```

Install dependency

```bash
composer install
```

Copy file environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Jalankan migration

```bash
php artisan migrate
```

Jalankan seeder

```bash
php artisan db:seed
```

Menjalankan aplikasi

```bash
php artisan serve
```

---

## 📊 Current Project Progress

| Module | Status |
|----------|:------:|
| Laravel Setup | ✅ |
| Database Design | ✅ |
| Migration | ✅ |
| Seeder | ✅ |
| Countries Data | ✅ |
| Ports Data | ✅ |
| Item CRUD | ✅ |
| Shipment Module |  |
| Risk Score |  |
| Dashboard |  |
| API Integration |  |

---

## 📌 Current Database Statistics

| Data | Total |
|------|------:|
| Countries | Available |
| Ports | 26,660+ |
| Items | CRUD Enabled |

---

## 👨‍💻 Developer

**Azmi Akbar Nauli Dalimunthe**