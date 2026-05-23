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
 * Gabungan: Proteksi RBAC (Anda) + Tata Letak Khusus Admin (Ihwan)
 */
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // 1. Eksekusi Proteksi Berlapis (Kode Anda)
        $this->check_authentication();

        // 2. Siapkan data untuk layout Ihwan, TAPI menggunakan variabel sesi Anda ('username')
        $this->data['admin_user'] = $this->session->userdata('username');
    }

    // Fungsi Validasi Sesi (KEMBALI MENGGUNAKAN STANDAR ANDA: 'is_logged_in')
    private function check_authentication()
    {
        // 1. Ambil URL yang sedang diakses saat ini
        $current_url = uri_string();

        // 2. Jika URL mengandung kata 'auth' (berarti sedang di halaman login/logout), biarkan lolos
        if (strpos($current_url, 'auth') !== false) {
            return;
        }

        // 3. Jika bukan di halaman auth dan belum login, lempar ke login
        if (!$this->session->userdata('is_logged_in')) {
            redirect('cms/auth/login');
        }
    }

    // Fungsi Pembatasan Hak Akses (Kode Anda - Tetap)
    protected function require_role(array $allowed_roles)
    {
        $current_user_role = (int) $this->session->userdata('role_id');
        if (!in_array($current_user_role, $allowed_roles, true)) {
            show_error('Mohon maaf, Anda tidak memiliki otoritas untuk mengakses area spesifik ini.', 403, 'Akses Terbatas');
        }
    }

    /**
     * Menimpa (Override) fungsi render khusus untuk halaman Admin (Kode Ihwan)
     */
    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('layouts/admin', $data);
    }
}
