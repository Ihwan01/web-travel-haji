<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
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
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error_message', 'Kredensial tidak valid. Silakan coba kembali.');
            redirect('login');
        }
    }

    // ==========================================
    // [BARU] FUNGSI LUPA KATA SANDI
    // ==========================================
    public function forgot_password()
    {
        if ($this->input->method() == 'post') {
            $email = $this->input->post('email', TRUE);
            $admin = $this->Admin_model->get_admin_by_email($email);

            if ($admin) {
                // Generate token unik & set waktu expired (1 jam)
                $token = bin2hex(random_bytes(32));
                $this->Admin_model->update_admin($admin['id'], [
                    'reset_token'         => $token,
                    'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))
                ]);

                // Kirim Email
                $this->load->library('email'); // Memuat otomatis config/email.php

                $this->email->from('administrator@nuansarindu.id', 'Sistem Nuansa Rindu');
                $this->email->to($email);
                $this->email->subject('Pemulihan Kata Sandi Akun Nuansa Rindu');

                $reset_link = base_url('auth/reset_password/' . $token);
                $msg = "<h3>Halo, {$admin['username']}</h3>
                        <p>Kami menerima permintaan untuk mereset kata sandi akun CMS Nuansa Rindu Anda.</p>
                        <p>Silakan klik tautan di bawah ini untuk membuat sandi baru (berlaku 1 Jam):</p>
                        <p><a href='{$reset_link}' style='padding: 10px 20px; background-color: #5d4037; color: #fff; text-decoration: none; border-radius: 5px;'>Reset Kata Sandi</a></p>
                        <p>Atau salin tautan berikut ke peramban (browser) Anda:<br>{$reset_link}</p>
                        <br><p>Jika Anda tidak pernah meminta ini, abaikan email ini dengan aman.</p>";

                $this->email->message($msg);

                if ($this->email->send()) {
                    $this->session->set_flashdata('success_message', 'Tautan pemulihan sandi telah dikirim ke Email Anda.');
                } else {
                    // [FALLBACK PENTING] Mencetak debugging jika SMTP gagal
                    $this->session->set_flashdata('error_message', 'Gagal mengirim email hubungi Super Admin. <br><br><b>Debug Log:</b><br>' . $this->email->print_debugger(['headers']));
                }
            } else {
                $this->session->set_flashdata('error_message', 'Alamat email tidak ditemukan di sistem.');
            }
            redirect('auth/forgot_password');
        }

        // Tampilkan halaman view
        $this->load->view('cms/auth/forgot_password');
    }

    public function reset_password($token = NULL)
    {
        if (!$token) show_404();

        $admin = $this->Admin_model->get_admin_by_token($token);

        // Cek validitas & expired
        if (!$admin || strtotime($admin['reset_token_expires']) < time()) {
            $this->session->set_flashdata('error_message', 'Tautan reset sandi tidak valid atau telah kadaluarsa. Silakan ajukan ulang.');
            redirect('login');
        }

        if ($this->input->method() == 'post') {
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            if (strlen($password) < 6) {
                $this->session->set_flashdata('error_message', 'Kata sandi minimal 6 karakter.');
            } elseif ($password !== $confirm_password) {
                $this->session->set_flashdata('error_message', 'Konfirmasi kata sandi tidak cocok.');
            } else {
                // Update password & hapus token dari database
                $this->Admin_model->update_admin($admin['id'], [
                    'password'            => password_hash($password, PASSWORD_BCRYPT),
                    'reset_token'         => NULL,
                    'reset_token_expires' => NULL
                ]);

                $this->session->set_flashdata('success_message', 'Kata sandi berhasil direset! Silakan login dengan sandi baru Anda.');
                redirect('login');
            }
        }

        $data['token'] = $token;
        $this->load->view('cms/auth/reset_password', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
