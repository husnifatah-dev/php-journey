<?php 
// 1. Deklarasi Variable & Tipe Data
$nama_developer = "Husni Fatah"; 
$umur = 22;
$is_bekerja = true;
$saldo_awal = 150000.50;

// 2. Menampilakn Data dengan echo
echo "Halo, perkenalkan nama saya: " . $nama_developer . "<br>";
echo "Tipe data umur saya adalah angka: " . $umur . "<br>";

// 3. Senjata rahasia programmer: var_dump()
// ini digunakan untuk mengecek isi dan tipe data asli dari sebuah variabel

echo "Cek detail varible nama: ";
var_dump($nama_developer);
echo "<br>";

echo "Cek detail variable status bekerja: ";
var_dump($is_bekerja);
echo "<br>";

echo "Cek detail varible saldo: ";
var_dump($saldo_awal);


?>