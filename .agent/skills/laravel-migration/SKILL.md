---
name: Laravel Migration Generator
description: Memandu agent dalam membuat file migration Laravel 10 yang konsisten dengan ERD di docs/database/erd.dbml.
---

# Panduan Pembuatan Migration Laravel 10

Skill ini digunakan untuk memandu proses pembuatan file migration Laravel 10 agar selaras dan konsisten dengan ERD proyek yang terletak di `docs/database/erd.dbml`.

## Aturan Utama

1. **Pahami ERD**: Selalu periksa dan rujuk file `docs/database/erd.dbml` sebelum membuat migration.
2. **Urutan Migration (Dependency-based)**:
   - File migration harus dibuat berdasarkan urutan dependensi agar tidak error saat `php artisan migrate`. Tabel independen (tidak memiliki foreign key) dibuat lebih dulu.
   - **Tabel Independen**: `users`, `password_reset_tokens`, `categories`, `shipping_rates`.
   - **Tabel Level 1**: `stores` (tergantung pada `users`).
   - **Tabel Level 2**: `products` (tergantung pada `stores` dan `categories`).
   - **Tabel Level 3**: `carts`, `orders` (tergantung pada `users`, `stores`, `products`).
   - **Tabel Level 4**: `order_items`, `reviews` (tergantung pada `orders`, `products`, `users`).
3. **Pemetaan Tipe Data MySQL**:
   - `bigint [primary key, increment]` -> `$table->id();`
   - `varchar` -> `$table->string('column_name');`
   - `text` -> `$table->text('column_name');`
   - `integer` -> `$table->integer('column_name');`
   - `decimal(X, Y)` -> `$table->decimal('column_name', X, Y);`
   - `boolean` -> `$table->boolean('column_name');`
4. **Foreign Key**:
   - Gunakan pendekatan konvensi Laravel 10 terbaru:
     `$table->foreignId('table_id')->constrained('tables')->cascadeOnDelete();`
   - Jika foreign key mengizinkan nilai `null`:
     `$table->foreignId('table_id')->nullable()->constrained('tables')->nullOnDelete();`
5. **Timestamps**:
   - Gunakan `$table->timestamps();` untuk kolom `created_at` dan `updated_at`.
   - Jika hanya ada `created_at` (seperti pada tabel `password_reset_tokens`), gunakan `$table->timestamp('created_at')->nullable();`.
6. **Soft Deletes**:
   - Apabila tabel dalam DBML memiliki note `deleted_at timestamp // Laravel Soft Delete`, maka tambahkan `$table->softDeletes();` pada struktur tabel.
7. **Index & Constraints**:
   - Tambahkan `->unique()` jika terdapat flag `[unique]`.
   - Tambahkan nilai default menggunakan `->default(value)` jika terdapat tag `[default: value]`.
   - Gunakan comment untuk enum dan catatan lain: `->comment('Enum: ...')`.

## Contoh Pola Migration

### 1. Tabel Master/Independen (Contoh: `users`)

Tabel independen tidak memiliki foreign key. Bisa juga memiliki soft delete.

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->string('role')->comment('Enum: Admin, Penjual, Pembeli');
    $table->boolean('is_active')->default(true);
    $table->timestamps();
    $table->softDeletes();
});
```

### 2. Tabel Transaksi / Bergantung (Contoh: `orders`)

Tabel transaksi umumnya bergantung pada banyak tabel dan berpotensi memiliki soft delete.

```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
    $table->decimal('subtotal', 12, 2);
    $table->decimal('shipping_cost', 12, 2);
    $table->decimal('total_amount', 12, 2);
    $table->string('status')->comment('Enum: Menunggu Pembayaran, Menunggu Verifikasi, Diproses, Dikirim, Selesai, Dibatalkan');
    $table->string('payment_proof')->nullable();
    $table->string('receipt_number')->nullable();
    $table->text('shipping_address');
    $table->timestamps();
    $table->softDeletes();
});
```

### 3. Tabel Pivot/Detail (Contoh: `order_items`)

Tabel detail dari suatu transaksi yang memuat foreign key ke lebih dari 1 tabel.

```php
Schema::create('order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
    $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
    $table->integer('quantity');
    $table->decimal('price', 12, 2);
    $table->timestamps();
});
```

### 4. Tabel dengan Index Komposit

Jika ada tabel yang memerlukan keunikan dari kombinasi 2 kolom (contoh: 1 user hanya bisa me-review 1 product 1 kali - meskipun ini opsional di DBML, ini adalah contoh penerapannya):

```php
Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
    $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->integer('rating');
    $table->text('comment');
    $table->timestamps();
    
    // Index komposit (Contoh index gabungan agar user_id dan product_id harus unique jika dibutuhkan)
    // $table->unique(['user_id', 'product_id']);
});
```
