<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {
    public function index()
    {
        $data['page']  = 'about';
        $data['title'] = 'Tentang Kami — Nuansa Rindu';
        $this->render('about/index', $data);
    }
}
