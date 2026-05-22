<?php 
require "001-koneksi.php";

// tangkap id target yang mau hapus dari URL
$id_pekerja = $_GET['id'] ?? null;

// cegat kalau ada orang luar iseng langsung buka file ini tanpa bawa ID
if (!$id_pekerja) {
    die("Pilih data yang mau dihapus dari tabel terlebih dahulu!");
}

try {
    // siapkan perintah pemusnahan massal
    $sql = "DELETE FROM pekerja WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    // eksekusi penghapusan
    $stmt->execute([':id' => $id_pekerja]);

    // redirect user ke halaman tabel secara otomatis
    header("Location: 002-read-data.php");
    exit; //waji supaya script benar-benar berhenti
} catch (PDOException $e) {
    echo "<b>[GAGAL MENGHAPUS</b> Terjadi kesalahan: " . $e->getMessage();
}
?>