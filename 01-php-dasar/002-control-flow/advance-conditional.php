<?php 
echo "=== TERNARY OPERATOR (IF/ELSE DALAM 1 BARIS) ====<br>";
$target_produksi = 1000;
$hasil_hari_ini = 1500;

$status_bonus = ($hasil_hari_ini >= $target_produksi) ? "Dapat Bonus" : "Gagal Dapat Bonus";

echo "Status operator: " . $status_bonus . "<br><br>";

echo "=== NULL COALESCING (??) ===<br>";
// Untuk pengisian nilai jika user lupa ngisi 
$input_divisi = null; //contoh ini tidak diisi
$divisi_karyawan = $input_divisi ?? "Pekerja Umum (Default)";
echo "Divisi anda adalah: " . $divisi_karyawan . "<br><br>";


echo "=== SWITCH vs MATCH (Cek Kondisi Banyak) ===<br>";
$kode_mesin = "B";


// Cara menggunakan switch
echo " Cek Mesin pakai Switch: ";
switch ($kode_mesin) {
    case "A": 
        echo "Mesin Normal";
        break;
    case "B":
        echo "Mesin Butuh Maintenance";
        break;
    default:
        echo "Mesin Rusak / Tidak Dikenali";

}
echo "<br><br>";

// Cara menggunakan match
$status_mesin =match($kode_mesin) {
    "A" => "Mesin Normal",
    "B" => "Mesin Butuh Maintanance",
    "C" => "Mesin Rusak",
    default => "Kode tidak dikenali",
};
echo "Cek Mesin pakai match (php 8): " . $status_mesin . "<br><br>";

echo "=== THE LAST OF BENDER (BREAK & CONTINUE) ====<br>";
for ($kardus = 2; $kardus <=  5; $kardus++) {
    // Continue untuk melakukan skip/ lewati putaran ini dan lanjut ke selanjutnya
    if ($kardus === 3) {
        echo "Kardus ke-3 cacat pabrik! SKIP, buang ke tong sampah.<br>";
        continue;
    }

    if ($kardus === 5) {
        echo "Kardus ke-5 sudah melewati batas limit! MESIN MATI DARURAT!<br>";
        break;
    }

    echo "kardus ke-" . $kardus . " Lolos QC dan disegel.<br><br>";
}
echo "Proses pengecekan SELESAI!"

?>