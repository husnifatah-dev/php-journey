<?php 
require "001-koneksi.php";

// tangkap id dari URL
$id_pekerja = $_GET['id'] ?? null;

// kalau ngga ada id usir user kembali ke hal tabel
if (!$id_pekerja) {
    die("Pilih pekerja yang mau diedit dulu dari tabel!");
}

// proses UPDATE jika tombol ditekan
if (isset($_POST['update_data'])) {
    $nama_baru = $_POST['nama'];
    $shift_baru = $_POST['shift'];
    $posisi_baru = $_POST['posisi'];

    try {
        // sql update wajib pakai WHERE
        $sql = "Update pekerja SET nama = :nama, shift = :shift, posisi = :posisi WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nama' => $nama_baru,
            ':shift' => $shift_baru,
            ':posisi' => $posisi_baru,
            ':id' => $id_pekerja

        ]);

        echo "<p style='color:green;'><b>[SUKSES]</b>Data berhasil diubah!</p>";
        echo "<a href='002-read-data.php>'Kembali ke Daftar Pekerja</a><hr>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'><b>[GAGAL]</b> " . $e->getMessage() . "</p>";
    }

}

// tarik data lama untuk mengisi form 
$sql_tarik = "SELECT * FROM pekerja WHERE id = :id";
$stmt_tarik = $pdo->prepare($sql_tarik);
$stmt_tarik->execute([':id' => $id_pekerja]);
$data_lama = $stmt_tarik->fetch(PDO::FETCH_ASSOC);

// kalau ternyata id yang di kueri ngga ada di di database
if (!$data_lama) {
    die("Data pekerja tidak ditermukan!");
}

?>


<h2> Edit Data Pekerja</h2>
<form action="" method="POST" style="border: 1px solid black; padding: 15px; width: 300px; ">
    <label>Nama Pekerja</label>
    <input type="text" name="nama" value="<?=  $data_lama['nama'] ?>" required><br><br>

    <label>Shift:</label><br>
    <select name="shift">
        <option value="Pagi" <?= ($data_lama['shift'] == 'Pagi') ? 'selected' : '' ?>>Pagi</option>
        <option value="Malam" <?=  ($data_lama['shift'] == 'Malam') ? 'selected' : '' ?>>Malam</option>
    </select><br><br>

    <label>Posisi:</label><br>
    <input type="text" name="posisi" value="<?=  $data_lama['posisi'] ?>" required><br><br>
    <button type="submit" name="update_data">Simpan Perubahan</button>
</form>