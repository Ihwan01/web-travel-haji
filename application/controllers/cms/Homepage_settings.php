<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage_settings extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->require_role([1]);
        $this->load->model('Homepage_settings_model');
    }

    public function index()
    {
        $data['title']    = 'Pengaturan Halaman Depan | CMS';
        $data['settings'] = $this->Homepage_settings_model->get_settings();
        $data['slides']   = $this->Homepage_settings_model->get_slides();

        // Buat 1 slide kosong jika tabel slides masih benar-benar kosong
        if (empty($data['slides'])) {
            $data['slides'] = [(object)[
                'media_type' => 'Video',
                'media_url' => '',
                'tagline' => '',
                'title' => '',
                'desc_text' => '',
                'btn1_text' => '',
                'btn1_url' => '',
                'btn2_text' => '',
                'btn2_url' => ''
            ]];
        }

        $this->render('cms/homepage_settings/index', $data);
    }

    public function update()
    {
        // 1. Simpan Pengaturan Umum & About
        $settings_data = [
            'show_journey'       => $this->input->post('show_journey') ? 1 : 0,
            'show_fashion'       => $this->input->post('show_fashion') ? 1 : 0,
            'is_slideshow'       => $this->input->post('is_slideshow') ? 1 : 0,
            'slideshow_autoplay' => $this->input->post('slideshow_autoplay') ? 1 : 0,
            'about_title'        => $this->input->post('about_title'),
            'about_desc'         => $this->input->post('about_desc'),
            'about_media_type'   => $this->input->post('about_media_type', TRUE),
        ];

        // Media About
        if ($settings_data['about_media_type'] === 'Video') {
            $settings_data['about_media'] = $this->input->post('about_video_link', TRUE);
            // Upload Thumbnail (Jika ada)
            if (!empty($_FILES['about_video_thumbnail']['name'])) {
                $upload_thumb = $this->_upload_single_file('about_video_thumbnail');
                if ($upload_thumb) $settings_data['about_video_thumbnail'] = $upload_thumb;
            }
        } else {
            // Upload Foto Utama About
            if (!empty($_FILES['about_photo']['name'])) {
                $upload_photo = $this->_upload_single_file('about_photo');
                if ($upload_photo) $settings_data['about_media'] = $upload_photo;
            }
        }
        $this->Homepage_settings_model->update_settings($settings_data);

        // 2. Simpan Data Repeater Hero Slides
        $this->Homepage_settings_model->clear_slides(); // Bersihkan data lama

        $media_types = $this->input->post('slide_media_type');
        $video_links = $this->input->post('slide_video_link');
        $old_photos  = $this->input->post('old_slide_photo');
        $taglines    = $this->input->post('slide_tagline');
        $titles      = $this->input->post('slide_title');
        $descs       = $this->input->post('slide_desc');
        $btn1_texts  = $this->input->post('slide_btn1_text');
        $btn1_urls   = $this->input->post('slide_btn1_url');
        $btn2_texts  = $this->input->post('slide_btn2_text');
        $btn2_urls   = $this->input->post('slide_btn2_url');

        if (!empty($media_types)) {
            // Jika mode statis (is_slideshow == 0), kita HANYA memproses indeks [0] (slide pertama)
            $total_items = ($settings_data['is_slideshow'] == 1) ? count($media_types) : 1;

            for ($i = 0; $i < $total_items; $i++) {
                $media_url = '';

                if ($media_types[$i] === 'Video') {
                    $media_url = $video_links[$i];
                } else {
                    // Cek apakah ada file foto yang diunggah untuk indeks ini
                    if (!empty($_FILES['slide_photo']['name'][$i])) {
                        // Trik untuk mengelabui library upload CI3 dalam array
                        $_FILES['temp_file']['name']     = $_FILES['slide_photo']['name'][$i];
                        $_FILES['temp_file']['type']     = $_FILES['slide_photo']['type'][$i];
                        $_FILES['temp_file']['tmp_name'] = $_FILES['slide_photo']['tmp_name'][$i];
                        $_FILES['temp_file']['error']    = $_FILES['slide_photo']['error'][$i];
                        $_FILES['temp_file']['size']     = $_FILES['slide_photo']['size'][$i];

                        $upload_res = $this->_upload_single_file('temp_file');
                        $media_url = $upload_res ? $upload_res : $old_photos[$i];
                    } else {
                        $media_url = isset($old_photos[$i]) ? $old_photos[$i] : '';
                    }
                }

                $slide_data = [
                    'media_type' => $media_types[$i],
                    'media_url'  => $media_url,
                    'tagline'    => $taglines[$i],
                    'title'      => $titles[$i],
                    'desc_text'  => $descs[$i],
                    'btn1_text'  => $btn1_texts[$i],
                    'btn1_url'   => $btn1_urls[$i],
                    'btn2_text'  => $btn2_texts[$i],
                    'btn2_url'   => $btn2_urls[$i],
                    'sort_order' => $i
                ];
                $this->Homepage_settings_model->insert_slide($slide_data);
            }
        }

        $this->session->set_flashdata('success_message', 'Pengaturan beranda berhasil diperbarui.');
        redirect('homepage_settings');
    }

    private function _upload_single_file($field_name)
    {
        $upload_path = FCPATH . 'assets/uploads/homepage/';
        if (!is_dir($upload_path)) mkdir($upload_path, 0777, true);

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048; // Max 2MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($field_name)) {
            return 'assets/uploads/homepage/' . $this->upload->data('file_name');
        }
        return false;
    }
}
