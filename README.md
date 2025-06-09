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

![WhatsApp Image 2025-06-09 at 11 49 05_5da0669c](https://github.com/user-attachments/assets/3001550d-7bfb-41a9-92e9-3621ddb6ede3)

2. Membuat Pengguna Baru
- Method: POST
- Endpoint: /users
- Contoh URL: http://localhost/response-api-sederhana/index.php?path=users
![WhatsApp Image 2025-06-09 at 11 46 51_bdcc49e1](https://github.com/user-attachments/assets/2cd93730-9f5b-463c-92dd-1f3a7ff89f71)

![WhatsApp Image 2025-06-09 at 11 50 07_2813872e](https://github.com/user-attachments/assets/8e52e6a6-42bd-4fdc-b1b5-ff2f6287e0b8)

3. Mengubah Data Pengguna(Update)
- Method: PUT
- Endpoint: /users
- Contoh URL: http://localhost/response-api-sederhana/index.php?path=users/6

![WhatsApp Image 2025-06-09 at 11 57 12_e2e2ecd2](https://github.com/user-attachments/assets/8349b8f3-3ed4-4b72-b463-39866209c047)
Setelah Method PUT di request maka perubahan dapat dilihat pada database
![WhatsApp Image 2025-06-09 at 11 57 58_10b20974](https://github.com/user-attachments/assets/4d5b304f-61c1-4c79-bb7c-0528b6e3e0f0)

4. Menghapus Data Pengguna
- Method: DELETE
- Endpoint: /users
- Contoh URL: http://localhost/response-api-sederhana/index.php?path=users/6

![WhatsApp Image 2025-06-09 at 11 58 58_7805701a](https://github.com/user-attachments/assets/82a88157-fb78-4768-8ae8-0452b777d6a4)
Setelah Method DELETE di request maka perubahan dapat dilihat pada database
![WhatsApp Image 2025-06-09 at 11 59 24_481d9854](https://github.com/user-attachments/assets/a3d1060b-0d59-491b-86e8-c1d7e9217e35)


