<?php
class Barang_model {
    private $table = 'barang';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBarang() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function tambahBarang($data) {
        $query = "INSERT INTO barang (nama_barang, kategori, stok) VALUES (:nama_barang, :kategori, :stok)";

        $data['nama_barang'] = ucwords(strtolower($data['nama_barang']));
        $data['kategori'] = ucwords(strtolower($data['kategori']));
        $this->db->query($query);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();

        return $this->db->rowCount();
    }
    
} 
 
 
 