<?php 

class About {
    public function index($nama = 'Husni', $job = 'buruh') {
        echo "Halo, nama saya $nama, saya adalah seorang $job";
    }
    public function page() {
        echo "About/page";
    }
}