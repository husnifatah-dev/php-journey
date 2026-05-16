<?php 
echo "===   SCOPE (RUANG LINGKUP VARIABLE   ===<br>";
$nama_pabrik = "PT Husni Fatah Jaya Abadi Makmur"; //variable global yang ada di luar


// function cetak_kop_surat() {
//     global $nama_pabrik; //keyword global untuk mengakses variable di luar
//     echo "Kop Surat: " . $nama_pabrik . "<br><br>";
// }
// cetak_kop_surat();

// aku coba ubah ke arrow
$cetak_kop_surat = fn() => "Kop Surat: " . $nama_pabrik . "<br><br>";
echo $cetak_kop_surat();


echo "===   TYPE HINTS  ===<br>";
// int agar memaksa nilai yang masuk dan keluar berupa angka bulat
// function tambah_stok(int $stok_lama, int $stok_baru): int {
//     return $stok_lama + $stok_baru;
// }

// echo "Total Stok Barang: " . tambah_stok(50, 20) . " unit.<br>";
// echo "<br>";

// coba ubah ke arrow 
$tambah_stok = fn(int $stok_lama, int $stok_baru ): int => $stok_lama + $stok_baru;
echo "Total Stok Barang: " . $tambah_stok(100, 240) . " unit.<br>";
echo "<br>";  

echo "===   VARIADIC FUNCTION  (...args)    ====<br>";
//(...) untuk menerima berapapun nilainya
// function hitung_total_lembur(...$jam_lembur_harian) {
//     $total = 0;
//     foreach ($jam_lembur_harian as $jam) {
//         $total += $jam;
//     }
//     return $total;
// }

// coba ubah ke arrow 
$hitung_total_lembur = fn(...$jam_lembur_harian) => array_sum($jam_lembur_harian);

echo "Total Lembur Husni minggu ini: " . $hitung_total_lembur(10, 4, 5, 2, 3) . " Jam.<br><br>";

echo "=== ARROW FUNCTION ===<br>";
// bisa otomatis membaca variable global tanpa harus menuliskan keyword global
$bonus_per_jam = 15000;
$hitung_uang = fn($jam) => $jam * $bonus_per_jam;

echo "Uang lembur 5 jam: Rp " . $hitung_uang(5) . "<br>";
?>