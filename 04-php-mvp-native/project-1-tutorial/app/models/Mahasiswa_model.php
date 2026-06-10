<?php

class Mahasiswa_model {
    private $mhs = [
        [
           "nama" => "Husni Fatah",
           "nim" => "02482472472",
           "email" => "husnifatah@gmail.com",
            "prodi" => "Sistem Informasi"
        ],
        [
           "nama" => "Naruto Uzumaki",
           "nim" => "924375345",
           "email" => "naruto@gmail.com",
            "prodi" => "Ninja"
        ],
        [
           "nama" => "Light Yagami",
           "nim" => "7652043",
           "email" => "l@gmail.com",
            "prodi" => "Kriminologi"
        ],
    ];
    public function getAllMahasiswa() {
        return $this->mhs;
    }
}