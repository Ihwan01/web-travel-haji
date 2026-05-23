<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Fungsi $this->check_authentication() dari Admin_Controller otomatis bekerja di sini
    }

    public function index()
    {
        $data['title'] = 'Dasbor Eksekutif | Nuansa Rindu';

        // Mengambil data pengguna dari sesi yang aktif
        $data['username'] = $this->session->userdata('username');
        $data['role_id'] = $this->session->userdata('role_id');

        // Memanggil View berurutan: Atas - Tengah - Bawah
        $this->load->view('cms/layout/header', $data);
        $this->load->view('cms/dashboard/index', $data);
        $this->load->view('cms/layout/footer');
    }
}
