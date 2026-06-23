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

    public function getBarangById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahBarang($data) {
        $query = "INSERT INTO " . $this->table . " (nama_barang, kategori, stok) VALUES (:nama_barang, :kategori, :stok)";

        $data['nama_barang'] = ucwords(strtolower($data['nama_barang']));
        $data['kategori'] = ucwords(strtolower($data['kategori']));
        
        $this->db->query($query);
        $this->db->bind('nama_barang', $data['nama_barang']);
        $this->db->bind('kategori', $data['kategori']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataBarang($id) {

        try {
            $query = "DELETE FROM barang WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
    
            $this->db->execute();
    
            return $this->db->rowCount();

    } catch (PDOException $e) {
        return 0;
    }
    }
}