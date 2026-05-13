<?php 
echO "===   FUNGSI DASAR (MESIN TANPA BAHAN BAKU)  ===<br>";
// Membuat mesinnya dahulu
function sapa_karyawan() {
    echo "Perhatian: Jangan lupa untuk selalu absen menggunakan sidik jari sebelum dan selesai bekerja!<br>";
}


// Menekan tombol on untuk menjalankan mesin (functionnya)
sapa_karyawan();
sapa_karyawan(); //bisa dipanggil berapapaun tidak hanya 1
echo "<br><br>";


echo "===   FUNGSI DENGAN PAAMETER (MESIN DENGAN BAHAN BAKUNYA) ===<br><br>";
// $nama dan $posisi adalah corong(parameter) untuk memasukkan bahan baku
function cetak_ID_card($nama, $posisi) {
    echo "====================================<br>";
    echo "ID CARD KARYAWAN<br>";
    echo "Nama  : " . $nama . "<br>";
    echo "Posisi : " . $posisi . "<br>";
    echo "====================================<br>";
}

// pemanggilan mesin(function) dan masukan bahan bakunya(parameter)
cetak_ID_card("Husni", "Operator produksi");
cetak_ID_card("Fatah Shawn", "Satpam");
echo "<br><br>";

echo " ===  FUNGSI DENGAN RETURN (MESIN PENGHASIL NILAI) ===<br>";
// kalau yang diatas cuma akan menceta teks (echo)
// fungsi ini akan memproses angka dan mengembalikan(return) untuk di hitung lagi

function hitung_bonus_lembur($jam_lembur) {
    $tarif_per_jam = 8000;
    $total_bonus = $jam_lembur * $tarif_per_jam;

    // kembalikan hasil hitungannya ke luar mesin
    return $total_bonus;
}

// cara pakainya: Hasil dari mesin langsung kita tangkap pakai variabel
 $bonus_husni = hitung_bonus_lembur(4); //husni lembur 4 jam
 echo "Bonus yang akan diterima adalah: " . $bonus_husni . "<br>";

//  lebih saktinya lagi, bisa langsung dijumlahkan dengan variabel lain!
$gaji_pokok = 2900000;
$total_gaji_bulan_ini = $gaji_pokok + hitung_bonus_lembur(10); //lembur 10 jam bulan ini
echo "Total gaji bulan mei ini adalah: " . $total_gaji_bulan_ini . "<br>";

?>