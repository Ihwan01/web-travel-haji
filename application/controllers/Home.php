<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Home Controller — Halaman Depan Publik
 * Gabungan: Public_Controller (Versi Anda) + Data & Render Tampilan (Versi Ihwan)
 */
class Home extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat model paket dan jurnal untuk kebutuhan tampilan halaman depan (Versi Ihwan)
        $this->load->model('Package_model');
        $this->load->model('Journal_model');
    }

    public function index()
    {
        // Menarik data konten yang akan ditampilkan di frontend (Versi Ihwan)
        $data['packages'] = $this->Package_model->get_published();
        $data['journals'] = $this->Journal_model->get_published(3);
        $data['page']     = 'home';
        $data['title']    = 'Nuansa Rindu — Perjalanan Hati, Pulang Membawa Makna';

        // Render menggunakan layouting otomatis (Versi Ihwan)
        $this->render('home/index', $data);
    }
}
