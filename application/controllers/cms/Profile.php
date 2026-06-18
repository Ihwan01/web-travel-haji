<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['title'] = 'Kelola Profil Saya | Nuansa Rindu CMS';
        $data['user']  = $this->db->where('id', $this->data['admin_id'])->get('admins')->row();

        // Cek jika flashdata sukses reset ada (Peringatan keamanan)
        if ($this->session->flashdata('force_reset_warning')) {
            $data['force_warning'] = $this->session->flashdata('force_reset_warning');
        }

        $this->render('cms/profile/index', $data);
    }

    public function update()
    {
        $admin_id = $this->data['admin_id'];
        $update_data = [
            'username' => $this->input->post('username', TRUE),
            'email'    => $this->input->post('email', TRUE)
        ];

        // Logika Ganti Password & Konfirmasi
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');

        if (!empty($password)) {
            if ($password !== $confirm_password) {
                $this->session->set_flashdata('error_message', 'Kata sandi baru tidak cocok dengan konfirmasi!');
                redirect('profile');
                return;
            }
            $update_data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        // Ambil data admin saat ini untuk mendapatkan path foto lama
        $current_admin = $this->db->where('id', $admin_id)->get('admins')->row();

        // Upload Foto ke assets/uploads/profile/ 
        if (!empty($_FILES['profile_picture']['name'])) {
            $upload_path = FCPATH . 'assets/uploads/profile/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_picture')) {
                // [PERBAIKAN] Hapus foto profil lama dari server jika ada
                if (!empty($current_admin->profile_picture) && file_exists(FCPATH . $current_admin->profile_picture)) {
                    unlink(FCPATH . $current_admin->profile_picture);
                }

                $update_data['profile_picture'] = 'assets/uploads/profile/' . $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error_message', $this->upload->display_errors('', ''));
                redirect('profile');
                return;
            }
        }

        $this->db->where('id', $admin_id)->update('admins', $update_data);
        $this->session->set_flashdata('success_message', 'Profil berhasil diperbarui!');
        redirect('profile');
    }
}
