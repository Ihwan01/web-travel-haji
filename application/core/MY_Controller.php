<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
    }

    private function check_authentication()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('cms/auth/login');
        }
    }

    protected function require_role(array $allowed_roles)
    {
        $current_user_role = (int) $this->session->userdata('role_id');
        if (!in_array($current_user_role, $allowed_roles, true)) {
            show_error('Mohon maaf, Anda tidak memiliki otoritas untuk mengakses area spesifik ini.', 403, 'Akses Terbatas');
        }
    }
}
