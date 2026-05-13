<?php 
// MUTLAK!, HARUS DI BARIS PALINGA ATAS!!
session_start();

echo "=== SISTEM KEAMANAN PABRIK (SESSION) ====<br><br>";

// logika untuk logout (mengapus session)
if (isset($_GET['aksi']) && $_GET['aksi'] == 'logout') {
    session_destroy(); //penghancuran ID Card
    echo "<i>ID Card telah dihancurkan. Anda berhasil keluar.</i><br><br>";
    echo "<a href='session.php'>Refresh Halaman</a>";
    exit; // hentikan eksekusi sisa kode dibawahnya
}

// logika untuk login (membuat session)
if (isset($_GET['aksi']) && $_GET['aksi'] == 'login') {
    // simpan data ke session
    $_SESSION['karyawan'] = "Husni Fatah";
    $_SESSION['akses'] = "Ruang Kontrol Utama";
}

// mengecek apkaah karyawan sudap punya ID Card (session) atau belum
if (isset($_SESSION['karyawan'])) {
    // kalau session ada isisnya tampilkan data
    echo "Satatus: <b>SUDAH LOGIN</b><br>";
    echo "Selamat bekerja, bos <b>" . $_SESSION['karyawan'] . "</b>!<br>";
    echo "Hak Akses: " . $_SESSION['akses'] . "<br><br>";

    // tombol untuk menghancurkan session
    echo "<a href='?aksi=logout'>[Keluar / Logout]</a>";
} else {
    // kalau session kosong (belum login)
    echo "Status: <b> BELUM LOGIN </b><br>";
    echo "Peringatan: Anda tidak memiliki akses masuk! <br><br>";

    // tombol untuk membuat session
    echo "<a href='?aksi=login'>[Bikin ID Card /Login]</a>";
}
?>