<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Dasbor TIDAK menggunakan require_permission agar semua user bisa masuk.
    }

    public function index()
    {
        $data['title'] = 'Dasbor | Nuansa Rindu CMS';

        $allowed = $this->data['allowed_modules'];
        $role_id = $this->data['role_id'];

        // 1. Statistik Jurnal (Artikel)
        if (in_array('journals', $allowed)) {
            if ($role_id == 3) {
                // Jika kontributor, hitung artikel miliknya saja
                $this->db->where('author_id', $this->session->userdata('id'));
            }
            $data['total_journals'] = $this->db->count_all_results('journals');
        }

        // 2. Statistik Paket Perjalanan
        if (in_array('journeys', $allowed)) {
            $data['total_journeys'] = $this->db->count_all_results('packages');
        }

        // 3. Statistik Galeri & Film
        if (in_array('galleries', $allowed)) {
            $data['total_galleries'] = $this->db->count_all_results('gallery_media');
        }

        // 4. Statistik Leads (Konsultasi Masuk)
        if (in_array('leads', $allowed)) {
            $data['total_leads'] = $this->db->count_all_results('leads_consultation');
        }

        $this->render('cms/dashboard/index', $data);
    }
}
