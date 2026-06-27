<?php

class Transaksi extends Controller {
    public function index() {
        $data['judul'] = 'Barang Masuk';
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->view('templates/header', $data);
        $this->view('transaksi/masuk', $data);
        $this->view('templates/footer', $data);
    }
}