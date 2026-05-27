<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');

        // PROTEKSI MUTLAK: Hanya Super Admin (Role 1) yang diizinkan masuk
        if ($this->session->userdata('role_id') != 1) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen Pengguna | Nuansa Rindu CMS';
        $data['users'] = $this->Admin_model->get_all_admins();
        $this->render('cms/users/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Pengguna Baru | Nuansa Rindu CMS';

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admins.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|min_length[6]');
        $this->form_validation->set_rules('role_id', 'Otoritas Akses', 'required|in_list[1,2,3]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/users/create', $data);
        } else {
            // Tangkap dan gabungkan array izin modul
            $allowed_modules = $this->input->post('allowed_modules');
            $allowed_str     = !empty($allowed_modules) ? implode(',', $allowed_modules) : '';

            $insert_data = [
                'username'        => $this->input->post('username', TRUE),
                'email'           => $this->input->post('email', TRUE),
                'password'        => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role_id'         => $this->input->post('role_id', TRUE),
                'allowed_modules' => $allowed_str
            ];

            $this->Admin_model->insert_admin($insert_data);
            $this->session->set_flashdata('success_message', 'Akun pengguna baru berhasil ditambahkan.');
            redirect('users');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pengguna | Nuansa Rindu CMS';
        $data['user'] = $this->Admin_model->get_admin_by_id($id);

        if (!$data['user']) {
            redirect('users');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('role_id', 'Otoritas Akses', 'required|in_list[1,2,3]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/users/edit', $data);
        } else {
            $username = $this->input->post('username', TRUE);
            $email = $this->input->post('email', TRUE);

            if (
                $this->Admin_model->check_duplicate('username', $username, $id) ||
                $this->Admin_model->check_duplicate('email', $email, $id)
            ) {
                $this->session->set_flashdata('error_message', 'Username atau Email sudah digunakan oleh akun lain.');
                redirect('users/edit/' . $id);
            }

            // Tangkap dan gabungkan array izin modul
            $allowed_modules = $this->input->post('allowed_modules');
            $allowed_str     = !empty($allowed_modules) ? implode(',', $allowed_modules) : '';

            $update_data = [
                'username'        => $username,
                'email'           => $email,
                'role_id'         => $this->input->post('role_id', TRUE),
                'allowed_modules' => $allowed_str
            ];

            $new_password = $this->input->post('password');
            if (!empty($new_password)) {
                $update_data['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            }

            $this->Admin_model->update_admin($id, $update_data);
            $this->session->set_flashdata('success_message', 'Data pengguna berhasil diperbarui.');
            redirect('users');
        }
    }

    public function delete($id)
    {
        if ($id == $this->session->userdata('admin_id')) {
            $this->session->set_flashdata('error_message', 'Tindakan ditolak. Anda tidak dapat menghapus akun Anda sendiri.');
            redirect('users');
        }

        $this->Admin_model->delete_admin($id);
        $this->session->set_flashdata('success_message', 'Akun pengguna berhasil dihapus secara permanen.');
        redirect('users');
    }
}
