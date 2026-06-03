<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lead_model');
        $this->load->model('Package_model');
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
        
        // [TAMBAHAN] Validasi untuk field message
        $this->form_validation->set_rules('message',          'Pesan',          'trim'); 

        if ($this->form_validation->run() === FALSE) {
            redirect('contact');
        }

        $clean_client_wa = normalize_whatsapp($this->input->post('whatsapp_number', TRUE));
        $client_message  = $this->input->post('message', TRUE);

        // [TAMBAHAN] Masukkan message ke dalam database
        $this->Lead_model->insert([
            'client_name'      => $this->input->post('client_name', TRUE),
            'whatsapp_number'  => $clean_client_wa,
            'package_interest' => $this->input->post('package_interest', TRUE),
            'message'          => $client_message // Pastikan kolom 'message' ada di tabel leads
        ]);

        $company = $this->data['company'];
        $company_wa = !empty($company->whatsapp) ? normalize_whatsapp($company->whatsapp) : '6281188889326';

        $default_msg = 'Assalamu\'alaikum Nuansa Rindu.';
        $base_msg = !empty($company->whatsapp_message) ? $company->whatsapp_message : $default_msg;

        // [TAMBAHAN] Sisipkan pesan opsional ke dalam WhatsApp Admin jika jamaah mengisinya
        $final_msg = $base_msg . "\n\n*Detail Calon Jamaah:*\n- Nama: " . $this->input->post('client_name', TRUE) . "\n- Minat: " . $this->input->post('package_interest', TRUE);
        
        if (!empty($client_message)) {
            $final_msg .= "\n- Pesan: " . $client_message;
        }

        $final_msg = urlencode($final_msg);

        redirect('https://wa.me/' . $company_wa . '?text=' . $final_msg);
    }
}