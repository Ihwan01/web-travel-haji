<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller — Base controller untuk semua page publik & admin
 * Menyediakan method render() dengan layout wrapping otomatis.
 */
class MY_Controller extends CI_Controller {

    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        // Data global tersedia di semua view
        $this->data['base_url']    = base_url();
        $this->data['assets_url']  = base_url('assets/');
        $this->data['current_url'] = current_url();
    }

    /**
     * Render view dengan layout publik
     * @param string $view   path view relatif dari application/views/
     * @param array  $data   data tambahan untuk view
     */
    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('layouts/main', $data);
    }
}

/**
 * Admin_Controller — Base controller khusus admin
 */
class Admin_Controller extends CI_Controller {

    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->data['base_url']   = base_url();
        $this->data['assets_url'] = base_url('assets/');

        // Cek session login admin
        if ( ! $this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
        $this->data['admin_user'] = $this->session->userdata('admin_username');
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content_view'] = $view;
        $this->load->view('layouts/admin', $data);
    }
}
