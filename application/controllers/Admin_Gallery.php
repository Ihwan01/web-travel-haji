<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Gallery extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gallery_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->data['media'] = $this->Gallery_model->get_all();
        $this->data['title'] = 'Kelola Gallery';
        $this->render('admin/gallery/index');
    }

    public function create()
    {
        $this->data['title'] = 'Upload Media';
        $this->render('admin/gallery/form');
    }

    public function store()
    {
        $media_type = $this->input->post('media_type');
        $folder     = $media_type === 'Video' ? 'gallery/videos' : 'gallery/photos';
        $file_url   = $this->_upload_file('file_url', $folder);
        $thumb_url  = $this->_upload_file('thumbnail_url', 'gallery/thumbs');
        $this->Gallery_model->insert([
            'title'         => $this->input->post('title'),
            'media_type'    => $media_type,
            'file_url'      => $file_url,
            'thumbnail_url' => $thumb_url,
            'aspect_ratio'  => $this->input->post('aspect_ratio'),
        ]);
        redirect('admin/gallery');
    }

    public function delete($id)
    {
        $this->Gallery_model->delete($id);
        redirect('admin/gallery');
    }

    private function _upload_file($field, $folder)
    {
        if ( ! isset($_FILES[$field]) || $_FILES[$field]['error'] !== 0) return null;
        $config = [
            'upload_path'   => FCPATH . 'assets/images/' . $folder . '/',
            'allowed_types' => 'jpg|jpeg|png|webp|mp4|mov|webm',
            'max_size'      => 102400,
            'file_name'     => uniqid() . '_' . time(),
        ];
        $this->upload->initialize($config);
        if ($this->upload->do_upload($field)) {
            return 'assets/images/' . $folder . '/' . $this->upload->data('file_name');
        }
        return null;
    }
}
