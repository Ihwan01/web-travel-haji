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

        if ($this->data['role_id'] == 3) {
            $data['journals'] = $this->Journal_model->get_by_author($this->data['admin_id']);
        } else {
            $data['journals'] = $this->Journal_model->get_all();
        }
        $this->render('cms/journals/index', $data);
    }

    public function create()
    {
        $this->restrict_action('journals', 'create');
        $data['title'] = 'Tulis Artikel Baru | CMS';
        $data['categories'] = $this->Journal_model->get_categories();

        // Aturan validasi dengan pesan eror bahasa Indonesia
        $this->form_validation->set_rules('title', 'Judul Artikel', 'required|trim', [
            'required' => '%s wajib diisi.'
        ]);
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|numeric', [
            'required' => '%s wajib dipilih.'
        ]);
        $this->form_validation->set_rules('tags', 'Tags', 'trim');
        $this->form_validation->set_rules('content', 'Konten Artikel', 'required', [
            'required' => '%s wajib diisi.'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Draft,Published]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journals/create', $data);
        } else {
            // [PERBAIKAN] Validasi wajib upload gambar sampul
            if (empty($_FILES['image']['name'])) {
                $data['error_upload'] = 'Gambar Sampul wajib diunggah untuk artikel baru.';
                $this->render('cms/journals/create', $data);
                return;
            }

            $save_data = [
                'author_id'   => $this->data['admin_id'],
                'category_id' => $this->input->post('category_id', TRUE),
                'title'       => $this->input->post('title', TRUE),
                'tags'        => $this->input->post('tags', TRUE),
                'slug'        => url_title($this->input->post('title', TRUE), 'dash', TRUE),
                'content'     => $this->input->post('content'),
                'status'      => $this->input->post('status', TRUE),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['image']['name'])) {
                $upload_img = $this->_upload_image();
                if ($upload_img['status']) {
                    $save_data['image'] = $upload_img['file_name'];
                } else {
                    // [PERBAIKAN] Mencegah Flashdata Leak
                    $data['error_upload'] = 'Upload gagal: ' . $upload_img['error'];
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

        $this->restrict_action('journals', 'edit', $data['journal']->author_id);

        $data['title'] = 'Edit Artikel: ' . $data['journal']->title;
        $data['categories'] = $this->Journal_model->get_categories();

        $this->form_validation->set_rules('title', 'Judul Artikel', 'required|trim', [
            'required' => '%s wajib diisi.'
        ]);
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|numeric', [
            'required' => '%s wajib dipilih.'
        ]);
        $this->form_validation->set_rules('tags', 'Tags', 'trim');
        $this->form_validation->set_rules('content', 'Konten Artikel', 'required', [
            'required' => '%s wajib diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journals/edit', $data);
        } else {
            $update_data = [
                'category_id' => $this->input->post('category_id', TRUE),
                'title'       => $this->input->post('title', TRUE),
                'tags'        => $this->input->post('tags', TRUE),
                'slug'        => url_title($this->input->post('title', TRUE), 'dash', TRUE),
                'content'     => $this->input->post('content'),
                'status'      => $this->input->post('status', TRUE),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['image']['name'])) {
                $upload = $this->_upload_image();
                if ($upload['status']) {
                    if ($data['journal']->image && file_exists(FCPATH . 'assets/uploads/journals/' . $data['journal']->image)) {
                        unlink(FCPATH . 'assets/uploads/journals/' . $data['journal']->image);
                    }
                    $update_data['image'] = $upload['file_name'];
                } else {
                    // [PERBAIKAN] Mencegah Flashdata Leak
                    $data['error_upload'] = 'Upload gagal: ' . $upload['error'];
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
            $this->restrict_action('journals', 'delete', $journal->author_id);

            if ($journal->image && file_exists(FCPATH . 'assets/uploads/journals/' . $journal->image)) {
                unlink(FCPATH . 'assets/uploads/journals/' . $journal->image);
            }
            $this->Journal_model->delete($id);
            $this->session->set_flashdata('success_message', 'Artikel berhasil dihapus.');
        }
        redirect('journals');
    }

    // ===============================================
    // MANAJEMEN KOMENTAR & KATEGORI (TIDAK ADA PERUBAHAN)
    // ===============================================

    public function comments($journal_id)
    {
        $data['journal'] = $this->Journal_model->get_by_id($journal_id);
        $this->restrict_action('journals', 'edit', $data['journal']->author_id);
        $data['title']    = 'Kelola Komentar: ' . $data['journal']->title;
        $data['comments'] = $this->Journal_comment_model->get_by_journal($journal_id);
        $this->render('cms/journals/comments', $data);
    }

    public function all_comments()
    {
        $data['title'] = 'Semua Komentar (Global) | CMS';
        $status = $this->input->get('status') ?: 'all';
        $limit  = $this->input->get('limit') ?: 10;
        $page   = $this->input->get('page') ?: 0;
        $author_id = ($this->data['role_id'] == 3) ? $this->data['admin_id'] : null;

        $data['current_status'] = $status;
        $data['current_limit']  = $limit;

        $this->load->library('pagination');
        $config['base_url']             = base_url('journals/all_comments');
        $config['total_rows']           = $this->Journal_comment_model->count_all_paginated($status, $author_id);
        $config['per_page']             = $limit;
        $config['page_query_string']    = TRUE;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string']   = TRUE;

        $config['full_tag_open']   = '<ul class="pagination justify-content-center m-0">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = 'Pertama';
        $config['last_link']       = 'Terakhir';
        $config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link']       = '&laquo;';
        $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['next_link']       = '&raquo;';
        $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '</span></li>';
        $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']   = '</span></li>';
        $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']   = '</span></li>';

        $this->pagination->initialize($config);

        $data['comments']   = $this->Journal_comment_model->get_paginated_comments($limit, $page, $status, $author_id);
        $data['pagination'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];

        $this->render('cms/journals/all_comments', $data);
    }

    public function approve_comment($comment_id, $journal_id, $status)
    {
        $this->Journal_comment_model->update_status($comment_id, $status);
        $this->session->set_flashdata('success_message', 'Status komentar berhasil diubah.');
        if ($this->input->get('ref') == 'all') redirect('journals/all_comments');
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
        if ($this->input->post('ref') == 'all') redirect('journals/all_comments');
        redirect('journals/comments/' . $journal_id);
    }

    public function delete_comment($comment_id, $journal_id)
    {
        $this->Journal_comment_model->delete($comment_id);
        $this->session->set_flashdata('success_message', 'Komentar berhasil dihapus.');
        if ($this->input->get('ref') == 'all') redirect('journals/all_comments');
        redirect('journals/comments/' . $journal_id);
    }

    private function _upload_image()
    {
        $config['upload_path']   = FCPATH . 'assets/uploads/journals/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;
        if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, true);

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            return ['status' => true, 'file_name' => $this->upload->data('file_name')];
        } else {
            // [PERBAIKAN] Hapus tag HTML pada pesan eror upload bawaan
            return ['status' => false, 'error' => strip_tags($this->upload->display_errors('', ''))];
        }
    }

    public function categories()
    {
        $data['title'] = 'Manajemen Kategori | CMS';
        $data['categories'] = $this->Journal_model->get_categories();
        $this->render('cms/journals/categories', $data);
    }

    public function add_category()
    {
        $name = $this->input->post('name', TRUE);
        $slug = url_title($name, 'dash', TRUE);
        if (!empty($name)) {
            $this->db->insert('journal_categories', ['name' => $name, 'slug' => $slug]);
            $insert_id = $this->db->insert_id();
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'success', 'id' => $insert_id, 'name' => $name]);
                return;
            }
            $this->session->set_flashdata('success_message', 'Kategori baru berhasil ditambahkan.');
        }
        redirect('journals/categories');
    }

    public function delete_category($id)
    {
        $this->db->where('category_id', $id)->update('journals', ['category_id' => NULL]);
        $this->db->where('id', $id)->delete('journal_categories');
        $this->session->set_flashdata('success_message', 'Kategori berhasil dihapus.');
        redirect('journals/categories');
    }

    public function bulk_action()
    {
        $action = $this->input->post('action');
        $ids = $this->input->post('ids');

        if (empty($ids)) {
            $this->session->set_flashdata('error_message', 'Tidak ada artikel yang dipilih.');
            redirect('journals');
        }

        $success_count = 0;

        foreach ($ids as $id) {
            $journal = $this->Journal_model->get_by_id($id);
            if ($journal) {
                // Proteksi Hak Akses (Kontributor hanya bisa proses miliknya sendiri)
                if ($this->data['role_id'] == 3 && $journal->author_id != $this->data['admin_id']) {
                    continue;
                }

                if ($action == 'delete') {
                    if ($journal->image && file_exists(FCPATH . 'assets/uploads/journals/' . $journal->image)) {
                        unlink(FCPATH . 'assets/uploads/journals/' . $journal->image);
                    }
                    $this->Journal_model->delete($id);
                    $success_count++;
                } elseif ($action == 'publish') {
                    $this->Journal_model->update($id, ['status' => 'Published']);
                    $success_count++;
                } elseif ($action == 'draft') {
                    $this->Journal_model->update($id, ['status' => 'Draft']);
                    $success_count++;
                }
            }
        }

        if ($success_count > 0) {
            $msg = '';
            if ($action == 'delete') $msg = $success_count . ' artikel berhasil dihapus.';
            if ($action == 'publish') $msg = $success_count . ' artikel berhasil diterbitkan (Published).';
            if ($action == 'draft') $msg = $success_count . ' artikel berhasil diubah menjadi Draf.';

            $this->session->set_flashdata('success_message', $msg);
        } else {
            $this->session->set_flashdata('error_message', 'Aksi ditolak. Anda tidak memiliki izin untuk mengubah data yang dipilih.');
        }

        redirect('journals');
    }
}
