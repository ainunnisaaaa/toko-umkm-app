---
name: Database Reset Workflow
description: Menjalankan php artisan migrate:fresh --seed dan memverifikasi pembuatan tabel serta jumlah record.
---

# Workflow: Database Reset & Verification

Workflow ini bertujuan untuk me-reset database (menjalankan migration dari awal dan men-seed data) lalu memverifikasi bahwa proses tersebut berhasil dan menghasilkan data yang sesuai.

## Langkah-langkah:

1. **Reset dan Seed Database**
   Jalankan command berikut di terminal:
   ```bash
   php artisan migrate:fresh --seed
   ```
   Pastikan command berhasil dieksekusi tanpa error.

2. **Verifikasi Tabel yang Dibuat**
   Gunakan command untuk melihat daftar tabel di database:
   ```bash
   php artisan db:show
   ```
   Pastikan semua tabel sesuai dengan schema (ERD) berhasil terbuat.

3. **Verifikasi Jumlah Record per Tabel**
   Periksa jumlah record pada setiap tabel yang telah di-seed. Gunakan command `php artisan tinker` atau query langsung untuk menghitung jumlah record dari masing-masing model.
   
   Contoh menggunakan Tinker:
   ```bash
   php artisan tinker --execute="
   echo 'Sellers: ' . \App\Models\Seller::count() . PHP_EOL;
   echo 'Buyers: ' . \App\Models\Buyer::count() . PHP_EOL;
   echo 'Products: ' . \App\Models\Product::count() . PHP_EOL;
   echo 'Orders: ' . \App\Models\Order::count() . PHP_EOL;
   "
   ```
   *(Sesuaikan model dengan struktur yang ada di dalam aplikasi).*

4. **Laporan Hasil**
   Laporkan hasil eksekusi ini dengan format:
   - **Status Eksekusi**: Status keberhasilan dari command `migrate:fresh --seed`.
   - **Verifikasi Tabel**: Konfirmasi bahwa tabel-tabel telah dibuat sesuai ekspektasi.
   - **Jumlah Record**: Tabel berisi nama tabel/model dan total data yang berhasil di-seed.
