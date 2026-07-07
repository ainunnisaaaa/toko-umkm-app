---
name: Laravel E2E Testing with Playwright
description: Panduan penulisan test end-to-end (E2E) menggunakan Playwright untuk proyek TokoKita.
---

# Panduan Playwright E2E Testing TokoKita

Skill ini memandu penulisan test end-to-end (E2E) menggunakan Playwright untuk proyek TokoKita, memastikan kualitas aplikasi web yang diuji secara menyeluruh.

## 1. Struktur Folder
Semua pengujian E2E dan konfigurasi yang terkait harus ditempatkan pada folder terpisah agar tidak bercampur dengan pengujian backend (PHPUnit/Pest).
- Direktori utama pengujian E2E: `tests/e2e/`
- Konfigurasi playwright biasanya berada di root atau di dalam direktori `tests/e2e/`.

## 2. Konvensi Penamaan File
- Setiap file pengujian (test file) **wajib** menggunakan ekstensi `.spec.ts`.
- Nama file harus mewakili modul atau fitur yang diuji (contoh: `checkout.spec.ts`, `product-management.spec.ts`, `user-registration.spec.ts`).

## 3. Penggunaan Fixture (Login per Role)
Aplikasi TokoKita memiliki beberapa role pengguna (`seller`, `buyer`, `admin`). Untuk mempercepat waktu eksekusi tes dan menghindari perulangan langkah login pada setiap _test case_, gunakan **Playwright Fixtures** untuk menyimpan dan menggunakan _authenticated state_ (state login).

Contoh pendekatan:
- Buat fixture khusus seperti `sellerPage`, `buyerPage`, dan `adminPage`.
- Fixture tersebut bertanggung jawab melakukan login awal dan menyimpan *storage state* (cookies/session), sehingga pengujian berikutnya dapat menggunakan context yang sudah terautentikasi tanpa harus melalui halaman UI login lagi.

## 4. Helper Akun Seeder
Saat menjalankan tes E2E lokal atau di CI/CD, sebaiknya gunakan akun-akun yang telah dibuat melalui database seeder Laravel.
- Buat helper function (misal di `tests/e2e/utils/db-helpers.ts`) untuk mengambil informasi akun dari database pengujian jika diperlukan secara dinamis.
- Atau, untuk kecepatan ekstra, pastikan seeder memiliki data statis yang dapat diprediksi (contoh: `admin@tokokita.com`, `buyer@tokokita.com`) sehingga skrip Playwright tidak perlu selalu melakukan query database secara langsung hanya untuk mendapatkan username/password.

## 5. Page Object Model (POM)
Terapkan pola arsitektur **Page Object Model (POM)** untuk mengelola locator dan interaksi halaman web. Hal ini membuat kode pengujian lebih mudah dibaca, dikelola, dan mengurangi duplikasi.

Fokuskan pembuatan class Page Object pada halaman yang sering digunakan ulang (reusable), seperti:
- **Halaman Login**: Input email, input password, tombol login, dan notifikasi error.
- **Halaman Dashboard**: Elemen navigasi, menu sidebar, dan widget ringkasan akun.

Tempatkan file POM pada direktori khusus, misalnya `tests/e2e/pages/` (contoh: `tests/e2e/pages/LoginPage.ts`, `tests/e2e/pages/DashboardPage.ts`).

## 6. Cara Menjalankan Test

Berikut adalah beberapa perintah umum untuk menjalankan dan melakukan debugging pengujian e2e:

- **Jalankan seluruh test e2e:**
  ```bash
  npx playwright test
  ```
- **Jalankan satu file saja:**
  ```bash
  npx playwright test produk.spec.ts
  ```
- **Jalankan dengan tampilan browser terlihat (untuk debugging visual):**
  ```bash
  npx playwright test --headed
  ```
- **Jalankan satu test spesifik dalam mode debug interaktif:**
  ```bash
  npx playwright test --debug
  ```
- **Buka laporan HTML setelah eksekusi selesai:**
  ```bash
  npx playwright show-report docs/testing/playwright-report
  ```
- **Buka trace viewer untuk satu test yang gagal:**
  ```bash
  npx playwright show-trace test-results/produk-edit/trace.zip
  ```
