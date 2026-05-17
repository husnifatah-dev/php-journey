<?php 
    $tarif_per_jam = [
        "pagi" => "20000",
        "malam" => "25000"
    ];
    
    function hitung_gaji_pokok(int $jam, int $tarif): int {
        $jam_normal = ($jam > 8) ? 8 : $jam;
        return $jam_normal * $tarif;
    }

    if (isset($_POST['submit_absen'])) {
        $nama_pekerja = $_POST['nama'];
        $shift_kerja = $_POST['shift'];
        $jam_kerja = (int) $_POST['jam'];

        $tarif_aktif = $tarif_per_jam[$shift_kerja];
        $gaji_pokok = hitung_gaji_pokok($jam_kerja, $tarif_aktif);

        $jam_lembur = 0;
        $uang_lembur = 0;

        if ($jam_kerja > 8) {
            $jam_lembur = $jam_kerja - 8;
            $uang_lembur = $jam_lembur * 10000;

        }

        $total_gaji = $gaji_pokok + $uang_lembur;

        echo "<h3>=== STRUK GAJI HARIAN ===</h3>";
        echo "Nama: " . $nama_pekerja . "<br>";
        echo "Shift: " . $shift_kerja . " (Tarif Rp " . $tarif_aktif . "/jam)<br>";
        echo "Jam Kerja Normal: " . ($jam_kerja - $jam_lembur) . " Jam<br><br>";
        echo "Total Gaji Pokok: Rp " . $gaji_pokok . "<br>";
        echo "Total Uang Lembur: Rp " . $uang_lembur . "<br>";
        echo "---------------------------------------<br>";
        echo "<b>TOTAL GAJI HARI INI: Rp " . $total_gaji . "</b><br><br>";
        echo "<hr>";
        

    };



?>

<h2>Form Gaji Harian</h2>
<form action="" method="POST">
    <label> Nama Karyawan: </label><br>
    <input type="text" name="nama" required><br><br>

    <label> Shift Kerja:
    </label><br>
    <select name="shift">
        <option value="pagi">Pagi</option>
        <option value="malam">Malam</option>
    </select><br><br>

    <label> Jam Kerja: 
    </label><br>
    <input type="number" name="jam" required><br><br>

    <button type="submit" name="submit_absen"> Kirim Absen</button>
</form>

