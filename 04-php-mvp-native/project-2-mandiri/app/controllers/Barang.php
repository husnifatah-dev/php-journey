<?php

Class Barang extends Controller {
    public function index() {
        $data['judul'] = 'Inventaris Gudang';
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
    }
}