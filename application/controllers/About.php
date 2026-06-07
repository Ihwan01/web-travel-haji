<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends MY_Controller
{
    public function index()
    {
        $data['page']  = 'about';
        $data['title'] = 'Tentang Kami — Nuansa Rindu';
        $data['assets_url'] = base_url('assets/');
        $this->render('about/index', $data);
    }
}
