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

        // Memuat Model SEO & Company
        $this->load->model('Seo_model');
        $this->load->model('Company_model');

        // [DIPERBAIKI] Ubah nama variabel menjadi 'tracking' agar sesuai dengan main.php
        $this->data['tracking'] = $this->Seo_model->get_tracking();

        // Deteksi halaman saat ini (home, about, journey, dll)
        $current_page = $this->uri->segment(1) ? $this->uri->segment(1) : 'home';
        $meta = $this->Seo_model->get_meta_by_url($current_page);

        $this->data['seo_meta'] = $meta;

        // Timpa title default jika admin sudah mengatur meta_title khusus di CMS
        if ($meta && !empty($meta->meta_title)) {
            $this->data['title'] = $meta->meta_title;
        }

        // Tarik Data Profil & Kontak Perusahaan secara Global untuk Frontend
        $this->data['company'] = $this->Company_model->get_profile();
    }
}

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->check_authentication();

        $session_id = $this->session->userdata('admin_id');

        if ($session_id) {
            $user = $this->db->where('id', $session_id)->get('admins')->row();

            if ($user) {
                // Set data Global User
                $this->data['admin_id']        = $user->id;
                $this->data['admin_user']      = $user->username;
                $this->data['role_id']         = (int) $user->role_id;
                $this->data['profile_picture'] = $user->profile_picture;

                if ($this->data['role_id'] === 1) {
                    $this->data['allowed_modules'] = ['journeys', 'journals', 'galleries', 'fashions', 'leads'];
                } else {
                    $modules = $user->allowed_modules ? explode(',', $user->allowed_modules) : [];

                    // [FITUR BARU] Paksa modul 'Leads' agar selalu dapat diakses oleh semua user
                    if (!in_array('leads', $modules)) {
                        $modules[] = 'leads';
                    }

                    $this->data['allowed_modules'] = $modules;
                }
            } else {
                $this->session->sess_destroy();
                redirect('login');
            }
        }
    }

    private function check_authentication()
    {
        $current_url = uri_string();
        if (strpos($current_url, 'auth') !== false) return;
        if (!$this->session->userdata('is_logged_in')) redirect('login');
    }

    // FUNGSI 1: Kunci Pintu Ruangan
    protected function require_permission($module_name)
    {
        if ($this->data['role_id'] === 1) return;

        if (!in_array($module_name, $this->data['allowed_modules'])) {
            $this->session->set_flashdata('error_message', 'Anda tidak memiliki izin melihat modul ' . ucfirst($module_name) . '.');
            redirect('dashboard');
            exit;
        }
    }

    // FUNGSI 2: Kunci Tindakan Dalam Ruangan
    protected function restrict_action($module_name, $action = 'view', $item_author_id = null)
    {
        $role = $this->data['role_id'];

        if ($role === 1 || $role === 2) return true;

        if ($role === 3) {
            if (in_array($module_name, ['journeys', 'fashions', 'leads'])) {
                if ($action !== 'view') {
                    $this->session->set_flashdata('error_message', 'Akses Ditolak! Kontributor hanya diizinkan untuk melihat data pada modul ini, tidak untuk mengubah atau menghapus.');
                    redirect($_SERVER['HTTP_REFERER'] ?? 'dashboard');
                    exit;
                }
            }

            if (in_array($module_name, ['journals', 'galleries'])) {
                if ($action === 'edit' || $action === 'delete') {
                    if ($item_author_id != $this->data['admin_id']) {
                        $this->session->set_flashdata('error_message', 'Akses Ditolak! Anda hanya diizinkan mengubah atau menghapus data yang Anda buat/unggah sendiri.');
                        redirect($_SERVER['HTTP_REFERER'] ?? 'dashboard');
                        exit;
                    }
                }
            }
        }
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('cms/layout/wrapper', $data);
    }
}
