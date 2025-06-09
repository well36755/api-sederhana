# api-service-sederhana-php
Ini adalah proyek API sederhana yang dibuat menggunakan PHP native untuk mengelola data pengguna (Users). API ini mendukung operasi CRUD (Create, Read, Update, Delete).

# Teknologi
- PHP 8.1
- Server Apache (via XAMPP)
- MySQL / MariaDB

# Instalasi
1. Clone repository ini: git clone https://...
2. Letakkan folder proyek di dalam www pada direktori Laragon Anda.
3. Buat database baru di phpMyAdmin dengan nama db_chatai.
4. Import file database.sql (jika ada) ke dalam database tersebut.
5. Sesuaikan koneksi database di dalam file config.php.
6. Jalankan server Apache dan MySQL melalui laragon Control Panel.
7. API siap diakses melalui [http://localhost/response-api-sederhana/.](https://github.com/well36755/api-sederhana)

# Endpoints API

1. Mendapatkan Semua Pengguna
- Method: GET
- Endpoint: /users
- Contoh URL: http://localhost/response-api-sederhana/index.php?path=users
