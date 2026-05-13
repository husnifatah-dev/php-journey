<?php 
echo "====  METODE GET DAN POST ===<br><br>";

// Menangkap DATA dari URL dengan $_GET
// Cek apakah ada kata "?divisi=..." di URL browser
if (isset($_GET['divisi'])) {
    $divisi = $_GET['divisi'];
    echo "<b>[SYSTEM INFO]</b> Kamu sedang mengecek data untuk divisi: <b>" . $divisi . "</b><br><br>";
}

// Menangkap data dari FORM dengan $_POST
// Cek apakah tombol dengan nama 'submit_absen' sudah ditekan
if (isset($_POST['submit_absen'])) {
    $nama_pekerja = $_POST['nama'];
    $shift_kerja = $_POST['shift'];

    echo "<b>[SISTEM ABSENSI]</b><br>";
    echo "Data masuk! Karyawan <b>" . $nama_pekerja . "</b> berhasil absen untuk shift <b>" . $shift_kerja . "</b>.<br><br>";
}

?>

<!-- Ini adalah Form HTML 
method="POST" artinya kita pakai kurir tertutup -->
<h2> Form Absensi Harian Karyawan </h2>
<form action="" method="POST">
    <label> Nama Karyawan:</label><br>
    <input type="text" name="nama" required><br><br>

    <label> Shift Kerja:</label><br>
    <select name="shift">
        <option value="Pagi">Pagi</option>
        <option value="Malam">Malam</option>
    </select><br><br>

    <button type="submit" name="submit_absen">
        Kirim Absen
    </button>
</form>

<hr>
<!-- Ini contoh penggunaan GET (lewat link) -->
 <p>Cek filter data divisi (Pakai GET):</p>
 <a href="?divisi=Produksi">Cek Divisi Produksi</a> |
 <a href="?divisi=Gudang">Cek Divisi Gudang</a> |
 <a href="?divisi=QA">Cek Divisi Quality Assurance (QA)</a>
