<?php

class Barang extends Controller {
    public function index() {
        $data['judul'] = 'Inventaris Gudang';
        $data['brg'] = $this->model('Barang_model')->getAllBarang();
        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id) {
        $data['judul'] = 'Detail Barang';
        $data['brg'] = $this->model('Barang_model')->getBarangById($id);
        $this->view('templates/header', $data);
        $this->view('barang/detail', $data);
        $this->view('templates/footer');
    }

        
    public function tambah() {
        if($this->model('Barang_model')->tambahBarang($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/barang');
        exit;
    }

    public function hapus($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flasher::setFlash('gagal', 'dihapus (Method tidak diizinkan)', 'danger');
            header('Location: ' . BASEURL . '/barang');
            exit;
        }
        try {
            if($this->model('Barang_model')->hapusDataBarang($id) > 0 ) {
                Flasher::setFlash('berhasil', 'dihapus', 'success');
            } else {
                Flasher::setFlash('gagal', 'dihapus (Data tidak ditemukan)', 'warning');
            }
        } catch (Exception $e) {
            Flasher::setFlash('gagal', 'dihapus karena error sistem', 'danger');

        }

        header('Location: ' . BASEURL . '/barang');
        exit;
    }
    
}