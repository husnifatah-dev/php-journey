<?php 
echo "==== PERULANGAN FOR (JUMLAHNYA SUDAH PASTI)===<br>";

// cara baca :
// mulai dari 1 ($i = 1);
// lakukan selama angkanya masih dibawah atau sama dengan 15 ($i <= 15);
// setiap selesai satu putaran,tambahkan 1 ($i++);

for ($i = 1; $i <= 15; $i++) {
    echo "cetak label kardus ke-" . $i . "<br>";
}

echo "<br>=== PERULANGAN WHILE (SELAMA KONDISINYA BENAR) ===<br>";
// cara baca: selama isi kardus masih kurang dari 3, terus masukkan barang!

$isi_kardus = 1;

while ($isi_kardus <=  7) {
    echo "Memasukkan barang ke-" . $isi_kardus . " ke dalam kardus.<br>";

    // THIS VERY IMPORTANT!
    // kita harus menambah isi kardus supaya suatu saat kondisinya bisa berhenti.
    // kalau baris dibawah ini dihapus, komputer akan mencetak selamanya sampai hang, jadi jangann lupa untuk selalu menuliskannya

    $isi_kardus++;
}

echo "<br> Status: semua kardus sudah dilabeli dan diisi, mesin berhenti."
?>