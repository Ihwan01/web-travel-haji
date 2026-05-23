<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');

        // MEMUAT PUSTAKA VALIDASI FORMULIR
        $this->load->library('form_validation');
    }

    public function login()
    {
        // Sesi hanya diperiksa saat seseorang mencoba mengakses halaman login
        if ($this->session->userdata('is_logged_in')) {
            redirect('cms/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cms/auth/login');
        } else {
            $this->_login_process();
        }
    }

    private function _login_process()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $admin = $this->Admin_model->get_admin_by_username($username);

        if ($admin && password_verify($password, $admin['password'])) {
            $session_data = [
                'admin_id'     => $admin['id'],
                'username'     => $admin['username'],
                'role_id'      => (int) $admin['role_id'],
                'is_logged_in' => TRUE
            ];
            $this->session->set_userdata($session_data);
            redirect('cms/dashboard');
        } else {
            $this->session->set_flashdata('error_message', 'Kredensial tidak valid. Silakan coba kembali.');
            redirect('login');
        }
    }

    public function logout()
    {
        // Sekarang fungsi ini bisa berjalan bebas tanpa terintersepsi
        $this->session->sess_destroy();
        redirect('login'); // Dilempar kembali ke rute login baru yang elegan
    }
}
