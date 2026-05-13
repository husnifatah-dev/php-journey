<?php 
echo "=== OPERATOR PERBANDINGAN===<br>";

$target_produksi = 1000;
$hasil_produksi =700;

// Cek apakah nilainya sama (==)
echo "Apakah hasil produksi sesuai target?: ";
var_dump($hasil_produksi == $target_produksi); //false
echo "<br>";

$stok_minimum = 85;
$stok_sekarang = 85;

// Cek apakah LEBIH KECIL (<)
echo "Apakah stok sekarang dibawah minimun (harus restock)?: ";
var_dump($stok_sekarang < $stok_minimum); //false
echo "<br><br>";

echo "===JEBAKAN BATMAN: == VS ===<br>";
$pin_angka = 1234; // Int
$pin_huruf = "1234"; //Str

echo "Pakai == untuk mengecek nilainya saja: ";
var_dump($pin_angka == $pin_huruf);
echo "<br>";

echo "Pakai === kalo mau ngecek nilai AND tipe datanya: ";
var_dump($pin_angka === $pin_huruf);
echo "<br><br>";

echo "=== OPERATOR LOGIKA (AND & OR) ===<br>";
$hadir_full = true;
$capai_target = false;

// AND (dua-duanya harus terpenuhi)
echo "Dapat BONUS bulanan hadir full AND capai targetnya?: ";
var_dump($hadir_full && $capai_target);
echo "<br>";

// OR (cukup salah satunya aja yang benar maka hasilnya true)
echo "Dapat uang makan jika hadir atau target terpenuhi?: ";
var_dump($hadir_full || $capai_target);
echo "<br>";

?>