<?php 
echo "=== PENGENALAN CLASS & OBJECT ===<br><br>";

class MesinPabrik {
    public $nama_mesin;
    public $jenis;
    public $status = "Mati";


    public function nyalakan() {
        $this->status = "Menyala";
        return "Mesin <b>{$this->nama_mesin}</b> berhasil dihidupkan!";
    }
    
    public function matikan() {
        $this->status = "Mati";
        return "Mesin <b>{$this->nama_mesin}</b> dimatikan karena shift selesai.";
    }
}


$mesin_potong = new MesinPabrik();
$mesin_potong->nama_mesin = "Cutter X-100";
$mesin_potong->jenis = "Pemotong Baja";

$mesin_press = new MesinPabrik();
$mesin_press->nama_mesin = "Press Y-200";
$mesin_press->jenis  = "Pengepress Kardus";

echo "<b>[CEK STATUS AWAL]</b><br>";
echo "Nama Mesin 1: " . $mesin_potong->nama_mesin . " | Status: " . $mesin_potong->status . "<br>";
echo "Nama Mesin 2: " . $mesin_press->nama_mesin . " | Status: " . $mesin_press->status . "<br><br>";

echo "<b>[AKSI OPERATOR]</b><br>";
echo $mesin_potong->nyalakan() . "<br>";
echo "Cek Ulang Status Mesin 1: <span style='color:green;'>" . $mesin_potong->status . "</span><br><br>";

echo $mesin_press->matikan() . "<br>";
?>