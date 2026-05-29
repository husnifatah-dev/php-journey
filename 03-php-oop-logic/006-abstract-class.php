<?php 
echo "===   ABSTRACT CLASS  === <br><br>";

// ABSTRACT CLASS hanya sebagai rancangan dasar dan tidak bisa dibuat menjadi object
abstract class StandarPabrik {
    public $nama_cabang;

    public function __construct($nama){
        $this->nama_cabang = $nama;
    }

    // ABSTRACT METHOD hanya sebagai kerangka method, tidak memiliki isi
    // namun wajib diisi implementasinya oleh class anak
    abstract public function mulaiProduksi();

    // fungsi biasa memiliki isi dan tetap boleh berada di dalam abstract class
    public function tutupPabrik() {
        return "<i>Mesin di {$this->nama_cabang} dimatikan. Pabrik ditutup.</i><br>";
    } 
}

// class anak 1
class PabrikSepatu extends StandarPabrik {
    // class anak wajib mengimplementasikan method mulaiProduksi()
    public function mulaiProduksi() {
        return "<b>{$this->nama_cabang}</b>: Mulai memotong kulit dan mengelem alas sepatu.<br>";
    }
}

// class anak 2
class PabrikBaju extends StandarPabrik {
    // isinya boleh berbeda dengan PabrikSepatu, yang penting tujuan methodnya sama
    public function mulaiProduksi() {
        return "<b>{$this->nama_cabang}</b>: Mulai menjahit kain katun dan memasang kancing.<br>";
    }
}

class PabrikMobil extends StandarPabrik {
    public function mulaiProduksi() {
        return "<b>{$this->nama_cabang}</b>: Mulai merakit mesin dan pasang rangka.<br>";
    }
}

echo "<b>[EKSEKUSI PABRIK CABANG]</b><br>";

// StandarPabrik itu abstrak (hanya konsep SOP) jadi tidak boleh di inisiasikan
// $kantor_pusat = new StandarPabrik("Pusat Jakarta");

// yang benar cuma bisa mengeksekusi childnya
$cabang_sepatu = new PabrikSepatu("Pabrik Sepatu Cibaduyut");
echo $cabang_sepatu->mulaiProduksi();
echo $cabang_sepatu->tutupPabrik();

echo "<br><br>";
$cabang_baju = new PabrikBaju("Pabrik Baju Pekalongan");
echo $cabang_baju->mulaiProduksi();
echo $cabang_baju->tutupPabrik();

echo "<br><br>";
$cabang_mobil = new PabrikMobil("Pabrik Mobil Cikarang");
echo $cabang_mobil->mulaiProduksi();
echo $cabang_mobil->tutupPabrik();
?>