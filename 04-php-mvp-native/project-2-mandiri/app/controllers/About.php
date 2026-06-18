<?php 

class About extends Controller {
    public function index($name = 'Husni', $job = 'programmer', $age = 22) {
        $data['judul'] = 'About me';
        $data['name'] = $name;
        $data['job'] = $job;
        $data['age'] = $age;
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }
    public function page() {
        $data['judul'] = 'Page Aneh';
        $this->view('templates/header', $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}