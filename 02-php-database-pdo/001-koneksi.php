<?php 
// untuk kemanan dari serangan SQL Injection maka akan menggunakan PDO (PHP Data Object)

$host = "localhost";
$dbname = "belajar_php";
$username = "phpuser";
$password = "12345";

// mencoba menghungankan dan menggunakan Try-Catch untuk menangka[ error]
try {
    // membua koneksi baru PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // mode strict error 
    $pdo->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<b>[SYSTEM]</b> Pipa saluran berhasil tersambung! Mesin PHP siap menyedot data dari MariaDB.<br><br>";

} catch (PDOException $e) {
    // kalau gagal nyambung, mesin jangan langsung mati, tetapi tampilkan pesan error ini
    echo "<b>[FATAL ERROR]</b> Gagal menyambung ke database!<br>";
    echo "Alasan: " . $e->getMessage();
}

?>