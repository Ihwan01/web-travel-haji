<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage_settings extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Hanya Super Admin yang diizinkan masuk
        $this->require_role([1]);
        $this->load->model('Homepage_settings_model');
    }

    public function index()
    {
        $data['title']    = 'Pengaturan Halaman Depan | CMS';
        $data['settings'] = $this->Homepage_settings_model->get_settings();

        $this->render('cms/homepage_settings/index', $data);
    }

    public function update()
    {
        $data = [
            'show_journey'     => $this->input->post('show_journey') ? 1 : 0,
            'show_fashion'     => $this->input->post('show_fashion') ? 1 : 0,
            'hero_type'        => $this->input->post('hero_type', TRUE),
            'hero_media_type'  => $this->input->post('hero_media_type', TRUE),
            'hero_tagline'     => $this->input->post('hero_tagline', TRUE),
            'hero_title'       => $this->input->post('hero_title'),
            'hero_desc'        => $this->input->post('hero_desc'),
            'hero_btn1_text'   => $this->input->post('hero_btn1_text', TRUE),
            'hero_btn1_url'    => $this->input->post('hero_btn1_url', TRUE),
            'hero_btn2_text'   => $this->input->post('hero_btn2_text', TRUE),
            'hero_btn2_url'    => $this->input->post('hero_btn2_url', TRUE),
            'about_title'      => $this->input->post('about_title'),
            'about_desc'       => $this->input->post('about_desc'),
            'about_media_type' => $this->input->post('about_media_type', TRUE),
        ];

        // LOGIKA PENYIMPANAN MEDIA HERO
        if ($data['hero_media_type'] === 'Video') {
            $data['hero_media'] = $this->input->post('hero_video_link', TRUE);
        } else {
            // Upload file foto (Maks 2MB)
            if (!empty($_FILES['hero_photo']['name'])) {
                $upload = $this->_upload_image('hero_photo');
                if ($upload) $data['hero_media'] = $upload;
            }
        }

        // LOGIKA PENYIMPANAN MEDIA ABOUT US
        if ($data['about_media_type'] === 'Video') {
            $data['about_media'] = $this->input->post('about_video_link', TRUE);
        } else {
            // Upload file foto (Maks 2MB)
            if (!empty($_FILES['about_photo']['name'])) {
                $upload = $this->_upload_image('about_photo');
                if ($upload) $data['about_media'] = $upload;
            }
        }

        $this->Homepage_settings_model->update($data);
        $this->session->set_flashdata('success_message', 'Pengaturan beranda berhasil disimpan.');
        redirect('homepage_settings');
    }

    private function _upload_image($field_name)
    {
        $upload_path = FCPATH . 'assets/uploads/homepage/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048; // Aturan batas upload 2MB (Bisa diubah jika perlu)
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($field_name)) {
            return 'assets/uploads/homepage/' . $this->upload->data('file_name');
        }
        return false;
    }
}
