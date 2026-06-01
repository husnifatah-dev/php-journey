<?php 
echo "===   TRAIT (MODE TEMPEL) === <br><br>";

// membuat trait MODUL USB WIFI
// trait bukan class jadi tidak bisa dicetak pakai 'new', dia cuma code siap tempel
trait ModulWiFi {
    public function hidupkanWiFi() {
        return "<i>[WIFI] Mencari sinyal jaringan... Berhasil terhubung ke WiFi Pabrik!</i><br>";
    }

    public function kirimDataKePusat() {
        return "<i>[WIFI] Mengirim laporan data ke server pusat Jakarta... Sukses.</i><br>";
    }   
}

// MODUL LAMPU INDIKATOR
trait ModulLampu {
    public function nyalakanLampuHijau() {
        return "<i>[LAMPU] Lampu indikator hijau menyala. Mesin Normal.</i><br>";
    }
}

// class pertama mesin absen 
class MesinAbsen {
    public $merk;

    public function __construct($merk) {
        $this->merk = $merk;
    }

    // cara menempelkan trait gunakan keyword 'use' di dalam class
    // bisa menempelakn sekaligus pakai koma (,)
    use ModulWiFi, ModulLampu;

    public function tapKartu($nama) {
        return "<b>{$this->merk}</b>: Karyawan bernama {$nama} berhasil absen masuk.<br>";
    }
}

// class kedua mesin produksi
class MesinProduksi {
    public $nama_mesin;

    public function __construct($nama) {
        $this->nama_mesin = $nama;
    }

    use ModulWiFi;
    public function potongBesi() {
        return "<b>{$this->nama_mesin}</b>: Sedang memotong plat besi... Zzzzttt!<br>";
    }
}

echo "<b>[TESTING MESIN ABSEN]</b><br>";
$absen_depan = new MesinAbsen("FingerTech X9");
echo $absen_depan->tapKartu("Husni Fatah");

// memanggil fungsi dari trait yang sudah ditempel
echo $absen_depan->nyalakanLampuHijau();
echo $absen_depan->hidupkanWiFi();
echo $absen_depan->kirimDataKePusat();

echo "<br>";

echo "<b>[TESTING MESIN PRODUKSI]</b><br>";
$mesin_potong = new MesinProduksi("Cuter Tronik");
echo $mesin_potong->potongBesi();

// mesin produksi juga bisa pakai WiFi yang sama
echo $mesin_potong->hidupkanWiFi();
?>