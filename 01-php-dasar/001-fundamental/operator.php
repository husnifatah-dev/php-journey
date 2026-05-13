<?php 
// 1. Operator aritmatika (matematika dasar)
 $angka1 = 15;
 $angka2 = 4;

 echo "=== OPERATOR ARITMATIKA ===<br>";
 echo "Penjumlahan: " . ($angka1 + $angka2) . "<br>";
 echo "Pengurangan: " . ($angka1 - $angka2) ."<br>";
 echo "Perkalian: " . ($angka1 * $angka2) . "<br>";
 echo "Pembagian: " . ($angka1 / $angka2) . "<br>";

//  Modulo (%) itu sisa bagi. 15 dibagi 4 itu 3, sisanya 3. Udah tau sih alhamdulilah masih inget. Ini sering banget dipakai nanti! Okay.

echo "Sisa bagi (modulo): " . ($angka1 % $angka2) . "<br><br>";

// Operator Increment & decrement (tambah/kurang 1)
$stok_barang = 1000;

echo "=== INCREMENT & DECREMENT ===<br>";
echo "Stok awal digudang: " . ($stok_barang) . "<br>";

$stok_barang++; //Artinya sama dengan: $stok_barnag = $stok_barang + 1
echo "Stok setelah ada barang masuk 1 (stok++): " . $stok_barang . "<br>";

$stok_barang--; //artinya = $stok_barang = $stok_barang - 1
echo "Stok barang setelah ada yang keluar 1 adalah: " . $stok_barang . "<br><br>";

// Operator Penugasan (assignement)
$gaji = 2900000;

echo "=== OPERATOR PENUGASAN ===<br>";
echo "Gaji pokok: " . $gaji . "<br>";

$gaji += 250000; //Artinya sama dengan: $gaji= $gaji + 250000
echo "Gaji setelah ditambah bonus dari lembur adalah: " .$gaji . "<br>";

$gaji -= 10000; //kena potong telat 
echo "Gaji setelah di kurangi telat masuk: " . $gaji . "<br>";

?>