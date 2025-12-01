# Aplikasi Manajemen Buku (Laravel + Vue)

Aplikasi web full-stack sederhana untuk manajemen data buku. Proyek ini dibangun sebagai latihan untuk Ujian Akhir Semester (UAS) mata kuliah Pemrograman Berbasis Web, dengan backend API yang dibuat menggunakan **Laravel** dan frontend interaktif yang dibuat menggunakan **Vue.js**.

## 🌟 Fitur Utama

*   **Backend (projeklaravel):**
    *   RESTful API untuk operasi CRUD (Create, Read, Update, Delete) pada data buku.
    *   Manajemen data menggunakan Eloquent ORM.
    *   Sistem routing untuk endpoint API.
*   **Frontend (projekvue):**
    *   Single Page Application (SPA) yang responsif.
    *   Menampilkan, mencari, menambah, mengedit, dan menghapus data buku.
    *   Komunikasi dengan backend melalui Axios.
    *   Routing sisi klien dengan Vue Router.

## 🛠️ Teknologi yang Digunakan

*   **Backend:**
    *   [PHP](https://www.php.net/)
    *   [Laravel Framework](https://laravel.com/)
    *   [MySQL](https://www.mysql.com/)
*   **Frontend:**
    *   [Vue.js](https://vuejs.org/)
    *   [Vite](https://vitejs.dev/)
    *   [Vue Router](https://router.vuejs.org/)
    *   [Axios](https://axios-http.com/)

## 🚀 Panduan Instalasi & Menjalankan Proyek

Proyek ini terdiri dari dua bagian: backend (Laravel) dan frontend (Vue). Ikuti langkah-langkah di bawah ini untuk menjalankannya secara lokal.

### 1. Backend (projeklaravel)

```bash
# 1. Masuk ke direktori backend
cd projeklaravel

# 2. Install dependensi PHP dengan Composer
composer install

# 3. Salin file .env.example menjadi .env
cp .env.example .env

# 4. Buat application key baru
php artisan key:generate

# 5. Konfigurasi koneksi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=nama_database_anda
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi untuk membuat tabel di database
php artisan migrate

# 7. Jalankan server pengembangan Laravel (default di port 8000)
php artisan serve
```

### 2. Frontend (projekvue)

```bash
# 1. Buka terminal baru, masuk ke direktori frontend
cd projekvue

# 2. Install dependensi JavaScript dengan npm
npm install

# 3. Pastikan URL API di frontend sudah benar
#    (Biasanya diatur dalam komponen atau file service untuk menunjuk ke http://127.0.0.1:8000/api)

# 4. Jalankan server pengembangan Vite (default di port 5173)
npm run dev
```

Setelah kedua server berjalan, buka browser Anda dan akses alamat server frontend (misalnya `http://localhost:5173`).

---
