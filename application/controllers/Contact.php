<?php
defined('BASEPATH') or exit('No direct script access allowed');

// [UPDATE] Ubah dari MY_Controller ke Public_Controller agar bisa baca data $this->data['company']
class Contact extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lead_model');
        $this->load->model('Package_model');

        // [BARU] Muat Helper WhatsApp yang baru dibuat
        $this->load->helper('whatsapp');
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

        // [NORMALISASI] Bersihkan input WA dari calon jamaah sebelum masuk ke database
        $clean_client_wa = normalize_whatsapp($this->input->post('whatsapp_number', TRUE));

        $this->Lead_model->insert([
            'client_name'      => $this->input->post('client_name', TRUE),
            'whatsapp_number'  => $clean_client_wa, // Tersimpan bersih di DB: 628xxx
            'package_interest' => $this->input->post('package_interest', TRUE),
        ]);

        // [INTEGRASI KE CMS COMPANY]
        $company = $this->data['company'];
        $company_wa = !empty($company->whatsapp) ? normalize_whatsapp($company->whatsapp) : '6280000000000';

        // Menggabungkan Pesan Awalan CMS + Nama & Pilihan Paket secara otomatis!
        $default_msg = 'Assalamu\'alaikum Nuansa Rindu.';
        $base_msg = !empty($company->whatsapp_message) ? $company->whatsapp_message : $default_msg;

        $final_msg = $base_msg . "\n\n(Dari: " . $this->input->post('client_name', TRUE) . " - Minat: " . $this->input->post('package_interest', TRUE) . ")";
        $final_msg = urlencode($final_msg);

        // Alihkan (Redirect) otomatis buka WA Admin
        redirect('https://wa.me/' . $company_wa . '?text=' . $final_msg);
    }
}
