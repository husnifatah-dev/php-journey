<?php
echo "===   INHERITANCE (PEWARISAN)    === <br><br>";


// class induk atau parent
class Karyawan {
    public $nama;
    public $gaji_pokok;

    public function __construct($nama_input, $gaji_input) {
        $this->nama = $nama_input;
        $this->gaji_pokok = $gaji_input;
    }

    public function infoKaryawan() {
        return "Nama: {$this->nama} | Gaji Pokok: Rp {$this->gaji_pokok}";
    }
}

// class child atau anak
class Manager extends Karyawan {
    public $tunjangan_jabatan = 5000000;

    public function totalGajiManager() {
        $total = $this->gaji_pokok + $this->tunjangan_jabatan;
        return "Total Take Home Pay Manager: Rp {$total}";
    }
}

class Operator extends Karyawan {
    public $uang_lembur = 1000000;

    public function totalGajiOperator() {
        $total = $this->gaji_pokok + $this->uang_lembur;
        return "Total Take Home Pay Operator Produksi: Rp {$total}";
    }
}

// eksekusi object dibuat dari class child 
$manager1 = new Manager("Budi Santoso", 8000000);
$operator1 = new Operator("Husni Fatah", 4000000);

echo "<b>[DATA MANAGER]</b><br>";
// memanggil fungsi infoKaryawan yang diwarisi dari Induk
echo $manager1->infoKaryawan() . "<br>";
// memanggil fungsi khususnya sendiri
echo $manager1->totalGajiManager() . "<br><br>";

echo "<b>[DATA OPERATOR]</b><br>";
echo $operator1->infoKaryawan() . "<br>";
echo $operator1->totalGajiOperator() . "<br>";

?>