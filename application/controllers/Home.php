<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->model('Journal_model');

        // [BARU] Memanggil Model Gallery dan Helper Embed untuk kebutuhan Visual Story
        $this->load->model('Gallery_model');
        $this->load->helper('embed');
    }

    public function index()
    {
        $data['packages'] = $this->Package_model->get_published();
        $data['journals'] = $this->Journal_model->get_published(3);

        // [BARU] Mengambil 5 data media terbaru dari tabel gallery_media untuk Visual Story
        $data['latest_media'] = $this->db->order_by('id', 'DESC')->limit(5)->get('gallery_media')->result();

        $data['page']     = 'home';

        // Tarik data Slides untuk Hero Section
        $data['hero_slides'] = $this->db->order_by('sort_order', 'ASC')->get('hero_slides')->result();

        $site_title = isset($this->data['site_settings']->hero_tagline) ? $this->data['site_settings']->hero_tagline : 'Nuansa Rindu — Perjalanan Hati, Pulang Membawa Makna';
        $data['title'] = $site_title;

        $this->render('home/index', $data);
    }
}
