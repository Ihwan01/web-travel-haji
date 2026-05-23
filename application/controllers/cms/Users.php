<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');

        // PROTEKSI MUTLAK: Hanya Super Admin (Role 1) yang diizinkan masuk ke rute ini.
        if ($this->session->userdata('role_id') != 1) {
            // Jika Role 2 (Admin) atau Role 3 mencoba memaksa lewat URL, tendang kembali ke Dasbor
            redirect('dashboard');
        }
    }

    // 1. Menampilkan Daftar Pengguna (Read)
    public function index()
    {
        $data['title'] = 'Manajemen Pengguna | Nuansa Rindu CMS';
        $data['users'] = $this->Admin_model->get_all_admins();

        $this->load->view('cms/layout/header', $data);
        $this->load->view('cms/users/index', $data);
        $this->load->view('cms/layout/footer');
    }

    // 2. Menambah Pengguna Baru (Create)
    public function create()
    {
        $data['title'] = 'Tambah Pengguna Baru | Nuansa Rindu CMS';

        // Menetapkan aturan validasi bawaan CodeIgniter
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admins.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|min_length[6]');
        $this->form_validation->set_rules('role_id', 'Otoritas Akses', 'required|in_list[1,2,3]');

        if ($this->form_validation->run() == FALSE) {
            // Jika belum ada input atau input tidak valid, tampilkan form
            $this->load->view('cms/layout/header', $data);
            $this->load->view('cms/users/create', $data);
            $this->load->view('cms/layout/footer');
        } else {
            // Jika validasi lulus, eksekusi penyimpanan ke basis data
            $insert_data = [
                'username' => $this->input->post('username', TRUE),
                'email'    => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Enkripsi otomatis
                'role_id'  => $this->input->post('role_id', TRUE)
            ];

            $this->Admin_model->insert_admin($insert_data);
            $this->session->set_flashdata('success_message', 'Akun pengguna baru berhasil ditambahkan.');
            redirect('users');
        }
    }

    // 3. Mengubah Data Pengguna (Update)
    public function edit($id)
    {
        $data['title'] = 'Edit Pengguna | Nuansa Rindu CMS';
        $data['user'] = $this->Admin_model->get_admin_by_id($id);

        // Jika ada yang mencoba mengedit ID yang tidak ada di database
        if (!$data['user']) {
            redirect('users');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('role_id', 'Otoritas Akses', 'required|in_list[1,2,3]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('cms/layout/header', $data);
            $this->load->view('cms/users/edit', $data);
            $this->load->view('cms/layout/footer');
        } else {
            $username = $this->input->post('username', TRUE);
            $email = $this->input->post('email', TRUE);

            // Validasi Pengecekan Duplikat secara manual (mengabaikan ID miliknya sendiri)
            if (
                $this->Admin_model->check_duplicate('username', $username, $id) ||
                $this->Admin_model->check_duplicate('email', $email, $id)
            ) {
                $this->session->set_flashdata('error_message', 'Username atau Email sudah digunakan oleh akun lain.');
                redirect('users/edit/' . $id);
            }

            $update_data = [
                'username' => $username,
                'email'    => $email,
                'role_id'  => $this->input->post('role_id', TRUE)
            ];

            // Fitur Cerdas: Jika kotak kata sandi diisi, berarti dia ingin ganti sandi
            // Jika dibiarkan kosong, sandi lama tetap aman
            $new_password = $this->input->post('password');
            if (!empty($new_password)) {
                $update_data['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            }

            $this->Admin_model->update_admin($id, $update_data);
            $this->session->set_flashdata('success_message', 'Data pengguna berhasil diperbarui.');
            redirect('users');
        }
    }

    // 4. Menghapus Pengguna (Delete)
    public function delete($id)
    {
        // Proteksi Logika: Mencegah Super Admin menghapus akunnya sendiri yang sedang aktif (bunuh diri data)
        if ($id == $this->session->userdata('admin_id')) {
            $this->session->set_flashdata('error_message', 'Tindakan ditolak. Anda tidak dapat menghapus akun Anda sendiri.');
            redirect('users');
        }

        $this->Admin_model->delete_admin($id);
        $this->session->set_flashdata('success_message', 'Akun pengguna berhasil dihapus secara permanen.');
        redirect('users');
    }
}
