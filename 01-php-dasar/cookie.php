<?php 
echo "=== SISTEM PENGINGAT (COOKIE) ===<br><br>";

if (isset($_GET['aksi']) && $_GET['aksi'] == 'buat') {
    setcookie("karyawan_teladan", "Husni Fatah", time() + 60);

    echo "<i>Stiker parkir 'Karyawan Teladan' sudah ditempel. Berlaku 5 menit!</i>,<br><br>";
    echo "<a href = 'cookie.php'>Refresh Halaman</a> ";
    exit;

}

if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    setcookie("karyawan_teladan", "", time() - 3600);

    echo "<i>Stiker parkir sudah dicopot paksa!</i><br><br>";
    echo "<a href='cookie.php'>Refresh Halaman</a>";
    exit;
}

if (isset($_COOKIE['karyawan_teladan'])) {
    echo "Status: <b>DIKENALI</b><br>";
    echo "Selamat datang kembali, <b>" . $_COOKIE['karyawan_teladan'] ."</b>!<br>";
    echo "Sistem masih mengingatmu walaupun browser ditutup (sampai waktunya habis).<br><br>";
    echo "<a href = '?aksi=hapus'> [ Copot stiker / Hapus cookie ]</a>";

} else {
    echo "Status: <b>TIDAK DIKENALI</b><br>";
    echo "Sistem tidak mengingat siapa kamu atau stikermu sudah kadaluarsa.<br><br>";
    echo "<a href='?aksi=buat'> [Tempel Stiker / Buat Cookie (5 Menit) ] </a>";
}

?>