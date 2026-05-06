<?php 
echo "===   ARRAY BIASA (INDEX) ===<br>";
// index selalu dimulai dari 0 bukan 1!
$rak_gudang = ["baut", "paku", "mur", "kabel"];

echo "Isi loker nomer 0 adalah: " . $rak_gudang[0] . "<br>";
// unutk mau memnaggil kabel ada di index nomer 3 
echo "Isi loker nomer 3 adalah: " . $rak_gudang[3] . "<br><br>";

echo "===   ARRAY ASSOSIATIF (PAKAI LABEL)  ===<br>";
// untuk lebih mempermudah kita gunakan key value karena angka hanya bisa dijangkau kalau isinya dikit kalo sampe ribuan kan pasti ga hafal juga

$karyawan = [
    "nama" => "Husni Fatah",
    "umur" => "22",
    "shift" => "Pagi",
    "posisi" => "Operator produksi"
];

// untuk pemanggilan kita bisa gunakan KEYnya atau LABELnya
echo "Nama karyawan: " . $karyawan["nama"] . "<br>";
echo "Posisinya sebagai: " . $karyawan["posisi"] . "<br>";
echo "Shift apa: " . $karyawan["shift"] . "<br><br>";

echo "===   CETAK SEMUA ISI RAK (FOREEACH) ===<br>";
// disini menggunakan kombinasi perulangan dan array
// foreach akan mengambil semua value yang ada di array satu per satu sampai habis secara otomatis

foreach ($rak_gudang as $barang) {
    echo "Mengecek stok barang: " .$barang . "<br>";
}

?>