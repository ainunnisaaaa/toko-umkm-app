---
name: Database Seed Laporan Workflow
description: Menjalankan query SQL untuk menghitung dan mengisi tabel sales_summaries (laporan) berdasarkan data transaksi di tabel orders dan order_items.
---

# Workflow: Database Seed Laporan

Workflow ini bertujuan untuk mem-populasi tabel `sales_summaries` dengan data rekapitulasi penjualan (summary). Data ini dihitung secara dinamis dari riwayat transaksi yang sudah ada di dalam tabel `orders` dan `order_items`.

## Langkah-langkah Eksekusi:

1. **Jalankan Laravel Tinker**
   Kita akan menggunakan fitur Tinker bawaan dari Laravel untuk mengeksekusi raw query SQL langsung ke database:
   ```bash
   php artisan tinker
   ```

2. **Eksekusi Query untuk Laporan Penjual (Seller Summary)**
   Jalankan query berikut di dalam Tinker. Query ini akan melakukan *JOIN* antara tabel `orders` dan `order_items` untuk menghitung total pendapatan (revenue) dari item yang terjual, serta menghitung jumlah pesanan unik per toko per hari.
   
   ```php
   DB::statement("
       INSERT INTO sales_summaries (store_id, report_date, total_revenue, total_orders, created_at, updated_at)
       SELECT 
           o.store_id,
           DATE(o.created_at) as report_date,
           SUM(oi.price * oi.quantity) as total_revenue,
           COUNT(DISTINCT o.id) as total_orders,
           NOW(),
           NOW()
       FROM orders o
       JOIN order_items oi ON o.id = oi.order_id
       WHERE o.status = 'Selesai'
       GROUP BY o.store_id, DATE(o.created_at)
       ON DUPLICATE KEY UPDATE 
           total_revenue = VALUES(total_revenue),
           total_orders = VALUES(total_orders),
           updated_at = NOW();
   ");
   ```

3. **Eksekusi Query untuk Laporan Global Admin (Platform Summary)**
   Selanjutnya, jalankan query berikut untuk merekapitulasi keseluruhan pendapatan platform (tanpa membedakan `store_id`) dengan menyetel `store_id = NULL`:

   ```php
   DB::statement("
       INSERT INTO sales_summaries (store_id, report_date, total_revenue, total_orders, created_at, updated_at)
       SELECT 
           NULL as store_id,
           DATE(o.created_at) as report_date,
           SUM(oi.price * oi.quantity) as total_revenue,
           COUNT(DISTINCT o.id) as total_orders,
           NOW(),
           NOW()
       FROM orders o
       JOIN order_items oi ON o.id = oi.order_id
       WHERE o.status = 'Selesai'
       GROUP BY DATE(o.created_at)
       ON DUPLICATE KEY UPDATE 
           total_revenue = VALUES(total_revenue),
           total_orders = VALUES(total_orders),
           updated_at = NOW();
   ");
   ```
   *(Catatan: Sintaks `ON DUPLICATE KEY UPDATE` adalah standar untuk MySQL/MariaDB agar mendukung skenario di mana rekapan pada hari yang sama diperbarui/ditimpa alih-alih menyebabkan error unique constraint).*

4. **Verifikasi Hasil Seed Laporan**
   Pastikan data rekapitulasi berhasil masuk ke tabel `sales_summaries` dengan menjalankan beberapa baris berikut di Tinker:
   ```php
   // Menghitung total data summary
   echo 'Total Summaries: ' . \App\Models\SalesSummary::count() . PHP_EOL;

   // Melihat summary spesifik penjual
   $sellerSummaries = \App\Models\SalesSummary::whereNotNull('store_id')->get();
   echo 'Seller Summaries Count: ' . $sellerSummaries->count() . PHP_EOL;

   // Melihat summary global admin
   $adminSummaries = \App\Models\SalesSummary::whereNull('store_id')->get();
   echo 'Admin Summaries Count: ' . $adminSummaries->count() . PHP_EOL;
   ```

5. **Laporan Hasil**
   Setelah eksekusi berhasil, tutup Tinker (ketik `exit`) dan laporkan hasilnya dengan format:
   - **Status Eksekusi**: Status keberhasilan dari command SQL.
   - **Total Record Summary**: Berapa banyak baris data di `sales_summaries` untuk toko dan untuk admin (platform global) yang telah dihitung dan berhasil disisipkan.
