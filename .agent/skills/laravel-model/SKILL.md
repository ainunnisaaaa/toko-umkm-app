---
name: Laravel Model Convention
description: Panduan dan konvensi pembuatan file model Eloquent di proyek TokoKita, termasuk fillable, casts, dan penulisan relasi.
---

# Konvensi Model Eloquent

Saat membuat atau mengedit model Eloquent di proyek TokoKita, ikuti konvensi dan pola yang sudah diterapkan:

## 1. Struktur Dasar
- Gunakan `namespace App\Models;`.
- Impor `Illuminate\Database\Eloquent\Factories\HasFactory` dan `Illuminate\Database\Eloquent\Model`.
- Pastikan class model menggunakan trait `HasFactory` di dalam class.

## 2. Properti `$fillable`
- Definisikan secara eksplisit properti `protected $fillable`.
- Daftarkan semua kolom yang dapat diisi melalui mass assignment dalam satu array. Usahakan ringkas, jika memungkinkan dalam satu baris.

## 3. Properti `$casts`
- Gunakan properti `protected $casts` untuk memastikan nilai yang diambil dari database diubah menjadi tipe data asli (native types) yang tepat.
- Kolom harga atau nilai uang harus dicast menjadi `decimal:2` (misalnya `base_price`, `subtotal`, `total_amount`).
- Kolom boolean harus dicast menjadi `boolean` (misalnya `is_active`).
- Kolom angka desimal selain uang dicast menjadi `float` (misalnya `rating`).

## 4. Penulisan Relasi
- Relasi didefinisikan sebagai fungsi `public`.
- Kembalikan langsung panggilan relasinya seperti `$this->belongsTo(...)` atau `$this->hasMany(...)`.
- **Penting:** Penulisan fungsi relasi dibuat **sebaris (inline)** untuk setiap relasi agar rapi dan ringkas, terutama ketika model memiliki banyak relasi.

## Contoh Implementasi

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['store_id', 'category_id', 'name', 'description', 'base_price', 'is_active', 'rating'];
    protected $casts = ['base_price' => 'decimal:2', 'is_active' => 'boolean', 'rating' => 'float'];

    public function store() { return $this->belongsTo(Store::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
}
```
