# Deskripsi Sistem: TokoKita

## 1. Pendahuluan
**TokoKita** adalah sebuah platform aplikasi web e-commerce yang dirancang khusus untuk memfasilitasi Usaha Mikro, Kecil, dan Menengah (UMKM). Platform ini memungkinkan pemilik usaha kecil untuk membuka toko online, mempublikasikan produk, mengelola operasional penjualan, serta menerima pembayaran dari pelanggan umum. Aplikasi ini dibangun menggunakan framework **Laravel 10** dan basis data **MySQL**.

## 2. Aktor / Pengguna Sistem
Sistem ini melibatkan tiga jenis pengguna utama (Roles):
1. **Admin Sistem (Superadmin)**: Mengawasi keseluruhan aktivitas platform, mengelola pengguna, dan memverifikasi toko UMKM.
2. **Pemilik Toko (Penjual / Seller)**: Pelaku UMKM yang memiliki dan mengelola toko online di platform TokoKita.
3. **Pembeli (Customer)**: Pengguna umum yang mencari, membeli produk, dan berinteraksi dengan toko-toko di dalam platform.

## 3. Kebutuhan Fungsional (Functional Requirements)

### 3.1. Modul Autentikasi & Otorisasi
- **Registrasi & Login**: Pengguna dapat mendaftar sebagai Pembeli atau mendaftar untuk membuka Toko.
- **Manajemen Profil**: Pengguna dapat mengubah data diri dan kata sandi.
- **Lupa Password**: Fasilitas reset password melalui email.

### 3.2. Modul Pemilik Toko (Seller Dashboard)
- **Pendaftaran Toko**: Pemilik usaha dapat membuat profil toko (nama toko, deskripsi, alamat, logo).
- **Manajemen Produk**: 
  - Menambahkan, mengedit, dan menghapus produk.
  - Mengelola stok barang, harga, deskripsi, dan foto produk.
- **Manajemen Pesanan**: 
  - Melihat daftar pesanan masuk.
  - Mengubah status pesanan (Menunggu Pembayaran, Diproses, Dikirim, Selesai).
  - Memasukkan nomor resi pengiriman.
- **Laporan & Analitik**: 
  - Melihat laporan pendapatan dan jumlah penjualan berdasarkan periode (harian, mingguan, bulanan).
  - Memantau produk paling laris (best seller).

### 3.3. Modul Pembeli (Customer)
- **Eksplorasi Produk**: Mencari produk berdasarkan nama, kategori, atau toko.
- **Keranjang Belanja (Cart)**: Menambah, mengubah kuantitas, atau menghapus produk di keranjang.
- **Checkout & Pembayaran**: 
  - Mengisi alamat pengiriman.
  - Memilih metode pengiriman dan pembayaran.
  - Mengunggah bukti pembayaran manual atau integrasi Payment Gateway.
- **Pelacakan Pesanan**: Melihat status riwayat pesanan (mulai dari belum dibayar hingga barang diterima).
- **Ulasan & Rating**: Memberikan nilai dan ulasan pada produk yang telah selesai dibeli.

### 3.4. Modul Admin Sistem
- **Dashboard Admin**: Ringkasan data keseluruhan (total pengguna, total toko, total transaksi).
- **Manajemen Pengguna & Toko**: Memblokir pengguna yang melanggar aturan, menyetujui/menolak pengajuan pembukaan toko baru.
- **Manajemen Kategori Global**: Menentukan kategori produk utama yang dapat dipilih oleh toko.

## 4. Kebutuhan Non-Fungsional (Non-Functional Requirements)
1. **Keamanan**: 
   - Autentikasi yang aman dengan enkripsi password.
   - Proteksi terhadap kerentanan web umum (CSRF, XSS, SQL Injection).
   - Akses kontrol (Middleware) yang ketat berdasarkan peran (Role-based access control).
2. **Performa**: 
   - Waktu respons (load time) yang cepat dengan implementasi caching dan optimasi query database.
3. **Antarmuka Pengguna (UI/UX)**: 
   - Desain responsif, mudah diakses melalui desktop maupun perangkat mobile (Mobile-First approach).
4. **Skalabilitas**: 
   - Struktur database yang dinormalisasi dan kode yang modular agar mudah dikembangkan di kemudian hari (misalnya penambahan integrasi kurir atau API pihak ketiga lainnya).

## 5. Ringkasan Arsitektur & Teknologi
- **Backend Framework**: Laravel 10 (PHP)
- **Database**: MySQL (Relational Database)
- **Arsitektur**: Model-View-Controller (MVC)
- **Frontend**: Blade Templating Engine (HTML, CSS, JavaScript) dipadukan dengan framework CSS modern untuk UI yang interaktif dan responsif.
