<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journal extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Journal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $category_slug = $this->input->get('category');
        $category_id   = null;

        // 1. Ambil data kategori DULU sebelum menyusun kueri artikel 
        // (Hal ini mencegah bentrok pada Active Record CodeIgniter)
        if ($category_slug) {
            $cat = $this->db->get_where('journal_categories', ['slug' => $category_slug])->row();
            if ($cat) {
                $category_id = $cat->id;
            }
        }

        // 2. Menyusun Kueri Utama Artikel
        $this->db->select('journals.*, journal_categories.name as category_name');
        $this->db->from('journals'); // Dideklarasikan secara eksplisit
        $this->db->join('journal_categories', 'journal_categories.id = journals.category_id', 'left');
        $this->db->where('journals.status', 'Published');

        // Jika sedang memfilter kategori
        if ($category_id) {
            $this->db->where('journals.category_id', $category_id);
        }

        $this->db->order_by('journals.created_at', 'DESC');
        $data['journals'] = $this->db->get()->result();

        // Mengambil semua kategori untuk navigasi tab filter
        $data['categories'] = $this->db->get('journal_categories')->result();
        $data['active_category'] = $category_slug;

        $data['page']     = 'journal';
        $data['title']    = 'Journal — Nuansa Rindu';
        $this->render('journal/index', $data);
    }

    public function detail($slug)
    {
        $journal = $this->Journal_model->get_by_slug($slug);
        if (! $journal) show_404();

        $data['journal'] = $journal;
        $data['recents'] = $this->Journal_model->get_published(3);

        // Mengambil seluruh komentar yang statusnya 'Approved'
        $this->db->where('journal_id', $journal->id);
        $this->db->where('status', 'Approved');
        $this->db->order_by('created_at', 'ASC');
        $data['comments'] = $this->db->get('journal_comments')->result();

        $data['page']    = 'journal';
        $data['title']   = $journal->title . ' — Nuansa Rindu';
        $this->render('journal/detail', $data);
    }

    public function submit_comment()
    {
        if ($this->input->method() !== 'post') redirect('journal');

        $journal_id = $this->input->post('journal_id', TRUE);
        $slug       = $this->input->post('slug', TRUE);

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('comment', 'Komentar', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', validation_errors());
        } else {
            $insert_data = [
                'journal_id'     => $journal_id,
                'parent_id'      => $this->input->post('parent_id') ?: NULL,
                'name'           => $this->input->post('name', TRUE),
                'email'          => $this->input->post('email', TRUE),
                'comment'        => $this->input->post('comment', TRUE),
                'status'         => 'Pending',
                'created_at'     => date('Y-m-d H:i:s'),
                'is_admin_reply' => 0
            ];

            $this->db->insert('journal_comments', $insert_data);
            $this->session->set_flashdata('success_msg', 'Terima kasih! Komentar Anda berhasil dikirim dan akan tayang setelah ditinjau.');
        }

        redirect('journal/' . $slug . '#comments-section');
    }
}
