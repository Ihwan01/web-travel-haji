<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lead_model');
        $this->load->helper('whatsapp');
        $this->load->model('Package_model');
    }

    public function index()
    {
        // [KOREKSI TERBAIK] 
        // 1. Ubah variabel menjadi 'packages' agar cocok dengan HTML di View
        // 2. Gunakan Model yang sudah ada agar konsisten dengan controller lain
        $data['packages'] = $this->Package_model->get_published();

        // Variabel untuk menandai opsi mana yang dipilih jika user datang dari halaman detail (opsional)
        $data['selected_pkg'] = $this->input->get('interest');

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
        $this->form_validation->set_rules('message',          'Pesan',          'trim');

        if ($this->form_validation->run() === FALSE) {
            redirect('contact');
        }

        $clean_client_wa = normalize_whatsapp($this->input->post('whatsapp_number', TRUE));
        $client_message  = $this->input->post('message', TRUE);

        $this->Lead_model->insert([
            'client_name'      => $this->input->post('client_name', TRUE),
            'whatsapp_number'  => $clean_client_wa,
            'package_interest' => $this->input->post('package_interest', TRUE),
            'message'          => $client_message
        ]);

        $company = $this->data['company'];
        $company_wa = !empty($company->whatsapp) ? normalize_whatsapp($company->whatsapp) : '6281188889326';

        $default_msg = 'Assalamu\'alaikum Nuansa Rindu.';
        $base_msg = !empty($company->whatsapp_message) ? $company->whatsapp_message : $default_msg;

        $final_msg = $base_msg . "\n\n*Detail Calon Jamaah:*\n- Nama: " . $this->input->post('client_name', TRUE);

        if (!empty($this->input->post('package_interest'))) {
            $final_msg .= "\n- Minat: " . $this->input->post('package_interest', TRUE);
        }

        if (!empty($client_message)) {
            $final_msg .= "\n- Pesan: " . $client_message;
        }

        $final_msg = urlencode($final_msg);

        redirect('https://wa.me/' . $company_wa . '?text=' . $final_msg);
    }
}
