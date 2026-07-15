# TokoKita - E-Commerce UMKM

**TokoKita** adalah sebuah platform aplikasi web e-commerce yang dirancang khusus untuk memfasilitasi Usaha Mikro, Kecil, dan Menengah (UMKM). Platform ini memungkinkan pemilik usaha kecil untuk membuka toko online, mempublikasikan produk, mengelola operasional penjualan, serta menerima pembayaran dari pelanggan umum.

## 🚀 Fitur Utama

- **Modul Autentikasi & Otorisasi**: Registrasi, Login, Manajemen Profil untuk berbagai peran (Admin, Seller, Customer).
- **Modul Pemilik Toko (Seller Dashboard)**: 
  - Manajemen Produk (Stok, Harga, Foto)
  - Manajemen Pesanan (Status pengiriman, Resi)
  - Laporan & Analitik (Pendapatan harian/mingguan/bulanan, Produk terlaris)
- **Modul Pembeli (Customer)**: 
  - Eksplorasi & Pencarian Produk
  - Keranjang Belanja (Cart)
  - Checkout & Pembayaran
  - Pelacakan Pesanan
- **Modul Admin Sistem**: 
  - Dashboard Admin (Statistik pengguna, toko, transaksi)
  - Manajemen Pengguna & Toko UMKM
  - Manajemen Kategori Global

## 🛠️ Tumpukan Teknologi (Tech Stack)

- **Backend**: Laravel 10 (PHP)
- **Database**: MySQL
- **Frontend**: Blade Templating, Tailwind CSS, Alpine.js
- **Testing**: Playwright (E2E Testing)

## 📸 Tangkapan Layar (Screenshots)

### Halaman Beranda (Home)
![Home Page](docs/screenshots/01-home.png)

### Halaman Login
![Login Page](docs/screenshots/02-login.png)

### Halaman Registrasi
![Register Page](docs/screenshots/03-register.png)

### Dashboard Penjual (Seller)
![Dashboard Page](docs/screenshots/04-dashboard.png)

## ⚙️ Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan pengembangan lokal Anda:

1. Clone repositori ini:
   ```bash
   git clone <repository_url>
   cd toko-umkm-app
   ```
2. Instal dependensi PHP menggunakan Composer:
   ```bash
   composer install
   ```
3. Instal dependensi Node.js menggunakan NPM:
   ```bash
   npm install
   ```
4. Salin file konfigurasi environment:
   ```bash
   cp .env.example .env
   ```
5. Hasilkan *application key* Laravel:
   ```bash
   php artisan key:generate
   ```
6. Sesuaikan konfigurasi database pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tokokita
   DB_USERNAME=root
   DB_PASSWORD=
   ```
7. Jalankan migrasi dan seeder database:
   ```bash
   php artisan migrate --seed
   ```
8. Kompilasi aset frontend (jalankan di terminal terpisah):
   ```bash
   npm run dev
   ```
9. Jalankan *development server* Laravel:
   ```bash
   php artisan serve
   ```
   Aplikasi sekarang dapat diakses di `http://localhost:8000`

## 🧪 Cara Menjalankan Test Playwright

Untuk menjalankan *End-to-End Testing* menggunakan Playwright, gunakan perintah berikut:

```bash
npx playwright test
```
*Catatan: Pastikan aplikasi sudah berjalan (menggunakan `php artisan serve`) sebelum menjalankan test.*

## 🔒 Status Keamanan dan Audit Repositori

- **Pemeriksaan `.gitignore`**: File sensitif seperti `.env`, folder `vendor`, `node_modules`, direktori build (`public/build`), serta log (`storage/logs`) telah ditambahkan dan dikecualikan dari Git tracking.
- **Audit Riwayat Git (Credentials)**: Berdasarkan pemeriksaan *git commit history*, **tidak ditemukan** penyusupan atau commit tidak sengaja untuk kredensial `.env` maupun *hardcoded secrets*.

## 👨‍💻 Informasi Penulis

- **Nama**: ainunnisaaaa
- **NIM**: [NIM Anda - Harap Diisi]
- **Prodi**: [Prodi Anda - Harap Diisi]
- **Email Akademik**: ainunnisa60268@gmail.com
