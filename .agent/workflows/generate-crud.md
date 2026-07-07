---
name: Generate CRUD Workflow
description: Otomatisasi pembuatan komponen CRUD (Migration, Model, Controller, Request, Route, View) untuk entitas baru yang konsisten dengan standar TokoKita.
---

# Generate CRUD Workflow

Workflow ini memandu agen dalam membuat sistem CRUD yang lengkap untuk sebuah entitas, menjaga konsistensi dengan struktur dan standar yang sudah ada di proyek `toko-umkm-app`.

## Input yang Dibutuhkan
Saat menjalankan workflow ini, pastikan Anda mengetahui:
1. **Nama Entitas (Model)**: Contoh: `ProductCategory`, `Voucher`
2. **Nama Tabel**: Contoh: `product_categories`, `vouchers`
3. **Role Akses (Namespace/Prefix)**: Contoh: `Admin`, `Seller`, atau `Buyer`

## Langkah 1: Buat Migration
1. Jalankan perintah artisan untuk membuat migration:
   ```bash
   php artisan make:migration create_[nama_tabel]_table
   ```
2. Buka file migration yang baru dibuat di `database/migrations/`.
3. Definisikan kolom-kolom tabel sesuai dengan struktur database/ERD (lihat dokumentasi atau file DBML jika ada). Gunakan skill **Laravel Migration Generator** jika perlu.

## Langkah 2: Buat Model
1. Jalankan perintah artisan:
   ```bash
   php artisan make:model [NamaModel]
   ```
2. Buka file model di `app/Models/`.
3. Terapkan konvensi dari skill **Laravel Model Convention**:
   - Definisikan properti `$fillable`.
   - Tambahkan `$casts` jika diperlukan (misal untuk tipe data `boolean` atau `datetime`).
   - Definisikan metode relasi (seperti `belongsTo`, `hasMany`) dengan return type hints (`BelongsTo`, `HasMany`, dll.).

## Langkah 3: Buat Form Request
1. Jalankan perintah artisan untuk membuat request validation:
   ```bash
   php artisan make:request Store[NamaModel]Request
   php artisan make:request Update[NamaModel]Request
   ```
2. Buka file request di `app/Http/Requests/`.
3. Ubah metode `authorize()` menjadi `return true;`.
4. Definisikan aturan validasi (rules) pada metode `rules()`.

## Langkah 4: Buat Controller
1. Buat resource controller dengan namespace role yang sesuai:
   ```bash
   php artisan make:controller [Role]/[NamaModel]Controller --resource --model=[NamaModel]
   ```
2. Buka controller di `app/Http/Controllers/[Role]/`.
3. Sesuaikan import model dan Form Request (`Store[NamaModel]Request`, `Update[NamaModel]Request`).
4. Implementasikan metode CRUD:
   - `index()`: Ambil data (biasanya dengan pagination `paginate(10)`) dan return view `[role].[tabel].index`.
   - `create()`: Return view `[role].[tabel].create`.
   - `store()`: Validasi request `$request->validated()`, `Model::create()`, redirect dengan pesan sukses (flash message).
   - `show()`: Return view `[role].[tabel].show`.
   - `edit()`: Return view `[role].[tabel].edit`.
   - `update()`: Validasi request, `Model->update()`, redirect dengan pesan sukses.
   - `destroy()`: `Model->delete()`, redirect dengan pesan sukses.

## Langkah 5: Daftarkan Route
1. Buka file `routes/web.php`.
2. Tambahkan statement `use` untuk controller yang baru dibuat di bagian atas file, di bawah komentar `// [Role] Controllers`.
3. Temukan blok route middleware group untuk role yang sesuai (contoh: `Route::middleware(['auth', 'role:admin'])->prefix('admin')->...`).
4. Daftarkan resource route di dalam blok tersebut:
   ```php
   Route::resource('[nama_tabel_atau_url]', [NamaModel]Controller::class);
   ```

## Langkah 6: Buat View CRUD (Blade + Tailwind CSS)
1. Buat folder untuk view di `resources/views/[role]/[nama_tabel]/`.
2. Buat empat file Blade: `index.blade.php`, `create.blade.php`, `edit.blade.php`, dan `show.blade.php`.
3. Gunakan `<x-app-layout>` sebagai master layout, dengan `<x-slot name="header">`.
4. Konsisten dengan styling Tailwind CSS (gunakan elemen UI dari template yang sudah ada, misalnya di `resources/views/admin/categories/`):
   - **Index**: Gunakan tabel HTML dengan style tailwind (`min-w-full divide-y divide-gray-200`), tombol Edit/Hapus, dan support pagination.
   - **Create / Edit**: Gunakan form dengan input ter-style (`border-gray-300 rounded-md focus:ring-indigo-500`), validasi error `@error`, dan tombol submit (`bg-indigo-600 text-white`).
   - **Show**: Tampilkan data dengan layout card yang rapi dan tombol 'Kembali'.

## Verifikasi
Setelah semua langkah selesai:
1. Jalankan `php artisan migrate` (jika belum dijalankan).
2. Periksa kembali UI aplikasi pada browser untuk memastikan tidak ada error syntax.
3. Lakukan tes manual (Create, Read, Update, Delete) pada fitur yang baru dibuat.
