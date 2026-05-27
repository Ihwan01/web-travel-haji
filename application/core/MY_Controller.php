<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->data['base_url']    = base_url();
        $this->data['assets_url']  = base_url('assets/');
        $this->data['current_url'] = current_url();

        if ($this->db->table_exists('homepage_settings')) {
            $settings = $this->db->get('homepage_settings')->row();
            $this->data['site_settings'] = $settings;
            $this->data['show_journey']  = $settings ? $settings->show_journey : 1;
            $this->data['show_fashion']  = $settings ? $settings->show_fashion : 1;
        } else {
            $this->data['site_settings'] = null;
            $this->data['show_journey']  = 1;
            $this->data['show_fashion']  = 1;
        }
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('layouts/main', $data);
    }
}

class Public_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
}

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_authentication();

        $this->data['admin_user'] = $this->session->userdata('username');
        $this->data['role_id']    = (int) $this->session->userdata('role_id');

        // [PERBAIKAN LOGIKA] Proteksi Ketat Hak Akses Modul
        if ($this->data['role_id'] === 1) {
            // Jika Super Admin, otomatis buka semua pintu
            $this->data['allowed_modules'] = ['journeys', 'journals', 'galleries', 'fashions', 'leads'];
        } else {
            // Antisipasi jika aplikasi Anda menggunakan key session 'id' atau 'admin_id'
            $session_id = $this->session->userdata('id') ? $this->session->userdata('id') : $this->session->userdata('admin_id');

            if ($session_id) {
                // MEMPERBAIKI: Memanggil ke tabel 'admins', bukan 'users'
                $user = $this->db->select('allowed_modules')
                    ->where('id', $session_id)
                    ->get('admins')
                    ->row();

                // Masukkan izin ke dalam array, jika kosong set jadi array kosong (tidak punya akses apapun)
                $this->data['allowed_modules'] = ($user && $user->allowed_modules) ? explode(',', $user->allowed_modules) : [];
            } else {
                $this->data['allowed_modules'] = [];
            }
        }
    }

    private function check_authentication()
    {
        $current_url = uri_string();
        if (strpos($current_url, 'auth') !== false) return;
        if (!$this->session->userdata('is_logged_in')) redirect('login');
    }

    protected function require_role(array $allowed_roles)
    {
        if (!in_array($this->data['role_id'], $allowed_roles, true)) {
            $this->session->set_flashdata('error_message', 'Akses ditolak.');
            redirect('dashboard');
        }
    }

    // [PERBAIKAN LOGIKA] Fungsi pemeriksaan izin modul
    protected function require_permission($module_name)
    {
        // Super admin bebas hambatan
        if ($this->data['role_id'] === 1) return;

        // Jika nama modul tidak ada di dalam list allowed_modules milik user, BLOKIR!
        if (!isset($this->data['allowed_modules']) || !in_array($module_name, $this->data['allowed_modules'])) {
            $this->session->set_flashdata('error_message', 'Mohon maaf, Anda tidak memiliki izin untuk mengelola modul ' . ucfirst($module_name) . '.');
            redirect('dashboard');
            exit; // Kunci script agar tidak mengeksekusi kode di bawahnya
        }
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('cms/layout/wrapper', $data);
    }
}
