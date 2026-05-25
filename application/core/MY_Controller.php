<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MY_Controller — Pengontrol Induk Utama
 * Gabungan: Variabel global (Ihwan) + Struktur Dasar (Anda)
 */
class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        // Data global agar selalu tersedia di semua antarmuka (View)
        $this->data['base_url']    = base_url();
        $this->data['assets_url']  = base_url('assets/');
        $this->data['current_url'] = current_url();
    }

    /**
     * Render view dengan layout publik utama
     */
    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('layouts/main', $data);
    }
}

/**
 * Public_Controller — Pengontrol Halaman Pengunjung (Frontend)
 */
class Public_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

/**
 * Admin_Controller — Pengontrol Khusus Dasbor (CMS)
 */
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 1. Eksekusi Proteksi Berlapis
        $this->check_authentication();

        // 2. Siapkan data global untuk layout CMS
        $this->data['admin_user'] = $this->session->userdata('username');

        // [BARU] Injeksi role_id agar selalu tersedia di navigasi header
        $this->data['role_id']    = (int) $this->session->userdata('role_id');
    }

    private function check_authentication()
    {
        $current_url = uri_string();

        if (strpos($current_url, 'auth') !== false) {
            return;
        }

        if (!$this->session->userdata('is_logged_in')) {
            // [DIUBAH] Menggunakan rute URL Bersih
            redirect('login');
        }
    }

    /**
     * [DIUBAH] Fungsi Pembatasan Hak Akses menggunakan Redirect untuk UI/UX yang lebih baik
     */
    protected function require_role(array $allowed_roles)
    {
        if (!in_array($this->data['role_id'], $allowed_roles, true)) {
            $this->session->set_flashdata('error_message', 'Mohon maaf, Anda tidak memiliki otoritas untuk mengakses area spesifik ini.');
            redirect('dashboard');
        }
    }

    /**
     * [DIUBAH] Menimpa fungsi render khusus untuk halaman Admin
     * Kini menggunakan layout Wrapper kita yang baru.
     */
    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;

        // Memanggil Wrapper sebagai fondasi utama layout CMS
        $this->load->view('cms/layout/wrapper', $data);
    }
}
