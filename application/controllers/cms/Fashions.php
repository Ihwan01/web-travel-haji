<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fashions extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_permission('fashions');
        $this->load->model('Fashion_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Fashion & Perlengkapan | CMS';
        $data['fashions'] = $this->Fashion_model->get_all();
        $this->render('cms/fashions/index', $data);
    }

    public function create()
    {
        $this->restrict_action('fashions', 'create');
        $data['title'] = 'Tambah Koleksi Baru | CMS';

        $this->form_validation->set_rules('name', 'Nama Koleksi', 'required|trim', [
            'required' => '%s wajib diisi.'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Draft,Published]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/fashions/create', $data);
        } else {
            $uploaded_images = [];

            // [PERBAIKAN] Gunakan $data['error_upload'] alih-alih set_flashdata
            if (empty($_FILES['image_gallery']['name'][0])) {
                $data['error_upload'] = 'Minimal satu foto wajib diunggah untuk koleksi baru.';
                $this->render('cms/fashions/create', $data);
                return;
            }

            if (!empty($_FILES['image_gallery']['name'][0])) {
                $upload_res = $this->_upload_multiple_images('image_gallery', 'fashions');

                if (!$upload_res['status']) {
                    // [PERBAIKAN]
                    $data['error_upload'] = $upload_res['error'];
                    $this->render('cms/fashions/create', $data);
                    return;
                }
                $uploaded_images = $upload_res['data'];
            }

            $save_data = [
                'name'           => $this->input->post('name', TRUE),
                'slug'           => url_title($this->input->post('name', TRUE), 'dash', TRUE),
                'description'    => $this->input->post('description', TRUE),
                'fabric_details' => $this->input->post('fabric_details', TRUE),
                'image_gallery'  => !empty($uploaded_images) ? json_encode($uploaded_images) : null,
                'status'         => $this->input->post('status', TRUE)
            ];

            $this->Fashion_model->insert($save_data);
            $this->session->set_flashdata('success_message', 'Koleksi fashion berhasil ditambahkan.');
            redirect('fashions');
        }
    }

    public function edit($id)
    {
        $this->restrict_action('fashions', 'edit');

        $data['item'] = $this->Fashion_model->get_by_id($id);
        if (!$data['item']) {
            $this->session->set_flashdata('error_message', 'Data tidak ditemukan.');
            redirect('fashions');
        }

        $data['title'] = 'Edit Koleksi: ' . $data['item']->name;
        $this->form_validation->set_rules('name', 'Nama Koleksi', 'required|trim', [
            'required' => '%s wajib diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/fashions/edit', $data);
        } else {
            $update_data = [
                'name'           => $this->input->post('name', TRUE),
                'slug'           => url_title($this->input->post('name', TRUE), 'dash', TRUE),
                'description'    => $this->input->post('description', TRUE),
                'fabric_details' => $this->input->post('fabric_details', TRUE),
                'status'         => $this->input->post('status', TRUE)
            ];

            if (!empty($_FILES['image_gallery']['name'][0])) {
                $upload_res = $this->_upload_multiple_images('image_gallery', 'fashions');

                if (!$upload_res['status']) {
                    // [PERBAIKAN]
                    $data['error_upload'] = $upload_res['error'];
                    $this->render('cms/fashions/edit', $data);
                    return;
                }

                $uploaded_images = $upload_res['data'];
                if (!empty($uploaded_images)) {
                    $old_images = json_decode($data['item']->image_gallery, true);
                    if ($old_images) {
                        foreach ($old_images as $old_img) {
                            if (file_exists(FCPATH . $old_img)) unlink(FCPATH . $old_img);
                        }
                    }
                    $update_data['image_gallery'] = json_encode($uploaded_images);
                }
            }

            $this->Fashion_model->update($id, $update_data);
            $this->session->set_flashdata('success_message', 'Koleksi fashion berhasil diperbarui.');
            redirect('fashions');
        }
    }

    public function delete($id)
    {
        $this->restrict_action('fashions', 'delete');
        $item = $this->Fashion_model->get_by_id($id);
        if ($item) {
            $images = json_decode($item->image_gallery, true);
            if ($images) {
                foreach ($images as $img) {
                    if (file_exists(FCPATH . $img)) unlink(FCPATH . $img);
                }
            }
            $this->Fashion_model->delete($id);
            $this->session->set_flashdata('success_message', 'Data berhasil dihapus.');
        }
        redirect('fashions');
    }

    private function _upload_multiple_images($field, $subfolder)
    {
        $upload_path = FCPATH . 'assets/uploads/' . $subfolder . '/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $this->load->library('upload');
        $images_path = [];
        $files = $_FILES[$field];
        $file_count = count($files['name']);

        for ($i = 0; $i < $file_count; $i++) {
            // Proses file yang sah
            if ($files['error'][$i] !== 4 && !empty($files['name'][$i])) {
                $_FILES['single_file']['name']     = $files['name'][$i];
                $_FILES['single_file']['type']     = $files['type'][$i];
                $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$i];
                $_FILES['single_file']['error']    = $files['error'][$i];
                $_FILES['single_file']['size']     = $files['size'][$i];

                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'jpg|jpeg|png|webp';
                $config['max_size']      = 2048; // 2MB
                $config['file_name']     = uniqid() . '_' . time() . '_' . $i;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('single_file')) {
                    $images_path[] = 'assets/uploads/' . $subfolder . '/' . $this->upload->data('file_name');
                } else {
                    // Hentikan fungsi jika ada file yang bermasalah dan bersihkan tag HTML erornya
                    return [
                        'status' => false,
                        'error' => 'Gagal pada file "' . $files['name'][$i] . '": ' . strip_tags($this->upload->display_errors('', ''))
                    ];
                }
            }
        }

        return ['status' => true, 'data' => $images_path];
    }
}
