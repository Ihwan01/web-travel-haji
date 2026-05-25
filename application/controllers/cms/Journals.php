<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journals extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Journal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']    = 'Manajemen Artikel (Journal) | CMS';
        $data['journals'] = $this->Journal_model->get_all();

        $this->render('cms/journals/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tulis Artikel Baru | CMS';

        $this->form_validation->set_rules('title', 'Judul Artikel', 'required|trim');
        $this->form_validation->set_rules('content', 'Konten Artikel', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Draft,Published]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journals/create', $data);
        } else {
            $save_data = [
                'title'   => $this->input->post('title', TRUE),
                'slug'    => url_title($this->input->post('title', TRUE), 'dash', TRUE),
                'content' => $this->input->post('content'),
                'status'  => $this->input->post('status', TRUE)
            ];

            if (!empty($_FILES['image']['name'])) {
                $upload_img = $this->_upload_image();
                if ($upload_img['status']) {
                    $save_data['image'] = $upload_img['file_name'];
                } else {
                    $this->session->set_flashdata('error_message', $upload_img['error']);
                    $this->render('cms/journals/create', $data);
                    return;
                }
            }

            $this->Journal_model->insert($save_data);
            $this->session->set_flashdata('success_message', 'Artikel berhasil diterbitkan.');
            redirect('journals');
        }
    }

    public function edit($id)
    {
        $data['journal'] = $this->Journal_model->get_by_id($id);
        if (!$data['journal']) {
            $this->session->set_flashdata('error_message', 'Artikel tidak ditemukan.');
            redirect('journals');
        }

        $data['title'] = 'Edit Artikel: ' . $data['journal']->title;

        $this->form_validation->set_rules('title', 'Judul Artikel', 'required|trim');
        $this->form_validation->set_rules('content', 'Konten Artikel', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journals/edit', $data);
        } else {
            $update_data = [
                'title'   => $this->input->post('title', TRUE),
                'slug'    => url_title($this->input->post('title', TRUE), 'dash', TRUE),
                'content' => $this->input->post('content'),
                'status'  => $this->input->post('status', TRUE)
            ];

            if (!empty($_FILES['image']['name'])) {
                $upload = $this->_upload_image();
                if ($upload['status']) {
                    // Hapus gambar lama jika ada
                    if ($data['journal']->image && file_exists(FCPATH . 'assets/uploads/journals/' . $data['journal']->image)) {
                        unlink(FCPATH . 'assets/uploads/journals/' . $data['journal']->image);
                    }
                    $update_data['image'] = $upload['file_name'];
                } else {
                    $this->session->set_flashdata('error_message', $upload['error']);
                    $this->render('cms/journals/edit', $data);
                    return;
                }
            }

            $this->Journal_model->update($id, $update_data);
            $this->session->set_flashdata('success_message', 'Artikel berhasil diperbarui.');
            redirect('journals');
        }
    }

    public function delete($id)
    {
        $journal = $this->Journal_model->get_by_id($id);

        if ($journal) {
            // Hapus gambar dari folder server
            if ($journal->image && file_exists(FCPATH . 'assets/uploads/journals/' . $journal->image)) {
                unlink(FCPATH . 'assets/uploads/journals/' . $journal->image);
            }
            $this->Journal_model->delete($id);
            $this->session->set_flashdata('success_message', 'Artikel berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error_message', 'Artikel tidak ditemukan.');
        }

        redirect('journals');
    }

    private function _upload_image()
    {
        // Menggunakan FCPATH untuk keamanan absolute path
        $config['upload_path']   = FCPATH . 'assets/uploads/journals/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        // Otomatis membuat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return ['status' => true, 'file_name' => $this->upload->data('file_name')];
        } else {
            return ['status' => false, 'error' => $this->upload->display_errors('', '')];
        }
    }
}
