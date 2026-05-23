<?php 
require "001-koneksi.php";

echo "<h2>Daftar Pekerja PT Husni Makmur</h2>";

// Tambah form pencarian menggnaiakn method GET supaya keyword di URL dan bisa di share
$keyword = $_GET['cari'] ?? '';
?>

<form action="" method="GET" style="margin-bottom: 20px;">
    <input type="text" name="cari" placeholder="Cari nama atau posisi..." value="<?=  htmlspecialchars($keyword) ?>" style="padding: 5px; width: 250px;">
    <button type="submit">Cari Data</button>
    <?php if ($keyword): ?>
        <a href="002-read-data.php" style="margin-left: 10px;">Reset</a>
    <?php endif; ?>
</form>

<?php 
try {
    // logika pencarian
    if ($keyword) {
        // kalau ada pencarian, gunakan operator LIke dan %
        $sql = "SELECT * FROM pekerja WHERE nama LIKE :cari OR posisi LIKE :cari";
        $stmt = $pdo->prepare($sql);

        // tanda % artinya "teks apa saja"
        // jadi "%budi" akan menemukan "budi santoso", "budi lupika", dll
        $stmt->execute([':cari' => "%" . $keyword . "%"]);
    } else {
        // kalau kotakpencarian kosong, tampilkan semua data seperti biasa
        $sql = "SELECT * FROM pekerja";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
    $data_pekerja = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cetak TABEL
    if (count($data_pekerja) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr style='background-color: black; color: white;'>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Shift</th>
                <th>Posisi</th>
                <th>Aksi</th>
            </tr>";

        foreach ($data_pekerja as $baris) {
            echo "<tr>";
            echo "<td>" . $baris['id'] . "</td>";
            echo "<td>" . $baris['nama'] . "</td>";
            echo "<td>" . $baris['shift'] . "</td>";
            echo "<td>" . $baris['posisi'] . "</td>";
            echo "<td>
                    <a href='004-update-data.php?id=" . $baris['id'] . "'>Edit</a> |
                    <a href='005-delete-data.php?id=" . $baris['id'] . "' onclick=\"return confirm('Yakin ingin menghapus pekerja ini?');\">Hapus</a>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<i>Pekerja dengan kata kunci '<b>" . htmlspecialchars($keyword) . "</b>' tidak ditemukan.</i>";
    }
} catch (PDOException $e) {
    echo "<b>[ERROR]</b> Gagal mengambil data: " . $e->getMessage();
}
?>