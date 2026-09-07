# Sistem Manajemen Pegawai Pabrik 

Aplikasi berbasis web dan REST API yang dikembangkan menggunakan **Laravel 11**. Sistem ini dirancang untuk memanajemen data karyawan, shift kerja, departemen, dan pengelolaan akses tingkat lanjut.

## Fitur Utama
- **Web Dashboard:** Ringkasan statistik jumlah pegawai dan shift secara real-time.
- **REST API:** Endpoint JSON lengkap yang dilindungi oleh Laravel Sanctum Token.
- **Role-Based Access Control (RBAC):** Memisahkan otorisasi antara Admin dan Staff.
- **Soft Deletes:** Perlindungan data dari penghapusan permanen.
- **Audit Logging:** Mencatat aktivitas penambahan dan penghapusan data secara otomatis.

## Tech Stack
- Backend: Laravel 11 (PHP 8.3)
- Database: MariaDB (PDO Prepared Statements)
- Security: Laravel Sanctum, CSRF Protection, Password Hashing
- Frontend: Tailwind CSS & Vanilla JS