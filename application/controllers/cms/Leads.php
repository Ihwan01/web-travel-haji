<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leads extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->require_permission('leads');
        // Memuat Lead_model yang sudah Anda siapkan
        $this->load->model('Lead_model');
    }

    // Menampilkan daftar pesan masuk
    public function index()
    {
        $data['title'] = 'Konsultasi Masuk | CMS';
        $data['leads'] = $this->Lead_model->get_all();

        // Menggunakan render() agar otomatis terbungkus layout dan navbar CMS
        $this->render('cms/leads/index', $data);
    }

    // Menghapus pesan
    public function delete($id)
    {
        $this->Lead_model->delete($id);
        $this->session->set_flashdata('success_message', 'Pesan konsultasi berhasil dihapus.');
        redirect('leads');
    }
}
