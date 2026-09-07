# PHP to Laravel: Backend Developer Journey

Repositori ini adalah catatan perjalanan komprehensif saya belajar *backend development* dari nol (Native PHP) hingga membangun sistem *manajemen-pegawai* menggunakan Laravel 11.

## Struktur Repositori

Pembelajaran dipecah ke dalam beberapa fase direktori agar sistematis:

*   **`01-php-dasar`**: Fondasi sintaks PHP murni, manipulasi tipe data, perulangan, dan fungsi.
*   **`02-php-database-pdo`**: Implementasi koneksi MariaDB menggunakan PDO dan *prepared statements* untuk keamanan dari SQL Injection.
*   **`03-php-oop-logic`**: Konsep Pemrograman Berorientasi Objek (Class, Inheritance, Visibility, Namespace).
*   **`04-php-mvp-native`**: Pembuatan mini project CRUD dan Login murni tanpa *framework*.
*   **`05-laravel-basics`**: Aplikasi Sistem Manajemen Pegawai (Web & REST API) yang dilengkapi Laravel Sanctum, Role-Based Access Control (Gate), dan Soft Deletes.

## Tech Stack & Tools
*   **Bahasa & Framework:** PHP 8.3, Laravel 11
*   **Database:** MariaDB
*   **Security:** Laravel Sanctum (Token Auth), Password Hashing, CSRF Protection
*   **Environment:** Kali Linux Native Setup
*   **API Testing:** Postman

## Cara Menjalankan Project

Karena repositori ini berisi project Native dan Laravel, cara menjalankannya berbeda tergantung foldernya.

**Untuk PHP Native (Folder 01 - 04):**
1. Clone repositori: `git clone https://github.com/husnifatah-dev/php-journey.git`
2. Masuk ke folder tujuan, misal: `cd 04-php-mvp-native`
3. Jalankan server bawaan PHP: `php -S localhost:8000`
4. Buka browser: `http://localhost:8000`

**Untuk Laravel (Folder 05):**
1. Masuk ke folder Laravel: `cd 05-laravel-basics`
2. Install dependensi: `composer install`
3. Gandakan konfigurasi: `cp .env.example .env` (sesuaikan kredensial database)
4. Generate key: `php artisan key:generate`
5. Jalankan migrasi: `php artisan migrate`
6. Nyalakan server: `php artisan serve`

## Catatan Perjalanan
Konsisten membangun *micro-habits* koding setiap hari. Progress sekecil apapun lebih penting daripada kesempurnaan.