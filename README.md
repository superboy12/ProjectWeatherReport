# CuacaGue - Dashboard Cuaca Real-time & Cerdas

**CuacaGue** adalah aplikasi dashboard cuaca berbasis web yang dirancang untuk memberikan informasi cuaca yang akurat, real-time, dan interaktif. Aplikasi ini dibangun menggunakan PHP Native sebagai backend proxy dan Vanilla JavaScript untuk pembaruan data secara asinkron (AJAX), memastikan pengalaman pengguna yang mulus tanpa *loading screen* yang mengganggu.

Proyek ini memanfaatkan data dari **RapidAPI** untuk menyajikan prakiraan cuaca presisi di seluruh wilayah Indonesia, mulai dari level Provinsi hingga Kota/Kabupaten.

## 🌟 Fitur Utama

* **Real-time & Silent Update:** Pembaruan data otomatis (interval 5 detik hingga 10 menit) menggunakan AJAX tanpa *reload* halaman.
* **Smart Recommendation:** Sistem cerdas yang memberikan saran aktivitas (misal: "Bawa payung", "Cuaca panas, minum air") berdasarkan kondisi aktual.
* **Voice Assistant:** Fitur aksesibilitas yang membacakan laporan cuaca dan saran melalui suara (Text-to-Speech).
* **Sun Cycle Tracker:** Visualisasi siklus matahari terbit dan terbenam.
* **Pencarian Wilayah Indonesia:** Dropdown otomatis untuk memilih Provinsi dan Kota/Kabupaten di seluruh Indonesia.
* **Dark Mode & Responsif:** Tampilan modern menggunakan Tailwind CSS yang nyaman di mata dan responsif di berbagai perangkat.
* **Konversi Satuan:** Opsi perpindahan suhu antara Celcius dan Fahrenheit.

## 🛠️ Teknologi yang Digunakan

* **Backend:** PHP (Native) - Berfungsi sebagai API Gateway untuk menyembunyikan API Key dan menangani CORS.
* **Frontend:** HTML5, Tailwind CSS (via CDN).
* **Logic:** Vanilla JavaScript (Fetch API).
* **Data Provider:** RapidAPI (Open Weather).
* **Development Environment:** Laragon.

## ⚙️ Prasyarat

Sebelum menjalankan aplikasi ini, pastikan Anda telah menginstal:
1.  **Laragon** (WAMP/Server Lokal).
2.  Akun **RapidAPI** dan berlangganan (subscribe) ke API Weather yang relevan (misal: *Open Weather* atau sejenisnya) untuk mendapatkan **API Key**.

## 🚀 Panduan Instalasi (Laragon)

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda menggunakan Laragon:

### 1. Siapkan Folder Proyek
Buka folder `www` di instalasi Laragon Anda (biasanya di `C:\laragon\www`). Buat folder baru dengan nama `CuacaGue`.

### 2. Simpan File
Pastikan struktur file di dalam folder `C:\laragon\www\CuacaGue\` adalah sebagai berikut:
* `index.php` (File antarmuka utama)
* `api.php` (File backend proxy)
* `README.md` (File dokumentasi ini)

### 3. Konfigurasi API Key (PENTING ⚠️)
Demi keamanan, API Key tidak disertakan dalam kode sumber ini. Anda harus memasukkannya secara manual.

1.  Buka file `api.php` menggunakan teks editor (VS Code, Notepad++, dll).
2.  Cari bagian konfigurasi header `CURLOPT_HTTPHEADER`.
3.  Masukkan API Key RapidAPI Anda pada bagian `x-rapidapi-key`.

Contoh:
```php
CURLOPT_HTTPHEADER => [
    "x-rapidapi-host: open-weather13.p.rapidapi.com", // Sesuaikan host API Anda
    "x-rapidapi-key: MASUKKAN_API_KEY_ANDA_DISINI"   // <--- Tempel Key di sini
],
