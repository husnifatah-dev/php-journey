<?php

class Mahasiswa_model {
    private $dbh; //database handler
    private $stmt; //statement

    public function __construct() {
        // data source name
        $dsn = 'mysql:host=127.0.0.1;dbname=phpmvc';
        try {
            $this->dbh = new PDO($dsn, 'phpuser', '12345');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
    public function getAllMahasiswa() {
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}