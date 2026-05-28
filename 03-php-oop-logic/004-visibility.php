<?php 
echo "===   VISIBILITY & ENCAPSULATION  === <br><br>";

class KaryawanRahasia {
    public $nama;
    // protected cuma bisa diakses dari dalam class ini dan turunannya
    protected $pin_absen;
    // private cuma bisa diakses dari dalam curly braces ini saja 
    private $gaji_pokok;

    // Getter jalur resmi untuk melihat data private dari luar
    public function __construct($nama, $pin, $gaji) {
        $this->nama = $nama;
        $this->pin_absen = $pin;
        $this->gaji_pokok = $gaji;
    }

    public function lihatGaji() {
        return "Gaji pokok {$this->nama} adalah Rp " . number_format($this->gaji_pokok, 0, ',', '.' );
    }


    // Setter jalur resmi untuk mengubah data private dengan validasi tertentu
    public function naikGaji($password_hrd, $jumlah_naik) {
        if ($password_hrd == "rahasia123") {
            $this->gaji_pokok += $jumlah_naik;
            return "<i>[SUKSES] Gaji {$this->nama} berhasil dinaikkan!</i><br>";
        } else {
            return "<i style='color:red;'>[DITOLAK] Password HRD salah! Gaji gagal dinaikkan.</i><br>";
        }
    }
}

// execute
$pekerja = new KaryawanRahasia("Husni Fatah", "8899", 4500000);

echo "<b>[CEK AKSES DATA]</b><br>";
// mengakses public jadi aman saja
echo "Nama Pegawai: " . $pekerja->nama . "<br>";

// coba akses private/protected dari luar maka akan error
// echo $pekerja->pin_absen;
// echo $pekerja->gaji_pokok;

echo "<br><b>[MENGGUNAKAN GETTER & SETTER]</b><br>";
// membaca gaji lewat jalur resminya 
echo $pekerja->lihatGaji() . "<br><br>";
// mencoba hack naik gaji dengan pw salah
echo $pekerja->naikGaji("hackerboy", 10000000);
echo $pekerja->lihatGaji() . "<br><br>";
// menaikkan gaji sesuai SOP (pw benar)
echo $pekerja->naikGaji("rahasia123", 500000);
echo $pekerja->lihatGaji() . "<br>";

?>