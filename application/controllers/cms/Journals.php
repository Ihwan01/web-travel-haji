<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journals extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_permission('journals');
        $this->load->model('Journal_model');
        $this->load->model('Journal_comment_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Artikel | CMS';

        // Kontributor hanya melihat artikel miliknya di tabel
        if ($this->data['role_id'] == 3) {
            $data['journals'] = $this->db->where('author_id', $this->data['admin_id'])
                ->order_by('created_at', 'DESC')
                ->get('journals')->result();
        } else {
            $data['journals'] = $this->Journal_model->get_all();
        }

        $this->render('cms/journals/index', $data);
    }

    public function create()
    {
        $this->restrict_action('journals', 'create');
        $data['title'] = 'Tulis Artikel Baru | CMS';

        $this->form_validation->set_rules('title', 'Judul Artikel', 'required|trim');
        $this->form_validation->set_rules('tags', 'Tags', 'trim');
        $this->form_validation->set_rules('content', 'Konten Artikel', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Draft,Published]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journals/create', $data);
        } else {
            $save_data = [
                'author_id'  => $this->data['admin_id'],
                'title'      => $this->input->post('title', TRUE),
                'tags'       => $this->input->post('tags', TRUE),
                'slug'       => url_title($this->input->post('title', TRUE), 'dash', TRUE),
                'content'    => $this->input->post('content'),
                'status'     => $this->input->post('status', TRUE),
                'created_at' => date('Y-m-d H:i:s')
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

        // [GEMBOK AKTIF] Cek apakah Kontributor mengedit miliknya sendiri
        $this->restrict_action('journals', 'edit', $data['journal']->author_id);

        $data['title'] = 'Edit Artikel: ' . $data['journal']->title;

        $this->form_validation->set_rules('title', 'Judul Artikel', 'required|trim');
        $this->form_validation->set_rules('tags', 'Tags', 'trim');
        $this->form_validation->set_rules('content', 'Konten Artikel', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journals/edit', $data);
        } else {
            $update_data = [
                'title'      => $this->input->post('title', TRUE),
                'tags'       => $this->input->post('tags', TRUE),
                'slug'       => url_title($this->input->post('title', TRUE), 'dash', TRUE),
                'content'    => $this->input->post('content'),
                'status'     => $this->input->post('status', TRUE),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['image']['name'])) {
                $upload = $this->_upload_image();
                if ($upload['status']) {
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
            // [GEMBOK AKTIF] Cek apakah Kontributor menghapus miliknya sendiri
            $this->restrict_action('journals', 'delete', $journal->author_id);

            if ($journal->image && file_exists(FCPATH . 'assets/uploads/journals/' . $journal->image)) {
                unlink(FCPATH . 'assets/uploads/journals/' . $journal->image);
            }
            $this->Journal_model->delete($id);
            $this->session->set_flashdata('success_message', 'Artikel berhasil dihapus.');
        }
        redirect('journals');
    }

    public function comments($journal_id)
    {
        $data['journal'] = $this->Journal_model->get_by_id($journal_id);

        // [GEMBOK AKTIF] Anggap manajemen komentar sama dengan izin edit jurnal
        $this->restrict_action('journals', 'edit', $data['journal']->author_id);

        $data['title']    = 'Kelola Komentar: ' . $data['journal']->title;
        $data['comments'] = $this->Journal_comment_model->get_by_journal($journal_id);

        $this->render('cms/journals/comments', $data);
    }

    public function approve_comment($comment_id, $journal_id, $status)
    {
        // Gembok otomatis diamankan melalui fungsi comments() karena UI tidak akan tampil
        $this->Journal_comment_model->update_status($comment_id, $status);
        $this->session->set_flashdata('success_message', 'Status komentar berhasil diubah.');
        redirect('journals/comments/' . $journal_id);
    }

    public function reply_comment($journal_id)
    {
        $reply_data = [
            'journal_id'     => $journal_id,
            'parent_id'      => $this->input->post('parent_id'),
            'name'           => $this->data['admin_user'] . ' (Admin)',
            'comment'        => $this->input->post('reply_message', TRUE),
            'is_admin_reply' => 1,
            'status'         => 'Approved'
        ];

        $this->Journal_comment_model->insert($reply_data);
        $this->session->set_flashdata('success_message', 'Balasan berhasil dikirim dan ditayangkan.');
        redirect('journals/comments/' . $journal_id);
    }

    public function delete_comment($comment_id, $journal_id)
    {
        $this->Journal_comment_model->delete($comment_id);
        $this->session->set_flashdata('success_message', 'Komentar berhasil dihapus.');
        redirect('journals/comments/' . $journal_id);
    }

    private function _upload_image()
    {
        $config['upload_path']   = FCPATH . 'assets/uploads/journals/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;
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
