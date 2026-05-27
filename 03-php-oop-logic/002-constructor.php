<?php 
echo "===   CONSTRUCTOR (FUNGSI OTOMATIS)   ==== <br><br>";

class KaryawanPabrik {
    public $nama;
    public $divisi;
    public $shift;

    public function __construct($nama_input, $divisi_input, $shift_input) {
        $this->nama = $nama_input;
        $this->divisi = $divisi_input;
        $this->shift = $shift_input;

        echo "<i>[SISTEM] Data karyawan baru bernama <b>{$this->nama}</b> berhasil didaftarkan.</i><br>";
    }

    public function cetakIDCard() {
        return "
        <div style='border: 3px solid black; padding: 10px; width: 250px; margin-bottom: 10px;'>
       <b>ID CARD PT HUSNI FATAH MAKMUR</b><hr>
       Nama: {$this->nama} <br>
       Divisi: {$this->divisi} <br>
       Shift: {$this->shift} <br>
        </div>";
    }
}


$pekerja1 = new KaryawanPabrik("Husni Fatah", "Produksi", "Malam");
$pekerja2 = new KaryawanPabrik("Budi Lupi", "Gudang", "Pagi");

echo "<br><b>[MENCETAK ID CARD]</b><br>";
echo $pekerja1->cetakIDCard();
echo $pekerja2->cetakIDCard();


?>