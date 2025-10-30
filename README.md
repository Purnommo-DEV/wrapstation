# Wrap Station Inspection Report
Sistem **Inspection Report** untuk **Wrap Station** – Generate PDF otomatis dengan foto mobil, checklist kondisi, dan tanda tangan digital.

## Teknologi yang Digunakan
| Komponen | Teknologi |
|--------|----------|
| Backend | Laravel 10+ |
| PDF Generator | [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) |
| Storage | Laravel Filesystem (`storage/app/public`) |
| Gambar | Konversi ke **Base64** (agar muncul di PDF) |
| Frontend | Blade + Bootstrap (opsional) |
| Database | MySQL |

## Cara Menjalankan Proyek

### 1. Clone & Install
git clone https://github.com/Purnommo-DEV/wrapstation.git
cd wrapstation
composer install
cp .env.example .env
php artisan key:generate

### 2. Setup Database
php artisan migrate

### 3. Storage Link
php artisan storage:link

### 4. Jalankan Server
php artisan serve

### 5. Akses
http://127.0.0.1:8000/wizard