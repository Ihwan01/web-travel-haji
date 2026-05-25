<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journeys extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Package_model');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Perjalanan (Journey) | CMS';
        $data['packages'] = $this->Package_model->get_all();
        $this->render('cms/journeys/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Perjalanan Baru | CMS';

        $this->form_validation->set_rules('name', 'Nama Perjalanan', 'required|trim');
        $this->form_validation->set_rules('collection_type', 'Tipe Koleksi', 'required|in_list[Classic,Signature,Private,Sacred]');
        $this->form_validation->set_rules('price', 'Harga Dasar', 'required|numeric');
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
                'status'          => $this->input->post('status', TRUE)
            ];

            if (!empty($_FILES['main_image']['name'])) {
                $upload_img = $this->_upload_image();
                if ($upload_img['status'] == true) {
                    $save_data['main_image'] = $upload_img['file_name'];
                } else {
                    // PERBAIKAN: Gunakan render, BUKAN redirect agar inputan tidak reset/hilang
                    $this->session->set_flashdata('error_message', $upload_img['error']);
                    $this->render('cms/journeys/create', $data);
                    return; // Menghentikan eksekusi script agar tidak memasukkan data kosong ke database
                }
            }

            $this->Package_model->insert($save_data);
            $this->session->set_flashdata('success_message', 'Data perjalanan berhasil ditambahkan.');
            redirect('journeys');
        }
    }

    public function edit($id)
    {
        $data['package'] = $this->Package_model->get_by_id($id);
        if (!$data['package']) {
            $this->session->set_flashdata('error_message', 'Data tidak ditemukan.');
            redirect('journeys');
        }

        $data['title'] = 'Edit Perjalanan: ' . $data['package']->name;

        $this->form_validation->set_rules('name', 'Nama Perjalanan', 'required|trim');
        $this->form_validation->set_rules('price', 'Harga Dasar', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->render('cms/journeys/edit', $data);
        } else {
            $update_data = [
                'name'            => $this->input->post('name', TRUE),
                'collection_type' => $this->input->post('collection_type', TRUE),
                'tagline'         => $this->input->post('tagline', TRUE),
                'price'           => $this->input->post('price', TRUE),
                'price_display'   => $this->input->post('price_display', TRUE),
                'itinerary'       => $this->input->post('itinerary'),
                'hotel_details'   => $this->input->post('hotel_details'),
                'status'          => $this->input->post('status', TRUE)
            ];

            if (!empty($_FILES['main_image']['name'])) {
                $upload = $this->_upload_image();
                if ($upload['status']) {
                    if ($data['package']->main_image && file_exists('./assets/uploads/packages/' . $data['package']->main_image)) {
                        unlink('./assets/uploads/packages/' . $data['package']->main_image);
                    }
                    $update_data['main_image'] = $upload['file_name'];
                } else {
                    // PERBAIKAN: Gunakan render juga di sini jika edit gambar gagal
                    $this->session->set_flashdata('error_message', $upload['error']);
                    $this->render('cms/journeys/edit', $data);
                    return;
                }
            }

            $this->Package_model->update($id, $update_data);
            $this->session->set_flashdata('success_message', 'Data berhasil diperbarui.');
            redirect('journeys');
        }
    }

    public function delete($id)
    {
        $package = $this->Package_model->get_by_id($id);

        if ($package) {
            if ($package->main_image && file_exists('./assets/uploads/packages/' . $package->main_image)) {
                unlink('./assets/uploads/packages/' . $package->main_image);
            }
            $this->Package_model->delete($id);
            $this->session->set_flashdata('success_message', 'Data perjalanan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error_message', 'Data tidak ditemukan.');
        }

        redirect('journeys');
    }

    private function _upload_image()
    {
        $config['upload_path']   = './assets/uploads/packages/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('main_image')) {
            return ['status' => true, 'file_name' => $this->upload->data('file_name')];
        } else {
            return ['status' => false, 'error' => $this->upload->display_errors('', '')];
        }
    }
}
