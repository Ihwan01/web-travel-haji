<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends CI_Controller
{
    public function index()
    {
        // 1. Muat model yang diperlukan
        $this->load->model('Package_model');
        $this->load->model('Journal_model');
        $this->load->model('Fashion_model');

        // 2. Ambil semua data yang berstatus 'Published'
        $data['journeys'] = $this->Package_model->get_published();
        $data['journals'] = $this->Journal_model->get_published();
        $data['fashions'] = $this->Fashion_model->get_published();

        // 3. Set header HTTP agar browser dan bot Google membacanya sebagai XML, bukan HTML
        header("Content-Type: text/xml;charset=UTF-8");

        // 4. Render ke view
        $this->load->view('sitemap', $data);
    }
}
