<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journey extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Package_model');
    }

    public function index()
    {
        $data['packages'] = $this->Package_model->get_published();
        $data['page']     = 'journey';
        $data['title']    = 'Journey — Nuansa Rindu';
        $this->render('journey/index', $data);
    }

    public function detail($slug)
    {
        $package = $this->Package_model->get_by_slug($slug);
        if ( ! $package) show_404();

        $data['package'] = $package;
        $data['page']    = 'journey';
        $data['title']   = $package->name . ' — Nuansa Rindu';
        $this->render('journey/detail', $data);
    }
}
