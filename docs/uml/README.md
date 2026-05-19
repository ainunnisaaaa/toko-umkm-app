# Kumpulan UML Diagram Sistem TokoKita

Dokumen ini berisi daftar keseluruhan Activity, Sequence, dan Class Diagram yang diturunkan dari Use Case Diagram sistem e-commerce TokoKita. Diagram ini menggambarkan alur kerja, interaksi komponen, serta struktur data dari setiap fungsi utama sistem.

## Class Diagram (Arsitektur Data & Entitas)
- [class-diagram.puml](class-diagram.puml) : Diagram kelas yang menyintesis seluruh struktur model, atribut, method operasional, dan relasi antar entitas (seperti User, Store, Product, Order, dll).

## Modul Autentikasi
1. [activity-registrasi-akun.puml](activity-registrasi-akun.puml) | [sequence-registrasi-akun.puml](sequence-registrasi-akun.puml) : Alur pendaftaran bagi Guest.
2. [activity-login.puml](activity-login.puml) | [sequence-login.puml](sequence-login.puml) : Alur autentikasi dan penentuan Role.
3. [activity-reset-password.puml](activity-reset-password.puml) | [sequence-reset-password.puml](sequence-reset-password.puml) : Alur pemulihan kata sandi.

## Modul Pembeli
4. [activity-cari-produk.puml](activity-cari-produk.puml) | [sequence-cari-produk.puml](sequence-cari-produk.puml) : Alur mencari dan melihat detail produk.
5. [activity-kelola-keranjang.puml](activity-kelola-keranjang.puml) | [sequence-kelola-keranjang.puml](sequence-kelola-keranjang.puml) : Alur menambah dan mengubah barang di keranjang belanja.
6. [activity-checkout-pesanan.puml](activity-checkout-pesanan.puml) | [sequence-checkout-pesanan.puml](sequence-checkout-pesanan.puml) : Alur terpadu untuk melakukan checkout, memilih tarif ongkir, hingga mengunggah bukti pembayaran manual.
7. [activity-lacak-pesanan.puml](activity-lacak-pesanan.puml) | [sequence-lacak-pesanan.puml](sequence-lacak-pesanan.puml) : Alur melihat riwayat dan status pesanan.
8. [activity-ulasan-rating.puml](activity-ulasan-rating.puml) | [sequence-ulasan-rating.puml](sequence-ulasan-rating.puml) : Alur memberikan ulasan pada pesanan yang telah selesai.
9. [activity-cetak-invoice.puml](activity-cetak-invoice.puml) | [sequence-cetak-invoice.puml](sequence-cetak-invoice.puml) : Alur mengunduh faktur transaksi.

## Modul Penjual
10. [activity-kelola-profil-toko.puml](activity-kelola-profil-toko.puml) | [sequence-kelola-profil-toko.puml](sequence-kelola-profil-toko.puml) : Alur mengatur profil toko.
11. [activity-kelola-produk.puml](activity-kelola-produk.puml) | [sequence-kelola-produk.puml](sequence-kelola-produk.puml) : Alur menambah, mengedit, dan menghapus produk serta diskon.
12. [activity-proses-pesanan.puml](activity-proses-pesanan.puml) | [sequence-proses-pesanan.puml](sequence-proses-pesanan.puml) : Alur memverifikasi bukti bayar, memproses barang, dan memperbarui pengiriman.
13. [activity-laporan-penjual.puml](activity-laporan-penjual.puml) | [sequence-laporan-penjual.puml](sequence-laporan-penjual.puml) : Alur melihat dashboard dan mencetak/mengekspor laporan (Excel/PDF).

## Modul Admin Sistem
14. [activity-kelola-pengguna.puml](activity-kelola-pengguna.puml) | [sequence-kelola-pengguna.puml](sequence-kelola-pengguna.puml) : Alur memblokir atau menyetujui akun pengguna/toko.
15. [activity-kelola-kategori.puml](activity-kelola-kategori.puml) | [sequence-kelola-kategori.puml](sequence-kelola-kategori.puml) : Alur mengelola daftar kategori global.
16. [activity-kelola-ongkir.puml](activity-kelola-ongkir.puml) | [sequence-kelola-ongkir.puml](sequence-kelola-ongkir.puml) : Alur mengelola tarif ongkir manual.
17. [activity-laporan-admin.puml](activity-laporan-admin.puml) | [sequence-laporan-admin.puml](sequence-laporan-admin.puml) : Alur melihat ringkasan platform dan mengunduh laporan global.
