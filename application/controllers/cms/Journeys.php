<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journeys extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_permission('journeys');
        $this->load->model('Package_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']    = 'Manajemen Paket Perjalanan | CMS';
        $data['packages'] = $this->Package_model->get_all();
        $this->render('cms/journeys/index', $data);
    }

    public function create()
    {
        // [GEMBOK AKTIF] Tolak Kontributor jika memaksa masuk via URL
        $this->restrict_action('journeys', 'create');

        $data['title'] = 'Tambah Paket Perjalanan | CMS';

        $this->form_validation->set_rules('name', 'Nama Paket', 'required|trim');
        $this->form_validation->set_rules('collection_type', 'Tipe Koleksi', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Draft,Published]');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journeys/create', $data);
        } else {
            $save_data = [
                'name'            => $this->input->post('name', TRUE),
                'slug'            => url_title($this->input->post('name', TRUE), 'dash', TRUE),
                'collection_type' => $this->input->post('collection_type', TRUE),
                'tagline'         => $this->input->post('tagline', TRUE),
                'price_display'   => $this->input->post('price_display', TRUE),
                'price'           => $this->input->post('price', TRUE),
                'itinerary'       => $this->input->post('itinerary'),
                'hotel_details'   => $this->input->post('hotel_details'),
                'status'          => $this->input->post('status', TRUE),
                'created_at'      => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['main_image']['name'])) {
                $upload = $this->_upload_image();
                if ($upload['status']) {
                    $save_data['main_image'] = $upload['file_name'];
                } else {
                    $this->session->set_flashdata('error_message', $upload['error']);
                    $this->render('cms/journeys/create', $data);
                    return;
                }
            }

            $this->Package_model->insert($save_data);
            $this->session->set_flashdata('success_message', 'Paket berhasil ditambahkan.');
            redirect('journeys');
        }
    }

    public function edit($id)
    {
        // [GEMBOK AKTIF]
        $this->restrict_action('journeys', 'edit');

        $data['package'] = $this->Package_model->get_by_id($id);
        if (!$data['package']) redirect('journeys');

        $data['title'] = 'Edit Paket: ' . $data['package']->name;

        $this->form_validation->set_rules('name', 'Nama Paket', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journeys/edit', $data);
        } else {
            $update_data = [
                'name'            => $this->input->post('name', TRUE),
                'slug'            => url_title($this->input->post('name', TRUE), 'dash', TRUE),
                'collection_type' => $this->input->post('collection_type', TRUE),
                'tagline'         => $this->input->post('tagline', TRUE),
                'price_display'   => $this->input->post('price_display', TRUE),
                'price'           => $this->input->post('price', TRUE),
                'itinerary'       => $this->input->post('itinerary'),
                'hotel_details'   => $this->input->post('hotel_details'),
                'status'          => $this->input->post('status', TRUE),
                'updated_at'      => date('Y-m-d H:i:s')
            ];

            if (!empty($_FILES['main_image']['name'])) {
                $upload = $this->_upload_image();
                if ($upload['status']) {
                    if ($data['package']->main_image && file_exists(FCPATH . 'assets/uploads/packages/' . $data['package']->main_image)) {
                        unlink(FCPATH . 'assets/uploads/packages/' . $data['package']->main_image);
                    }
                    $update_data['main_image'] = $upload['file_name'];
                }
            }

            $this->Package_model->update($id, $update_data);
            $this->session->set_flashdata('success_message', 'Paket berhasil diperbarui.');
            redirect('journeys');
        }
    }

    public function delete($id)
    {
        // [GEMBOK AKTIF]
        $this->restrict_action('journeys', 'delete');

        $package = $this->Package_model->get_by_id($id);
        if ($package) {
            if ($package->main_image && file_exists(FCPATH . 'assets/uploads/packages/' . $package->main_image)) {
                unlink(FCPATH . 'assets/uploads/packages/' . $package->main_image);
            }
            $this->Package_model->delete($id);
            $this->session->set_flashdata('success_message', 'Paket berhasil dihapus.');
        }
        redirect('journeys');
    }

    private function _upload_image()
    {
        $config['upload_path']   = FCPATH . 'assets/uploads/packages/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('main_image')) {
            return ['status' => true, 'file_name' => $this->upload->data('file_name')];
        } else {
            return ['status' => false, 'error' => $this->upload->display_errors('', '')];
        }
    }
}
