<?php
defined('BASEPATH') or exit('No direct script access allowed');

<<<<<<< HEAD
// UBAH: dari CI_Controller menjadi Public_Controller
class Home extends Public_Controller
{
=======
class Home extends MY_Controller {
>>>>>>> origin/dev-ihwan

    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
        // Area ini siap digunakan jika Home butuh model khusus pengunjung di masa depan
=======
        $this->load->model('Package_model');
        $this->load->model('Journal_model');
>>>>>>> origin/dev-ihwan
    }

    public function index()
    {
        $data['packages'] = $this->Package_model->get_published();
        $data['journals'] = $this->Journal_model->get_published(3);
        $data['page']     = 'home';
        $data['title']    = 'Nuansa Rindu — Perjalanan Hati, Pulang Membawa Makna';
        $this->render('home/index', $data);
    }
}
