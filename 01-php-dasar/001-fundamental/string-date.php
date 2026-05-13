<?php 
echo "=== MANIPULASI STING ===<br>";

$kode_barang = " brg-mesin-001 ";
echo "Teks Asli: '" . $kode_barang . "'<br>";


// trim() = memotong spasi kosong di awal dan akhir teks
$kode_bersih = trim($kode_barang);
echo "Setelah di-trim: '" . $kode_bersih . "'<br>";

// strtoupper() = mengubah semua huruf menjadi KAPITAL
$kode_besar = strtoupper($kode_bersih);
echo "Huruf Besar: " . $kode_besar . "<br>";

// str_replace() = mengganti kata tertentu dengan kata lainnya
$kode_baru = str_replace("MESIN", "MOTOR", $kode_besar);
echo "Kode baru: " . $kode_baru . "<br><br>";

echo "=== MEMANIPULASI DATE ===<br>";
date_default_timezone_set("Asia/Jakarta");

$waktu_sekarang = date("Y-m-d H:i:s");
$nama_hari = date("l"); // l kecil = nama hari bahasa inggris

echo "Waktu cetak struk: " . $waktu_sekarang . "<br>";
echo "Hari percetakan: " . $nama_hari . "<br><br>";

echo "====  SIMULASI SISTEM PABRIK ====<br>";
echo "Sukses! Barang <b>".$kode_baru . "</b> berhasil di produksi dan masuk gudang pada <b>" . $waktu_sekarang . "</b>";

?>