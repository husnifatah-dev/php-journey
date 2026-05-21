<?php 
require "001-koneksi.php";

echo "<h2>Daftar Pekerja PT Husni Makmur</h2>";

try {
    // menyiapkan perintah SQL (prepared statement sangat di rekomendasikan di PDO)
    $sql = "SELECT * FROM pekerja";
    $stmt = $pdo->prepare($sql);

    // eksekusi perintahnya
    $stmt->execute();
    
    // ambil semua datanya
    $data_pekerja = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cek apakah datanya ada?
    if (count($data_pekerja) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr style='background-color: black; color: white;'>
                    <th>ID</th>
                    <th>Nama Karyawan</th>
                    <th>Shift</th>
                    <th>Posisi</th>
            </tr>";
    

    // membongkar isi array pakai foreach
    foreach ($data_pekerja as $baris) {
        echo "<tr>";
        echo "<td>" . $baris['id'] . "</td>";
        echo "<td>" . $baris['nama'] . "</td>";
        echo "<td>" . $baris['shift'] . "</td>";
        echo "<td>" . $baris['posisi'] . "</td>";

        // tambah tombol edit yang mengirimkan ID lewat URL (metode GET)
        echo "<td><a href='004-update-data.php?id=" . $baris['id'] . "'>Edit</a></td>";
        echo "</tr>";
    }

    echo "</table>";

    } else {
        echo "<i>Belum ada data pekerja di dalam database.</i>";
    }
} catch (PDOException $e) {
    echo "<b>[ERROR]</b> Gagal mengambil data: " . $e->getMessage();
}

?>