<?php 
// panggil pipa koneksinya seperti biasa
require "001-koneksi.php";

echo "<h2>Tambah Pekerja Baru</h2>";

// untuk mengecek apakah tombol kirim data sudah ditekan
if (isset($_POST['simpan_data'])) {
    // tangkap data dari form
    $nama_input = $_POST['nama'];
    $shift_input = $_POST['shift'];
    $posisi_input = $_POST['posisi'];

    try {
        // siapkah perintah SQL (PREPARES STATEMENT)
        // tidak boleh memasukkan variabel $nama_input langsung karena nantinya jadi celah fatal untuk SQL Injection
        // pakai titik dua (:nama) sebagai placeholder
        $sql = "INSERT INTO pekerja (nama, shift, posisi) VALUES (:nama, :shift, :posisi)";
        $stmt = $pdo->prepare($sql);

        // masukkan data dengan aman

        $stmt->execute([
        ':nama' => $nama_input,
        ':shift' => $shift_input,
        ':posisi' => $posisi_input
        ]);

        echo "<p style='color: green;'><b>[SUKSES]</b> Data pekerja bernama " . $nama_input . " berhasil ditambahkan ke databse!</p>";

        // link untuk melihat hasilnya
        echo "<a href='002-read-data.php'>Lihat Daftar Pekerja</a><br><br>";

    } catch (PDOException $e) {
        echo "<p style='color: red;'><<b>[GAGAL]</b> " . $e->getMessage() . "</p>";
    }
}


?>

<form action="" method="POST" style="border: 1px solid black; padding: 15px; width: 300px;">
    <label>Nama Pekerja:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Shift:</label><br>
    <select name="shift">
        <option value="Pagi">Pagi</option>
        <option value="Malam">Malam</option>
    </select><br><br>
    <label>Posisi:</label><br>
    <input type="text" name="posisi" required><br><br>

    <button type="submit" name="simpan_data">Simpan ke Database</button>
</form>
