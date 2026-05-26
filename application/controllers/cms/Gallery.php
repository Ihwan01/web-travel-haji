<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Galeri & Film | CMS';
        $data['media'] = $this->Gallery_model->get_all();

        $this->render('cms/gallery/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Unggah Media Baru | CMS';

        $this->form_validation->set_rules('title', 'Judul Media', 'required|trim');
        $this->form_validation->set_rules('media_type', 'Tipe Media', 'required|in_list[Video,Photo]');
        $this->form_validation->set_rules('aspect_ratio', 'Rasio Aspek', 'required|in_list[Landscape,Portrait]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/gallery/create', $data);
        } else {
            $media_type = $this->input->post('media_type', TRUE);
            $folder     = $media_type === 'Video' ? 'videos' : 'photos';

            // Upload File Utama (Foto atau Video)
            $file_url = $this->_upload_file('file_url', $folder);

            if (!$file_url) {
                $this->session->set_flashdata('error_message', 'Gagal mengunggah file media utama. Pastikan format dan ukurannya sesuai.');
                $this->render('cms/gallery/create', $data);
                return;
            }

            // Upload Thumbnail (Khusus Video, opsional)
            $thumb_url = null;
            if ($media_type === 'Video' && !empty($_FILES['thumbnail_url']['name'])) {
                $thumb_url = $this->_upload_file('thumbnail_url', 'thumbs');
            }

            $save_data = [
                'title'         => $this->input->post('title', TRUE),
                'media_type'    => $media_type,
                'file_url'      => $file_url,
                'thumbnail_url' => $thumb_url,
                'aspect_ratio'  => $this->input->post('aspect_ratio', TRUE),
            ];

            $this->Gallery_model->insert($save_data);
            $this->session->set_flashdata('success_message', 'Media berhasil ditambahkan ke Galeri.');
            redirect('galleries');
        }
    }

    public function delete($id)
    {
        $media = $this->Gallery_model->get_by_id($id);

        if ($media) {
            // Hapus file fisik dari server
            if ($media->file_url && file_exists(FCPATH . $media->file_url)) {
                unlink(FCPATH . $media->file_url);
            }
            if ($media->thumbnail_url && file_exists(FCPATH . $media->thumbnail_url)) {
                unlink(FCPATH . $media->thumbnail_url);
            }

            $this->Gallery_model->delete($id);
            $this->session->set_flashdata('success_message', 'Data media berhasil dihapus.');
        }

        redirect('galleries');
    }

    private function _upload_file($field, $subfolder)
    {
        if (! isset($_FILES[$field]) || $_FILES[$field]['error'] !== 0) return null;

        // Pindahkan ke folder uploads agar seragam dengan paket dan jurnal
        $upload_path = FCPATH . 'assets/uploads/gallery/' . $subfolder . '/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|mp4|mov|webm',
            'max_size'      => 102400, // 100MB
            'file_name'     => uniqid() . '_' . time(),
        ];

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($field)) {
            // Return path relatif untuk disimpan di database
            return 'assets/uploads/gallery/' . $subfolder . '/' . $this->upload->data('file_name');
        }

        return null;
    }
}
