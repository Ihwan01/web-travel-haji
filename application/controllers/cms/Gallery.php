<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_permission('galleries');
        $this->load->model('Gallery_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Experience & Film | CMS';
        $data['media'] = $this->Gallery_model->get_all();

        $this->render('cms/gallery/index', $data);
    }

    public function create()
    {
        $this->restrict_action('galleries', 'create');
        $data['title'] = 'Unggah Media Baru | CMS';

        $this->form_validation->set_rules('title', 'Judul Media', 'required|trim');
        $this->form_validation->set_rules('media_type', 'Tipe Media', 'required|in_list[Video,Photo]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/gallery/create', $data);
        } else {
            $media_type = $this->input->post('media_type', TRUE);
            $file_url   = '';

            if ($media_type === 'Photo') {
                $upload_img = $this->_upload_file('file_url', 'photos');
                if (!$upload_img) {
                    $this->session->set_flashdata('error_message', 'Gagal mengunggah foto. Pastikan format JPG/PNG dan maksimal 2MB.');
                    $this->render('cms/gallery/create', $data);
                    return;
                }
                $file_url = $upload_img;
            } else {
                // Gunakan FALSE agar tag HTML Iframe/Blockquote dari admin tidak dipotong
                $file_url = trim($this->input->post('video_url', FALSE));
                if (empty($file_url)) {
                    $this->session->set_flashdata('error_message', 'Tautan video atau Kode Embed wajib diisi.');
                    $this->render('cms/gallery/create', $data);
                    return;
                }
            }

            $thumb_url = null;
            if (!empty($_FILES['thumbnail_url']['name'])) {
                $thumb_url = $this->_upload_file('thumbnail_url', 'thumbs');
            }

            $save_data = [
                'author_id'     => $this->data['admin_id'],
                'title'         => $this->input->post('title', TRUE),
                'media_type'    => $media_type,
                'file_url'      => $file_url,
                'thumbnail_url' => $thumb_url
            ];

            $this->Gallery_model->insert($save_data);
            $this->session->set_flashdata('success_message', 'Media berhasil ditambahkan ke Experience.');
            redirect('galleries');
        }
    }

    public function edit($id)
    {
        $data['media'] = $this->Gallery_model->get_by_id($id);
        if (!$data['media']) {
            $this->session->set_flashdata('error_message', 'Media tidak ditemukan.');
            redirect('galleries');
        }

        $this->restrict_action('galleries', 'edit', $data['media']->author_id);

        $data['title'] = 'Edit Media | CMS';

        $this->form_validation->set_rules('title', 'Judul Media', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/gallery/edit', $data);
        } else {
            $update_data = [
                'title' => $this->input->post('title', TRUE),
            ];

            if ($data['media']->media_type === 'Video') {
                // FALSE agar tag HTML tidak hilang
                $new_video = trim($this->input->post('video_url', FALSE));
                if (!empty($new_video)) $update_data['file_url'] = $new_video;

                if (!empty($_FILES['thumbnail_url']['name'])) {
                    $thumb_url = $this->_upload_file('thumbnail_url', 'thumbs');
                    if ($thumb_url) $update_data['thumbnail_url'] = $thumb_url;
                }
            } else {
                if (!empty($_FILES['file_url']['name'])) {
                    $upload_img = $this->_upload_file('file_url', 'photos');
                    if ($upload_img) $update_data['file_url'] = $upload_img;
                }
            }

            $this->Gallery_model->update($id, $update_data);
            $this->session->set_flashdata('success_message', 'Media berhasil diperbarui.');
            redirect('galleries');
        }
    }

    public function delete($id)
    {
        $gallery = $this->Gallery_model->get_by_id($id);

        if ($gallery) {
            $this->restrict_action('galleries', 'delete', $gallery->author_id);
            $this->Gallery_model->delete($id);
            $this->session->set_flashdata('success_message', 'Media berhasil dihapus.');
        }
        redirect('galleries');
    }

    private function _upload_file($field, $subfolder)
    {
        if (! isset($_FILES[$field]) || $_FILES[$field]['error'] !== 0) return null;

        $upload_path = FCPATH . 'assets/uploads/gallery/' . $subfolder . '/';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|webp|mp4|mov|webm',
            'max_size'      => 2048, // Max 2MB
            'file_name'     => uniqid() . '_' . time(),
        ];

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($field)) {
            return 'assets/uploads/gallery/' . $subfolder . '/' . $this->upload->data('file_name');
        }

        return null;
    }

    public function bulk_action()
    {
        $action = $this->input->post('action');
        $ids = $this->input->post('ids');

        if (empty($ids)) {
            $this->session->set_flashdata('error_message', 'Tidak ada data galeri yang dipilih.');
            redirect('galleries');
        }

        if ($action == 'delete') {
            $deleted_count = 0;
            foreach ($ids as $id) {
                $item = $this->Gallery_model->get_by_id($id);
                if ($item) {
                    // Proteksi role 3 seperti jurnal
                    if ($this->data['role_id'] == 3 && $item->author_id != $this->data['admin_id']) {
                        continue;
                    }

                    // Hapus file fisik gambar (sesuaikan 'file_name' atau 'thumbnail' dengan DB Anda)
                    if ($item->file_name && file_exists(FCPATH . 'assets/uploads/gallery/' . $item->file_name)) {
                        unlink(FCPATH . 'assets/uploads/gallery/' . $item->file_name);
                    }

                    $this->Gallery_model->delete($id);
                    $deleted_count++;
                }
            }
            if ($deleted_count > 0) {
                $this->session->set_flashdata('success_message', $deleted_count . ' data galeri berhasil dihapus.');
            }
        }
        redirect('galleries');
    }
}
