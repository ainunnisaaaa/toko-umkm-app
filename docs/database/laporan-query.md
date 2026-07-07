# Analisis Kebutuhan Query Laporan

Dokumen ini berisi analisis detail mengenai kebutuhan query untuk mendukung laporan-laporan pada sistem E-Commerce TokoKita (berdasarkan `docs/uml/use-case.puml`). Analisis ini mendasari keputusan untuk menambahkan index dan tabel summary ke dalam database.

## 1. Laporan Penjual (Seller Report)

Penjual membutuhkan laporan terkait performa toko mereka, yang mencakup laporan penjualan dan laporan stok.

### A. Laporan Penjualan Toko (Rentang Waktu: Harian / Bulanan)

- **Kebutuhan Data**: Total pendapatan (revenue), jumlah pesanan yang selesai, dan rincian produk yang terjual dalam rentang waktu tertentu.
- **Query Dasar (Tanpa Optimasi)**:
  ```sql
  SELECT 
      DATE(created_at) as report_date, 
      SUM(total_amount) as total_revenue, 
      COUNT(id) as total_orders
  FROM orders
  WHERE store_id = ? 
    AND status = 'Selesai'
    AND created_at BETWEEN ? AND ?
  GROUP BY DATE(created_at);
  ```
- **Bottleneck Potensial**: Query ini melakukan `SUM()` dan `COUNT()` pada tabel `orders`. Jika toko memiliki ribuan pesanan, pemindaian tabel `orders` setiap kali penjual melihat laporan akan memakan waktu, terutama jika tabel orders menjadi sangat besar.
- **Strategi Optimasi**:
  1. **Index**: Pembuatan index majemuk pada tabel `orders` untuk `(store_id, status, created_at)` akan mempercepat filter query secara signifikan sebelum masuk tahap agregasi.
  2. **Tabel Summary**: Untuk data masa lalu (historical), data yang sudah "Selesai" dapat diagregasi harian ke tabel `sales_summaries`. Laporan kemudian hanya perlu membaca tabel summary ini yang jumlah barisnya jauh lebih sedikit (1 baris per toko per hari).

### B. Laporan Stok Toko

- **Kebutuhan Data**: Daftar sisa stok masing-masing produk saat ini.
- **Query Dasar**:
  ```sql
  SELECT name, stock, base_price, discount_price 
  FROM products 
  WHERE store_id = ? AND deleted_at IS NULL;
  ```
- **Strategi Optimasi**: Query ini sangat ringan karena tidak melibatkan agregasi yang rumit. Index pada `products(store_id)` sudah cukup untuk menangani query ini dengan cepat. (Umumnya Foreign Key sudah secara otomatis mendapat index pada beberapa DBMS atau kita buat eksplisit).

## 2. Laporan Global Admin (Admin Report)

Admin membutuhkan laporan untuk memantau performa keseluruhan platform (Global Transaction).

### A. Laporan Transaksi Global

- **Kebutuhan Data**: Total transaksi seluruh platform, total pendapatan platform, komisi (bila ada) per rentang waktu.
- **Query Dasar (Tanpa Optimasi)**:
  ```sql
  SELECT 
      DATE(created_at) as report_date, 
      SUM(total_amount) as total_revenue, 
      COUNT(id) as total_orders
  FROM orders
  WHERE status = 'Selesai'
    AND created_at BETWEEN ? AND ?
  GROUP BY DATE(created_at);
  ```
- **Bottleneck Potensial**: Sama seperti laporan penjual, namun di tingkat yang jauh lebih masif karena mencakup seluruh pesanan di semua toko. Melakukan full-table scan dan agregasi `orders` sangat memberatkan database.
- **Strategi Optimasi**:
  1. **Index**: Pembuatan index pada `orders(status, created_at)` untuk mempercepat filter data yang disetujui saja berdasarkan waktu.
  2. **Tabel Summary**: Kita menggunakan tabel `sales_summaries`. Pada jadwal harian (misalnya lewat job *cron* malam hari), sistem menghitung total pendapatan global hari itu dan menyimpannya di `sales_summaries` dengan `store_id = NULL`. Saat admin melihat dashboard, data dibaca langsung dari summary.

## Tabel Summary: `sales_summaries`

Sebagai solusi utama untuk menghindari masalah performa pada pelaporan, dibuatlah tabel khusus untuk rekapitulasi penjualan harian.

**Skema Tabel**:
- `id` (bigint, PK)
- `store_id` (bigint, FK) -> Nullable, merepresentasikan *Platform* apabila diisi NULL.
- `report_date` (date) -> Tanggal rekapitulasi.
- `total_revenue` (decimal)
- `total_orders` (integer)
- `created_at`, `updated_at` (timestamps)

**Constraint**: Terdapat Unique Constraint pada gabungan kolom `(store_id, report_date)` agar tidak terjadi duplikasi rekap pada hari yang sama.
