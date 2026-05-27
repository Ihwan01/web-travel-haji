<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fashion extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // [BARU] Blokir akses publik jika fitur disembunyikan
        if (empty($this->data['show_fashion'])) {
            show_404();
        }
        $this->load->model('Fashion_model');
    }

    public function index()
    {
        $data['items'] = $this->Fashion_model->get_published();
        $data['page']  = 'fashion';
        $data['title'] = 'Fashion & Essentials — Nuansa Rindu';
        $this->render('fashion/index', $data);
    }
}
