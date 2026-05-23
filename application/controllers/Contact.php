<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lead_model');
        $this->load->model('Package_model');
    }

    public function index()
    {
        $data['packages'] = $this->Package_model->get_published();
        $data['page']     = 'contact';
        $data['title']    = 'Konsultasi Privat — Nuansa Rindu';
        $this->render('contact/index', $data);
    }

    public function send()
    {
        if ($this->input->method() !== 'post') redirect('contact');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('client_name',      'Nama',           'required|trim');
        $this->form_validation->set_rules('whatsapp_number',  'WhatsApp',       'required|trim');
        $this->form_validation->set_rules('package_interest', 'Paket Diminati', 'trim');

        if ($this->form_validation->run() === FALSE) {
            redirect('contact');
        }

        $this->Lead_model->insert([
            'client_name'      => $this->input->post('client_name'),
            'whatsapp_number'  => $this->input->post('whatsapp_number'),
            'package_interest' => $this->input->post('package_interest'),
        ]);

        // Redirect ke WhatsApp
        $wa_number = '628xxxxxxxxxx'; // ganti dengan nomor WA Nuansa Rindu
        $message   = urlencode('Assalamu\'alaikum, saya ' . $this->input->post('client_name') . ' ingin berkonsultasi mengenai ' . $this->input->post('package_interest'));
        redirect('https://wa.me/' . $wa_number . '?text=' . $message);
    }
}
