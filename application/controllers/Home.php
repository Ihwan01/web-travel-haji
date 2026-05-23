<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->model('Journal_model');
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
