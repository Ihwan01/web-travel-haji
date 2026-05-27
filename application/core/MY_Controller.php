<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        // Data global
        $this->data['base_url']    = base_url();
        $this->data['assets_url']  = base_url('assets/');
        $this->data['current_url'] = current_url();

        // [BARU] Tarik data pengaturan Homepage secara global
        // Memastikan tabel ada tanpa menyebabkan eror jika belum dibuat
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
    }

    private function check_authentication()
    {
        $current_url = uri_string();
        if (strpos($current_url, 'auth') !== false) {
            return;
        }
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
        }
    }

    protected function require_role(array $allowed_roles)
    {
        if (!in_array($this->data['role_id'], $allowed_roles, true)) {
            $this->session->set_flashdata('error_message', 'Mohon maaf, Anda tidak memiliki otoritas untuk mengakses area spesifik ini.');
            redirect('dashboard');
        }
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('cms/layout/wrapper', $data);
    }
}
