---
name: Laravel Setup TokoKita
description: Memandu instalasi proyek Laravel 10 untuk TokoKita termasuk persyaratan PHP, konfigurasi database, dan setup Laravel Breeze dengan stack Blade + Tailwind CSS.
---

# Panduan Instalasi Laravel 10 untuk TokoKita

Skill ini memberikan panduan langkah demi langkah untuk menginstal dan mengonfigurasi proyek Laravel 10 untuk aplikasi **TokoKita**.

## 1. Persyaratan Sistem (Minimum)
- **PHP**: Versi 8.1 atau lebih baru (syarat minimum untuk Laravel 10).
- **Composer**: Pastikan Composer sudah terinstal di sistem Anda.
- **Node.js & NPM**: Diperlukan untuk kompilasi aset frontend (Tailwind CSS).

## 2. Membuat Proyek Laravel 10
Jalankan perintah berikut di terminal untuk membuat proyek Laravel baru dengan versi 10:

```bash
composer create-project laravel/laravel:^10.0 tokokita
```

Masuk ke dalam direktori proyek yang baru dibuat:

```bash
cd tokokita
```

## 3. Package Tambahan Wajib
*(Bagian ini dapat disesuaikan jika ada package tambahan yang spesifik diwajibkan untuk proyek TokoKita di kemudian hari. Secara default, Laravel sudah membawa library standar yang lengkap)*

## 4. Konfigurasi Database
Buka file `.env` di root direktori proyek dan perbarui bagian konfigurasi database agar terhubung ke database `tokokita`. Pastikan Anda telah membuat database kosong bernama `tokokita` di database server (misal: MySQL) Anda.

Ubah nilai pada file `.env` menjadi seperti berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tokokita
DB_USERNAME=root
DB_PASSWORD=
```
*(Catatan: Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan kredensial database lokal Anda)*

## 5. Setup Autentikasi Menggunakan Laravel Breeze
TokoKita menggunakan **Laravel Breeze** dengan stack **Blade + Tailwind CSS** untuk fondasi autentikasinya.

**Langkah 1:** Instal package Laravel Breeze sebagai dependency development.
```bash
composer require laravel/breeze --dev
```

**Langkah 2:** Instal Breeze dengan stack Blade.
```bash
php artisan breeze:install blade
```

**Langkah 3:** Instal dependency NPM dan kompilasi aset frontend.
```bash
npm install
npm run build
```

**Langkah 4:** Jalankan migrasi database untuk membuat tabel users, password_reset_tokens, dll.
```bash
php artisan migrate
```

## 6. Menjalankan Aplikasi
Setelah semua langkah di atas selesai, Anda dapat menjalankan server development lokal:

```bash
php artisan serve
```

Aplikasi TokoKita dapat diakses di browser melalui URL: `http://localhost:8000`.
