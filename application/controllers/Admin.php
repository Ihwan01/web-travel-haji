<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    // ── LOGIN ──────────────────────────────────────────────
    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        }
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->db->where('username', $username);
            $admin = $this->db->get('admins')->row();
            if ($admin && password_verify($password, $admin->password)) {
                $this->session->set_userdata([
                    'admin_logged_in' => TRUE,
                    'admin_username'  => $admin->username,
                    'admin_id'        => $admin->id,
                ]);
                redirect('admin/dashboard');
            } else {
                $data['error'] = 'Username atau password salah.';
                $this->load->view('admin/login', $data);
                return;
            }
        }
        $this->load->view('admin/login');
    }

    // ── DASHBOARD ─────────────────────────────────────────
    public function dashboard()
    {
        if ( ! $this->session->userdata('admin_logged_in')) redirect('admin/login');
        $data['title']     = 'Dashboard';
        $data['admin_user']= $this->session->userdata('admin_username');
        $data['total_pkg'] = $this->db->count_all('packages');
        $data['total_jrn'] = $this->db->count_all('journals');
        $data['total_fsh'] = $this->db->count_all('fashion_items');
        $data['total_gal'] = $this->db->count_all('gallery_media');
        $data['total_lead']= $this->db->count_all('leads_consultation');
        $data['recent_leads'] = $this->db->order_by('created_at','DESC')->limit(5)->get('leads_consultation')->result();
        $data['content_view'] = 'admin/dashboard';
        $this->load->view('layouts/admin', $data);
    }

    // ── LOGOUT ────────────────────────────────────────────
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
