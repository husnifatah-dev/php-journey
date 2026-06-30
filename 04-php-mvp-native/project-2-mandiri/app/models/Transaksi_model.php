<?php

class Transaksi_model {
    private $table = 'barang_masuk';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function tambahDataBarangMasuk($data) {
        try {

            $this->db->query("INSERT INTO barang_masuk (barang_id, jumlah, tanggal) VALUES (:barang_id, :jumlah, :tanggal)");
            $this->db->bind('barang_id', $data['barang_id']);
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->bind('tanggal', $data['tanggal']);
            $this->db->execute();
    
            $this->db->query("UPDATE barang SET stok = stok + :jumlah WHERE id = :barang_id");
            $this->db->bind('jumlah', $data['jumlah']);
            $this->db->bind('barang_id', $data['barang_id']);
            $this->db->execute();
    
            return $this->db->rowCount();
        } catch (Exception $e) {
            $this->db->rollBack();
            return 0;

        }
    }
}