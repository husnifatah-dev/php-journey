<?php 
echo "===   AUTOLOADING (PEMANGGILAN OTOMATIS)  === <br><br>";

// code dibawah berfungsi untuk "radar", jadi setiap ada perintah new tapi nama filenya belum ada radar ini akan bergerak
spl_autoload_register(function($nama_class) {
    // PHP akan otomatis menangkap class yang dicari dan mengubahnya menjadi file
    $file = $nama_class . '.php';

    // menegcek apakah file fisiknya beneran ada di folder
    if (file_exists($file)) {
        require_once $file;
        echo "<i>[SYSTEM] Radar mendeteksi kebutuhan class. File <b>{$file}</b> otomatis dipanggil dari belakang layar!</i><br><br>";
    } else {
        echo "<i>[ERROR] File {$file} tidak ditemukan di folder ini!</i><br><br>";
    }
});

// eksekusi
echo "<b>[MENJALANKAN KENDARAAN]</b><br>";

$truk = new Kendaraan();
echo $truk->info();

echo "<br><br>";
$ojol = new Kendaraan();
echo $ojol->info();
?>