<?php

class Transaksi extends Controller {
    public function index() {
        $data['judul'] = 'Barang Masuk';
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->view('templates/header', $data);
        $this->view('transaksi/masuk', $data);
        $this->view('templates/footer', $data);
    }

     public function keluar() {
        $data['judul'] = 'Barang Masuk';
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->view('templates/header', $data);
        $this->view('transaksi/keluar', $data);
        $this->view('templates/footer', $data);
    }

    public function simpanMasuk() {
        if($this->model('Transaksi_model')->tambahDataBarangMasuk($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambah', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambah', 'danger');
        }

        header('Location: ' . BASEURL . '/transaksi');
        exit;
    }

    public function simpanKeluar() {
        if($this->model('Transaksi_model')->dataBarangKeluar($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'dikurangi', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambah', 'danger');
        }

        header('Location: ' . BASEURL . '/transaksi');
        exit;
    }
}