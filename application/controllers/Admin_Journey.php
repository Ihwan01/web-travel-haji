<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Journey extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->data['packages'] = $this->Package_model->get_all();
        $this->data['title']    = 'Kelola Journey';
        $this->render('admin/journey/index');
    }

    public function create()
    {
        $this->data['title'] = 'Tambah Journey';
        $this->render('admin/journey/form');
    }

    public function store()
    {
        $slug = url_title($this->input->post('name'), '-', TRUE);
        // Upload image
        $main_image = $this->_upload_image('main_image', 'journey');
        $this->Package_model->insert([
            'name'            => $this->input->post('name'),
            'slug'            => $slug,
            'collection_type' => $this->input->post('collection_type'),
            'tagline'         => $this->input->post('tagline'),
            'description'     => $this->input->post('description'),
            'itinerary'       => $this->input->post('itinerary'),
            'hotel_details'   => $this->input->post('hotel_details'),
            'price_display'   => $this->input->post('price_display'),
            'main_image'      => $main_image,
            'status'          => $this->input->post('status'),
        ]);
        redirect('admin/journey');
    }

    public function edit($id)
    {
        $this->data['package'] = $this->Package_model->get_by_id($id);
        $this->data['title']   = 'Edit Journey';
        $this->render('admin/journey/form');
    }

    public function update($id)
    {
        $pkg  = $this->Package_model->get_by_id($id);
        $slug = url_title($this->input->post('name'), '-', TRUE);
        $main_image = $this->_upload_image('main_image', 'journey');
        if ( ! $main_image) $main_image = $pkg->main_image;
        $this->Package_model->update($id, [
            'name'            => $this->input->post('name'),
            'slug'            => $slug,
            'collection_type' => $this->input->post('collection_type'),
            'tagline'         => $this->input->post('tagline'),
            'description'     => $this->input->post('description'),
            'itinerary'       => $this->input->post('itinerary'),
            'hotel_details'   => $this->input->post('hotel_details'),
            'price_display'   => $this->input->post('price_display'),
            'main_image'      => $main_image,
            'status'          => $this->input->post('status'),
        ]);
        redirect('admin/journey');
    }

    public function delete($id)
    {
        $this->Package_model->delete($id);
        redirect('admin/journey');
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
