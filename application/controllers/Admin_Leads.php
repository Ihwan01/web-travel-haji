<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Leads extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lead_model');
    }

    public function index()
    {
        $this->data['leads'] = $this->Lead_model->get_all();
        $this->data['title'] = 'Konsultasi Masuk';
        $this->render('admin/leads/index');
    }

    public function delete($id)
    {
        $this->Lead_model->delete($id);
        redirect('admin/leads');
    }
}
