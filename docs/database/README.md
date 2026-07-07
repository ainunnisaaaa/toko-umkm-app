# Database Design: TokoKita E-Commerce

Dokumen ini menjelaskan struktur database aplikasi E-Commerce TokoKita berdasarkan perancangan UML di `docs/uml/class-diagram.puml`. Skema database didefinisikan secara lengkap dan dapat divisualisasikan dalam file `erd.dbml`.

## Konvensi yang Digunakan

Sesuai dengan standar dan best-practices framework **Laravel**:
- **Nama Tabel**: Menggunakan format *snake_case* jamak (*plural*), misalnya `users`, `products`, `orders`.
- **Primary Key**: Bernama `id` dengan tipe `bigint` (auto increment).
- **Foreign Key**: Menggunakan konvensi penamaan `nama_tabel_tunggal_id` (contoh: `user_id`, `product_id`) dengan tipe data `bigint`.
- **Timestamps**: Semua tabel utama (kecuali `password_reset_tokens`) memiliki kolom default `created_at` dan `updated_at`.
- **Soft Deletes**: Entitas transaksional dan penting seperti `users`, `stores`, `products`, dan `orders` ditambahkan kolom `deleted_at`. Hal ini mencegah kehilangan data historis (misal: pesanan masa lalu) jika toko atau produk dihapus oleh pemiliknya.

---

## Penjelasan Relasi Antar Tabel

1. **User dan Store (1 to 0..1)**
   - Seorang pengguna (`users`) dengan peran (role) 'Penjual' dapat memiliki maksimal satu entitas toko (`stores`).
   - Tabel `stores` menyimpan atribut `user_id` sebagai referensi *foreign key*.

2. **User dan PasswordResetToken (1 to 0..1)**
   - Saat proses Lupa Password, sistem meng-generate token yang disimpan pada tabel `password_reset_tokens`. Referensinya ditautkan melalui kolom `email`.

3. **Store dan Product (1 to Many)**
   - Sebuah toko (`stores`) dapat memiliki serta mengelola banyak produk (`products`). 
   - Kolom `store_id` berada di tabel `products` untuk mengidentifikasi toko penjual.

4. **Category dan Product (1 to Many)**
   - Kategori master secara global (`categories`) mencakup banyak produk.
   - Setiap produk menunjuk ke kategorinya melalui `category_id`.

5. **User dan Cart (1 to Many)**
   - Pembeli dapat mendaftarkan banyak produk di keranjangnya (`carts`).
   - Tabel keranjang ini menjadi tabel penghubung (*pivot like*) antara `users` dengan `products`, ditambah field `quantity`.

6. **User dan Wishlist (1 to Many)**
   - Pembeli dapat menambahkan banyak produk ke daftar keinginannya (`wishlists`).
   - Tabel ini menghubungkan `users` dengan `products` secara N:M (sebagai favorit), tanpa field tambahan.

7. **User, Store, dan Order (1 to Many)**
   - Seorang pembeli (`users`) dapat melakukan banyak pesanan (`orders`).
   - Sebuah toko (`stores`) juga menerima banyak pesanan masuk (`orders`).
   - Tabel pesanan menyertakan `user_id` (sebagai pembeli) sekaligus `store_id` (toko yang memproses). *Checkout multi-toko otomatis akan memecah pesanan berdasarkan `store_id`.*

8. **Order dan OrderItem (1 to Many)**
   - Satu nomor pesanan (`orders`) dapat mencakup banyak produk (`order_items`).
   - Tabel `order_items` mencatat relasi `order_id` dan `product_id`, serta 'membekukan' nominal `price` pada saat checkout agar riwayat harga tidak berubah ketika harga asli di tabel `products` diubah.

9. **Review dengan User, Product, dan Order (Many to 1)**
   - Tabel ulasan (`reviews`) dibuat berdasar transaksi riil. Setiap ulasan menunjuk ke pesanan spesifik (`order_id`), produk yang dibeli (`product_id`), dan ditulis oleh pembeli bersangkutan (`user_id`).

10. **ShippingRate (Master Data Standalone)**
    - Tabel tarif ongkos kirim (`shipping_rates`) bertindak sebagai referensi ongkir flat berdasarkan `province` dan `city`. Master data ini diakses saat checkout dan ditambahkan ke kalkulasi total pesanan.
