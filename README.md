# Wrap Station Inspection Report
Sistem **Inspection Report** untuk **Wrap Station** – Generate PDF otomatis dengan foto mobil, checklist kondisi, dan tanda tangan digital.

## Prasyarat (WAJIB!)
> **Project ini menggunakan Laravel ^8.1**  
> Pastikan Anda menggunakan:
- PHP >= 8.1
- Composer
- Node.js & NPM (untuk Vite)
- MySQL

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
1. `git clone https://github.com/Purnommo-DEV/wrapstation.git`
2. `cd wrapstation`
3. `composer install`
4. `cp .env.example .env`
5. `php artisan key:generate`

### 2. Install & Jalankan Vite (Frontend)
1. `npm install`
2. `npm run dev`

### 3. Siapkan Database (WAJIB!)
# Edit .env → Sesuaikan DB_NAME, DB_USERNAME, DB_PASSWORD
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ws_db     # ← Buat dulu di MySQL
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Setup Database
`php artisan migrate`

### 5. Storage Link
`php artisan storage:link`

### 6. Jalankan Server
`php artisan serve`

### 7. Akses
http://127.0.0.1:8000/wizard