<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leads extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_permission('leads');
        $this->load->model('Lead_model');

        // Panggil Library Paginasi
        $this->load->library('pagination');
    }

    public function index()
    {
        $data['title'] = 'Konsultasi Masuk | CMS';

        // Menangkap Keyword Pencarian
        $search = $this->input->get('q', TRUE);
        $data['search'] = $search;

        // Konfigurasi Paginasi
        $config['base_url']             = base_url('leads/index');
        $config['total_rows']           = $this->Lead_model->count_all_leads($search);
        $config['per_page']             = 10; // Tampilkan 10 data per halaman
        $config['page_query_string']    = TRUE;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string']   = TRUE; // Jaga keyword pencarian saat pindah halaman

        // Styling Paginasi menggunakan Bootstrap 5
        $config['full_tag_open']   = '<ul class="pagination justify-content-center">';
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

        // Ambil halaman saat ini (offset)
        $page = $this->input->get('page') ? $this->input->get('page') : 0;

        // Eksekusi data
        $data['leads']      = $this->Lead_model->get_paginated_leads($config['per_page'], $page, $search);
        $data['pagination'] = $this->pagination->create_links();
        $data['page_number'] = $page; // Untuk penomoran tabel

        $this->render('cms/leads/index', $data);
    }

    public function delete($id)
    {
        $this->restrict_action('leads', 'delete');
        $this->Lead_model->delete($id);
        $this->session->set_flashdata('success_message', 'Pesan konsultasi berhasil dihapus.');
        redirect('leads');
    }
}
