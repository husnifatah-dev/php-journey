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
} 
 
 
 