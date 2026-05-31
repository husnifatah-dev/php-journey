<?php 
echo "===   INTERFACE (KONTRAK KERJA)   === <br><br>";

// MEMBUAT INTERFACE SERTIFIKASI KEAMANAN K3
// Sama seperti abstract, disini function hanya boleh ada judulnya saja, untuk isinya nanti pada child
interface StandarKeamanan {
    public function cekSuhuMesin();
    public function aktifkanAlarm();
}

// MEMBUAT INTERFACE UNTUK SERTIFIKASI PERAWATAN RUTIN
interface StandarPerawatan {
    public function gantiOli();
}

// latihan buat sendiri
interface Maintenance {
    public function gantiSparepart();
}

// CLASS YANG MENGIMPLEMENTASIKAN INTERFACE
// cukup menggunakan koma (,) untuk menandatangani beberapa kontrak (interface)
class MesinLas implements StandarKeamanan, StandarPerawatan, Maintenance {
    public $nama_mesin;

    public function __construct($nama) {
        $this->nama_mesin = $nama;
    }

    public function cekSuhuMesin() {
        return "<b>{$this->nama_mesin}</b>: Suhu saat ini 85 derajat Celcius. Mesin aman.<br>";

    }
    public function aktifkanAlarm() {
        return "<b>{$this->nama_mesin}</b>: TIIITTTT! Suhu terlalu panas, mesin dimatikan otomatis!<br>";
    }

    public function gantiOli() {
        return "<b>{$this->nama_mesin}</b>: Oli pelumas berhasil diganti untuk bulan ini.<br>";
    }
    public function gantiSparepart() {
        return "<b>{$this->nama_mesin}</b>: Tidak perlu ganti sparepart untuk bulan ini, masih aman.<br>";
    }
};

class MesinPress implements StandarKeamanan, StandarPerawatan, Maintenance {
    public $nama_mesin;

    public function __construct($nama) {
        $this->nama_mesin = $nama;
    }
    
    public function cekSuhuMesin() {
        return "<b>{$this->nama_mesin}</b>: Aman, suhu berada di 150 derajat Celcius<br>";
    }

    public function aktifkanAlarm() {
        return "<b>{$this->nama_mesin}</b>: Suhu aman!<br>";
    }

    public function gantiOli() {
        return "<b>{$this->nama_mesin}</b>: Oke oli sudah diganti<br>";
    }

    public function gantiSparepart() {
        return "<b>{$this->nama_mesin}</b>: Perlu perantian pada cerobong hawa panas<br>";
    }

}

// execute
$las = new MesinLas("Las Argon X-1");

echo "<b>[LAPORAN HARIAN MESIN]</b><br>";
echo $las->cekSuhuMesin();
echo $las->gantiOli();
echo $las->gantiSparepart();

// Simulasi kalau mesin kepanasan
echo "<br><b>[SIMULASI DARURAT]</b><br>";
echo $las->aktifkanAlarm();

echo "<br><br>";
echo "<b>[MESIN KEDUA UJI COBA]</b><br>";
$press = new MesinPress("Mesin Press Hidrolik");
echo $press->cekSuhuMesin();
echo $press->gantiOli();
echo $press->gantiSparepart();
echo $press->aktifkanAlarm();

?>