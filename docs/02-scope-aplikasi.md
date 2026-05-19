# Batasan dan Ruang Lingkup Sistem (Scope Aplikasi)

## 1. Pendahuluan
Dokumen ini mendefinisikan batasan masalah dan ruang lingkup pengembangan sistem **TokoKita** agar realistis untuk diselesaikan dalam jangka waktu pengerjaan skripsi (1 semester atau sekitar 4-6 bulan). Fokus pengembangan ditekankan pada penyelesaian alur bisnis e-commerce secara mandiri, pengelolaan relasi data yang cukup kompleks, serta penyediaan modul pelaporan yang komprehensif bagi manajerial, tanpa terjebak pada kendala integrasi layanan pihak ketiga yang sering kali tidak stabil atau berbayar.

## 2. Ruang Lingkup yang Dikerjakan (In-Scope)
Pengembangan sistem akan mencakup fitur-fitur berikut:
1. **Manajemen Hak Akses & Pengguna (RBAC)**: Pengelolaan peran Superadmin, Penjual (Pemilik Toko), dan Pembeli menggunakan Middleware Laravel.
2. **Modul Manajemen Toko & Produk (Kompleks)**:
   - Pengelolaan profil toko.
   - Manajemen produk dengan kategori berjenjang (Sub-kategori).
   - Pengelolaan manajemen stok dasar (pemasukan dan pengurangan otomatis saat checkout).
   - Pengelolaan diskon/potongan harga per produk.
3. **Modul Pemrosesan Transaksi**:
   - Keranjang belanja (Cart) yang bisa menampung produk dari berbagai toko (multi-toko checkout).
   - Checkout pesanan dengan pemisahan tagihan berdasarkan masing-masing toko.
   - Pemilihan ongkos kirim menggunakan sistem **ongkir flat/statis per kota** (master data dikelola manual oleh admin).
   - Pembayaran menggunakan sistem **Upload Bukti Transfer Manual** yang diverifikasi oleh toko/admin.
4. **Modul Pelaporan & Dashboard**: Fokus utama sebagai nilai tambah skripsi, menampilkan analitik data operasional dalam berbagai format.

## 3. Ruang Lingkup yang Tidak Dikerjakan (Out-of-Scope)
Untuk menjaga agar skripsi selesai tepat waktu, hal-hal berikut **tidak akan** diimplementasikan:
1. **Integrasi Payment Gateway Otomatis**: (Misal: Midtrans, Xendit, Stripe). Pembayaran cukup disimulasikan melalui upload bukti transfer.
2. **Integrasi API Ekspedisi Kurir**: (Misal: RajaOngkir, pengiriman real-time). Ongkir dibuat statis berdasarkan tabel wilayah di database lokal.
3. **Aplikasi Mobile Native**: (Android/iOS). Sistem hanya berbasis aplikasi Web, namun antarmukanya dibuat responsif agar nyaman dibuka dari *browser handphone* pembeli.
4. **Fitur Real-Time Chat**: Tidak ada fitur chatting langsung antar penjual dan pembeli (membutuhkan websocket).

## 4. Modul Pelaporan & Analitik (Minimal 10 Laporan)
Sistem akan menyediakan minimal 10 jenis laporan dengan format yang bervariasi (Dashboard, Grafik, Cetak/PDF, dan Export Excel) untuk memenuhi standar kerumitan skripsi:

1. **Dashboard Kinerja Penjualan Utama**
   - *Format*: Visual Dashboard (Web), *Line Chart* & *Cards*.
   - *Isi*: Tren pendapatan harian dan bulanan secara grafis, serta ringkasan angka total penjualan.
2. **Dashboard Distribusi Status Pesanan**
   - *Format*: Visual Dashboard (Web), *Pie/Donut Chart*.
   - *Isi*: Proporsi pesanan dengan status 'Menunggu Pembayaran', 'Diproses', 'Dikirim', dan 'Selesai'.
3. **Laporan Top 10 Produk Terlaris (Best Sellers)**
   - *Format*: Visual Grafik (*Bar Chart*) dan Cetak (PDF).
   - *Isi*: Peringkat 10 produk dengan kuantitas penjualan tertinggi dalam periode tertentu.
4. **Laporan Rekapitulasi Penjualan Harian/Bulanan**
   - *Format*: Cetak (PDF).
   - *Isi*: Tabel rapi berisi daftar semua transaksi berhasil, nama pembeli, tanggal, dan total nominal, yang siap diserahkan kepada pimpinan/pemilik toko.
5. **Laporan Detail Transaksi & Omset**
   - *Format*: Export *Spreadsheet* (Excel / CSV).
   - *Isi*: Data mentah seluruh transaksi lengkap dengan ongkir, diskon, dan subtotal yang dapat diolah lebih lanjut oleh akuntan menggunakan rumus Excel.
6. **Laporan Pergerakan & Kartu Stok Barang**
   - *Format*: Export Excel & Cetak PDF.
   - *Isi*: Riwayat barang masuk (penambahan manual) dan barang keluar (akibat penjualan), serta sisa stok akhir bulan untuk keperluan audit gudang.
7. **Laporan Kinerja / Rating Toko**
   - *Format*: Tabel interaktif di Web & Export Excel.
   - *Isi*: Rekapitulasi nilai ulasan (bintang) rata-rata per toko, persentase pesanan selesai dibandingkan yang dibatalkan (khusus untuk pantauan Admin Sistem).
8. **Laporan Riwayat Pembelian Pelanggan**
   - *Format*: Cetak PDF.
   - *Isi*: Rincian pembelanjaan seorang customer spesifik dari waktu ke waktu, digunakan untuk melihat *customer loyalty*.
9. **Laporan Potongan Pendapatan / Komisi Platform**
   - *Format*: Export Excel.
   - *Isi*: Kalkulasi tagihan komisi (misal: 2% dari total penjualan) yang harus dibayarkan oleh toko kepada platform TokoKita (Admin), berdasarkan transaksi yang berstatus selesai.
10. **Cetak Invoice / Bukti Pembelian**
    - *Format*: Cetak Langsung (Print) / Simpan ke PDF.
    - *Isi*: Faktur standar per transaksi berisi kop toko, daftar item, harga satuan, dan total bayar. Berfungsi sebagai bukti sah bagi pelanggan dan penjual.

## 5. Kesimpulan
Ruang lingkup ini sangat ideal untuk pengerjaan skripsi 1 semester. Sistem tetap kompleks dari sisi struktur basis data (relasi antar toko, kategori, produk, pesanan, dan detail pesanan) serta logika bisnis operasionalnya. Titik berat nilai skripsi ditunjukkan melalui kematangan **Modul Pelaporan** yang dapat menyajikan data dari berbagai dimensi dan dalam berbagai format output (Grafik visual, Excel, PDF), yang mana hal tersebut sangat disukai dalam sidang pengujian skripsi untuk mendemonstrasikan sistem yang *applicable* bagi manajemen bisnis nyata.
