<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lead_model extends CI_Model
{
    public function insert($data) {
        return $this->db->insert('nama_tabel_leads_anda', $data);
    }
    // Menghitung total data untuk keperluan paginasi
    public function count_all_leads($search = null)
    {
        if ($search) {
            $this->db->group_start();
            $this->db->like('client_name', $search);
            $this->db->or_like('whatsapp_number', $search);
            $this->db->or_like('package_interest', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results('leads_consultation');
    }

    // Mengambil data dengan limit, offset, dan pencarian (Otomatis Terbaru)
    public function get_paginated_leads($limit, $start, $search = null)
    {
        if ($search) {
            $this->db->group_start();
            $this->db->like('client_name', $search);
            $this->db->or_like('whatsapp_number', $search);
            $this->db->or_like('package_interest', $search);
            $this->db->group_end();
        }

        // PENGURUTAN: Terbaru ke Terlama
        $this->db->order_by('created_at', 'DESC');

        return $this->db->get('leads_consultation', $limit, $start)->result();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('leads_consultation');
    }
}
