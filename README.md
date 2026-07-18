# 🌍 Global Supply Chain Risk Intelligence Platform

Global Supply Chain Risk Intelligence Platform merupakan aplikasi berbasis web (*Decision Support System*) yang dikembangkan menggunakan **Laravel 12**, **PHP 8.2**, **MySQL**, dan **Bootstrap 5**. Platform ini dirancang untuk memantau, menganalisis, dan memitigasi risiko operasional pengiriman barang internasional (*shipment*) secara real-time.

Sistem mengintegrasikan data dari berbagai API global (cuaca, nilai tukar mata uang, indikator ekonomi makro, berita geopolitik) serta menyajikan visualisasi data geospasial dan analitik untuk mendukung pengambilan keputusan bisnis logistik.

---

## 🎯 Tujuan Proyek

- **Risk Mitigation**: Mengurangi risiko keterlambatan pengiriman dengan memantau indikator eksternal secara proaktif.
- **Real-Time Monitoring**: Menyajikan kondisi cuaca ekstrem, fluktuasi kurs, inflasi negara tujuan, dan sentimen berita dunia.
- **Decision Support**: Membantu logistik menentukan apakah pengiriman aman dilanjutkan, perlu diawasi ketat, atau harus ditunda.
- **Data Engineering & Visualization**: Menyajikan visualisasi geospasial (peta rute & peta pelabuhan) dan grafik analitik tren.

---

## 🌐 API Integrasi yang Digunakan

1. **Open-Meteo API**: Mengambil data cuaca real-time (Suhu, Kelembaban, Curah Hujan, Kecepatan Angin) berdasarkan koordinat pelabuhan.
2. **ExchangeRate API**: Mengambil kurs mata uang lokal terhadap USD secara real-time.
3. **World Bank API**: Mengambil data indikator ekonomi makro (GDP, Inflasi, Populasi, Ekspor, Impor).
4. **GNews API**: Mengambil berita internasional terbaru terkait supply chain, perdagangan, logistik, dan pelabuhan.

---

## ✨ Fitur Utama Sistem

### 1. Global Country Dashboard & Watchlist
- Memilih negara untuk melihat ringkasan profil negara (Ibu kota, Populasi, Bahasa, Mata uang, Wilayah).
- Menyimpan negara pantauan ke dalam daftar **Watchlist** favorit bagi pengguna terdaftar.

### 2. Risk Scoring & Prediction Engine
Menghitung indeks risiko negara (skala 0 - 100) secara dinamis menggunakan rumus pembobotan:
$$\text{Risk Score} = \text{Weather (25\%)} + \text{Currency (20\%)} + \text{Economy (25\%)} + \text{News Sentiment (30\%)}$$
- 🟢 **LOW RISK** (Skor $\le$ 30): Pengiriman aman berjalan normal.
- 🟡 **MEDIUM RISK** (Skor 31 - 70): Pengiriman diawasi ketat (Delay estimasi tiba +2 Hari).
- 🔴 **HIGH RISK** (Skor $\ge$ 71): Disarankan menunda pengiriman (Delay estimasi tiba +5 Hari).

### 3. Smart News Intelligence
- Penarikan berita global dengan kueri tertarget supply chain & logistik.
- **Weighted Classifier**: Klasifikasi kategori otomatis (*Shipping, Trade, Oil, Port, Logistics, Supply Chain*) berdasarkan bobot kata kunci pada judul (bobot 3) dan deskripsi (bobot 1).
- **Deduplication Engine**: Membandingkan kemiripan judul berita (threshold 70%) untuk membuang berita duplikat (sindikasi media).
- **False-Positive Filter**: Mengabaikan berita non-industri yang menyangkut nama kota pelabuhan (seperti *Port Dickson*, *Port Elizabeth*, dll).
- **API Cache Protection**: Membungkus pemanggilan API dengan cache selama 15 menit untuk menghemat kuota harian GNews.

### 4. Port Location Dashboard (Peta Pelabuhan)
- Menyajikan sebaran pelabuhan laut dunia menggunakan **Leaflet.js Map**.
- Dilengkapi form pencarian nama pelabuhan real-time dan filter dropdown negara.
- Menggunakan **Leaflet MarkerCluster** untuk pengelompokan marker demi menjamin performa rendering halus di browser.

### 5. Shipment & Transit Monitoring
- Pengelolaan rute pengiriman internasional (Port-to-Port).
- Perhitungan jarak laut otomatis (*Great-Circle Distance*) untuk menentukan estimasi waktu tempuh dasar (*Base ETA*).
- **Auto Status Transition**: Status pengiriman berubah otomatis (*Pending ➔ In Transit ➔ Delivered*) membandingkan tanggal hari ini dengan tanggal berangkat dan perkiraan kedatangan.

### 6. Data Visualization & Currency Dashboards
- Grafik distribusi risiko (*Risk Distribution Pie Chart*) dan status pengiriman (*Shipment Status Pie Chart*).
- **Currency Impact Chart**: Grafik garis (*Line Chart*) menggunakan Chart.js yang memantau tren fluktuasi nilai tukar mata uang utama dunia (EUR, GBP, JPY) terhadap USD selama 7 hari terakhir.

---

## 👨‍💻 Developer
**Azmi Akbar Nauli Dalimunthe**