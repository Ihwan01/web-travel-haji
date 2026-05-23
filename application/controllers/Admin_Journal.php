<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Journal extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Journal_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->data['journals'] = $this->Journal_model->get_all();
        $this->data['title']    = 'Kelola Journal';
        $this->render('admin/journal/index');
    }

    public function create()
    {
        $this->data['title'] = 'Tulis Journal';
        $this->render('admin/journal/form');
    }

    public function store()
    {
        $slug       = url_title($this->input->post('title'), '-', TRUE);
        $main_image = $this->_upload_image('main_image', 'journal');
        $this->Journal_model->insert([
            'title'       => $this->input->post('title'),
            'slug'        => $slug,
            'content'     => $this->input->post('content'),
            'main_image'  => $main_image,
            'author_name' => $this->input->post('author_name'),
            'status'      => $this->input->post('status'),
        ]);
        redirect('admin/journal');
    }

    public function edit($id)
    {
        $this->data['journal'] = $this->Journal_model->get_by_id($id);
        $this->data['title']   = 'Edit Journal';
        $this->render('admin/journal/form');
    }

    public function update($id)
    {
        $jrn  = $this->Journal_model->get_by_id($id);
        $slug = url_title($this->input->post('title'), '-', TRUE);
        $main_image = $this->_upload_image('main_image', 'journal');
        if ( ! $main_image) $main_image = $jrn->main_image;
        $this->Journal_model->update($id, [
            'title'       => $this->input->post('title'),
            'slug'        => $slug,
            'content'     => $this->input->post('content'),
            'main_image'  => $main_image,
            'author_name' => $this->input->post('author_name'),
            'status'      => $this->input->post('status'),
        ]);
        redirect('admin/journal');
    }

    public function delete($id)
    {
        $this->Journal_model->delete($id);
        redirect('admin/journal');
    }

    private function _upload_image($field, $folder)
    {
        if ( ! isset($_FILES[$field]) || $_FILES[$field]['error'] !== 0) return null;
        $config = [
            'upload_path'   => FCPATH . 'assets/images/' . $folder . '/',
            'allowed_types' => 'jpg|jpeg|png|webp',
            'max_size'      => 5120,
            'file_name'     => uniqid() . '_' . time(),
        ];
        $this->upload->initialize($config);
        if ($this->upload->do_upload($field)) {
            return 'assets/images/' . $folder . '/' . $this->upload->data('file_name');
        }
        return null;
    }
}
