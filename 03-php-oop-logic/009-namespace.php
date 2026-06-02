<?php 
echo "===   NAMESPACE  (PENGELOMPOKAN WILAYAH)  === <br><br>";

// panggil dulu file fisiknya
require_once 'Divisi/MesinGudang.php';
require_once 'Divisi/MesinProduksi.php';

// Gunakan namespace dengan keyword 'use, dan karena classnya sama gunakan 'as' (alias) biar tidak bentrok
use Divisi\Produksi\Robot as RobotProduksi;
use Divisi\Gudang\Robot as RobotGudang;

// eksekusi
echo "<b>[MENJALANKAN ROBOT PABRIK]</b><br>";

// cetak robotnya
$robot1 = new RobotProduksi();
echo $robot1->info();

$robot2 = new RobotGudang();
echo $robot2->info();

?>
