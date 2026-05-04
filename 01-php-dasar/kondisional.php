<?php
echo "===KONDISIONAL (IF / ELSE) ===<br>";

$target_produksi = 700;
$hasil_produksi = 8500;

echo "Target: " . $target_produksi . " | Hasil: " . $hasil_produksi . "<br>";

//  IF ELSE Dasar
if ($hasil_produksi >= $target_produksi) {
    echo "Status: Target tercapai! Dapat bonus bulanan. <br><br>";

} else {
    echo "Status: target belum terpenuhi let's try again and never give up!<br><br>";

}


echo "=== CEK JAM KERJA & LEMBUR ===<br>";
$jam_kerja = 10;

echo "Total jam kerja hari  ini: " . $jam_kerja . " jam.<br>";

if ($jam_kerja == 9) {
    echo "Keterangan: Kerja shift normal. Waktunya pulang dan istirahat.";
} elseif  ($jam_kerja > 9 && $jam_kerja < 12) {
    echo "Keterangan: Lembur! Dapat tambahan uang makan dan bonus per jam.";
} elseif ($jam_kerja > 12) {
    echo "Keterangan: Lebur ekstrem!, Hati-hari dan jaga selalu kesehatannya.";
} else {
    echo "Keterangan: Jam kerja dibawah standar, apkaah hari ini izin setengah hari?";
}

?>