<?php 
echo "=== BELAJAR INCLUDE & REQUIRE ====<br><br>";

include "header.php";

echo "<b>Selamat datang di Dashboard Utama, Bos Hunsi!</b><br>";
echo "Laporan hari ini: Semua mesin beroperasi normal.<br><br>";

require "header.php";

echo "Ini adalah area laporan keuangan yang butuh komponen wajib.<br>";

?>