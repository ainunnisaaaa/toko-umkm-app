---
name: "Run Scheduler Workflow"
description: "Menjalankan Laravel scheduler secara manual untuk menguji artisan command summary."
---

# Panduan Pengujian Scheduler dan Summary Command

Workflow ini akan memandu Anda untuk menguji artisan command `summary` dan Laravel Scheduler di proyek TokoKita.

## 1. Menguji Command Secara Langsung
Artisan command `summary` dirancang untuk berjalan otomatis, namun Anda dapat mengujinya secara manual dengan menentukan tanggal.

Jalankan perintah berikut di terminal:
```bash
php artisan summary
```
Atau dengan tanggal spesifik:
```bash
php artisan summary --date="2026-07-08"
```
Periksa database pada tabel `sales_summaries` untuk memastikan data telah ditambahkan/diperbarui.

## 2. Menguji Scheduler
Perintah `summary` telah dijadwalkan untuk berjalan setiap pukul `01:00` dini hari. Untuk menguji apakah scheduler berfungsi di environment lokal, Anda bisa menggunakan dua cara.

### Cara 2.1: Menjalankan Scheduler Work (Background)
Gunakan perintah ini untuk membiarkan Laravel memantau jadwal. Perintah ini ideal untuk proses development.
```bash
php artisan schedule:work
```
*(Buka tab terminal baru karena perintah ini akan terus berjalan).*

### Cara 2.2: Mengeksekusi Jadwal Sekali Jalan (Cron equivalent)
Jika Anda hanya ingin mengeksekusi apa saja yang jatuh tempo saat ini:
```bash
php artisan schedule:run
```
*(Catatan: Perintah `summary` mungkin tidak tereksekusi dengan cara ini jika jam komputer Anda tidak menunjukkan pukul 01:00).*
