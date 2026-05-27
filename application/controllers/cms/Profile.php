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
        $this->render('cms/profile/index', $data);
    }

    public function update()
    {
        $admin_id = $this->data['admin_id'];
        $update_data = [
            'username' => $this->input->post('username', TRUE),
            'email'    => $this->input->post('email', TRUE)
        ];

        // Ganti Password
        $password = $this->input->post('password');
        if (!empty($password)) {
            $update_data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        // Upload Foto
        if (!empty($_FILES['profile_picture']['name'])) {
            $config['upload_path']   = FCPATH . 'assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name']  = TRUE;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_picture')) {
                $update_data['profile_picture'] = 'assets/uploads/' . $this->upload->data('file_name');
            }
        }

        $this->db->where('id', $admin_id)->update('admins', $update_data);
        $this->session->set_flashdata('success_message', 'Profil berhasil diperbarui!');
        redirect('profile');
    }
}
