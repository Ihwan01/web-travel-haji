<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
    }
    public function index()
    {
        $data['media'] = $this->Gallery_model->get_all();
        $data['page']  = 'gallery';
        $data['title'] = 'Experience — Nuansa Rindu';
        $this->render('gallery/index', $data);
    }
}
