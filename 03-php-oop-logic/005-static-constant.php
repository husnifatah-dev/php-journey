<?php 
echo "===  STATIC & CONSTANT    === <br><br>";

class AturanPabrik {
    // CONSTANT nilainya mutlak tidak bisa diubah dan rulenya nama variable harus wajib KAPITAL dan pakai keyword 'const'
    public const NAMA_PABRIK = "PT Husni Fatah Makmur";
    public const JAM_MASUK = "08:00 WIB";

    // STATIC (variable milik bersama) bukan milik individu karyawan
    public static $total_karyawan_hadir = 0;

    // STATIC METHOD: fungsi yang bisa langsung dipakai tanpa perlu membuat object ''new'
    public static function mesinAbsen($nama_karyawan) {
        // karena static maka butuh self:: untuk memnaggil properti dalam class ini
        self::$total_karyawan_hadir++;

        return "<i>Tiiit!</i> Karyawan <b>{$nama_karyawan}</b> berhasil absen. Total hadir hari ini: " . self::$total_karyawan_hadir . " orang.<br>";

    }
}

echo "<b>[MENGAKSES CONSTANT & STATIC DARI LUAR]</b><br>";

// tidak perlu menggunakan sintaks $pabrik = new AturanPabrik
// langsung tembak nama classnya pakai :: atau scope resolution operator

// mengakses constant
echo "Selamat datang di <b>" . AturanPabrik::NAMA_PABRIK . "</b><br>";
echo "Batas absen maksimal jam " . AturanPabrik::JAM_MASUK . "<br><br>";

// menggunakan mesin absen (static metod)
echo AturanPabrik::mesinAbsen("Husni");
echo AturanPabrik::mesinAbsen("Ronaldo");
echo AturanPabrik::mesinAbsen("Igor Thiago")
?>