<?php 
echo "===   MENGHITUNG & MENCARI ISI ARRAY  ===<br>";
$stok_gudang = ["Baut", "Mur", "Paku", "Palu", "Tang", "RJ45", "Crimping", "Kabel"];

// count() = untuk menghitung total isi kardus
$total_barang = count($stok_gudang);
echo "Total jenis barang di gudang: " . $total_barang . "<br><br>";

// in_array = untuk mengecek apakah ada di dalam array tersebut yang mau dipakai
$dicari = "Helm";
if (in_array($dicari, $stok_gudang)) {
    echo "Status barang '" . $dicari . "' Tersedia di gudang.<br>";
} else {
    echo "Status barang '" . $dicari . "' KOSONG!.<br><br>";
}

echo "=== MENAMBAH DATA BARU (ARRAY PUSH) ===<br><br>";
// array_push() = menambah tapi diakhir arraynya
array_push($stok_gudang, "Pipa rucika", "Oli mesin");

echo "Stok setelah ditambah barang baru:<br>";
foreach ($stok_gudang as $barang) {
    echo "- " . $barang . "<br>";
}
echo "<br>";

echo "===   FILTER DATA (ARRAY FILTER)  ===<br>";
// array_filter() = untuk menyaring data sesuai syarat tertentu
$nilai_karyawan = [75, 80, 55, 90, 60, 40, 85];

// fn($nilai) => $nilai >= 70 adlah cara modern PHP untuk menulis kondisi secara singkat
$karyawan_lolos = array_filter($nilai_karyawan, fn($nilai) => $nilai >= 70);
echo "Daftar nilai karyawan yang lolos standar pabrik: <br>";
foreach($karyawan_lolos as $lulus) {
    echo "Nilai: " . $lulus . " (Lulus)<br>"; 
}
echo "<br><br>";

echo "===   MERUBAH SEMUA DATA (ARRAY MAP)  ===<br>";
// array_map() = untuk memodifikasi setiap isi array secara massal dan otomatis
$kode_mentah = ["001","002", "003"];

// menambahkan awalan "PT-HF-" ke semua kode barang
$kode_resmi = array_map(fn($kode) => "PT-HF-" . $kode, $kode_mentah);

echo "Kode barang yang sudah distempel resmi:<br>";
foreach ($kode_resmi as $resmi) {
    echo $resmi . "<br>";
}
?>