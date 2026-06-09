<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fashion extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
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

    // [BARU] Fungsi untuk memuat halaman detail
    public function detail($slug = null)
    {
        if (!$slug) show_404();

        $item = $this->Fashion_model->get_by_slug($slug);
        if (!$item || $item->status !== 'Published') {
            show_404();
        }

        $data['item'] = $item;
        $data['page'] = 'fashion-detail'; // Akan memanggil fashion-detail.css
        $data['title'] = $item->name . ' — Nuansa Rindu';

        $this->render('fashion/detail', $data);
    }
}
