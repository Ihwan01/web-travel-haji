<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seo extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Proteksi ketat: Hanya Super Admin yang boleh mengubah SEO
        $this->require_role([1]);

        $this->load->model('Seo_model');
    }

    public function index()
    {
        $data['title']    = 'Pengaturan SEO & Tracking | CMS';
        $data['tracking'] = $this->Seo_model->get_tracking();
        $data['metadata'] = $this->Seo_model->get_all_meta();

        $this->render('cms/seo/index', $data);
    }

    public function update_tracking()
    {
        $data = [
            'gsc_code'        => $this->input->post('gsc_code'),
            'ga4_code'        => $this->input->post('ga4_code'),
            'meta_pixel_code' => $this->input->post('meta_pixel_code')
        ];

        $this->Seo_model->update_tracking($data);
        $this->session->set_flashdata('success_message', 'Kode pelacakan (Tracking Codes) berhasil diperbarui.');
        redirect('seo');
    }

    public function save_meta()
    {
        $url = $this->input->post('page_url', TRUE);

        if (empty($url)) {
            $this->session->set_flashdata('error_message', 'URL Halaman tidak boleh kosong.');
            redirect('seo');
        }

        $data = [
            'meta_title'       => $this->input->post('meta_title', TRUE),
            'meta_description' => $this->input->post('meta_description', TRUE),
            'meta_keywords'    => $this->input->post('meta_keywords', TRUE)
        ];

        $this->Seo_model->save_meta($url, $data);
        $this->session->set_flashdata('success_message', 'Metadata SEO untuk halaman "' . $url . '" berhasil disimpan.');
        redirect('seo');
    }
}
