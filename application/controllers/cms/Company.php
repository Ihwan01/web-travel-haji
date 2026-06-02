<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        // [MODIFIKASI] Modul dinonaktifkan sementara (Akses URL dikunci)
        show_404();

        // Proteksi mutlak: Hanya Super Admin
        if ($this->data['role_id'] != 1) {
            $this->session->set_flashdata('error_message', 'Akses Ditolak. Hanya Super Admin yang dapat mengakses Pengaturan Kontak Global.');
            redirect('dashboard');
            exit;
        }

        $this->load->model('Company_model');

        // [BARU] Muat Helper WhatsApp
        $this->load->helper('whatsapp');
    }

    public function index()
    {
        $data['title']   = 'Pengaturan Profil & Kontak | CMS';
        $data['company'] = $this->Company_model->get_profile();

        $this->render('cms/company/index', $data);
    }

    public function update()
    {
        $data = [
            'company_name'       => $this->input->post('company_name', TRUE),
            'email'              => $this->input->post('email', TRUE),
            'whatsapp'           => normalize_whatsapp($this->input->post('whatsapp', TRUE)),
            'whatsapp_message'   => $this->input->post('whatsapp_message', TRUE),
            'phone'              => $this->input->post('phone', TRUE),
            'address'            => $this->input->post('address', TRUE),
            'instagram_url'      => $this->input->post('instagram_url', TRUE),
            'facebook_url'       => $this->input->post('facebook_url', TRUE),
            'youtube_url'        => $this->input->post('youtube_url', TRUE),

            // [PERBAIKAN BUG] Sesuaikan dengan nama kolom di database (Maps_iframe)
            'Maps_iframe'        => $this->input->post('google_maps_iframe', FALSE)
        ];

        $this->Company_model->update_profile($data);
        $this->session->set_flashdata('success_message', 'Data Profil & Kontak berhasil diperbarui.');
        redirect('company');
    }
}
