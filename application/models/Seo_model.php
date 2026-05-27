<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seo_model extends CI_Model
{

    // --- BAGIAN 1: TRACKING SETTINGS ---
    public function get_tracking()
    {
        $query = $this->db->get('seo_tracking_settings');
        // Jika tabel kosong, buat 1 baris otomatis agar tidak error
        if ($query->num_rows() == 0) {
            $this->db->insert('seo_tracking_settings', ['gsc_code' => '']);
            return $this->db->get('seo_tracking_settings')->row();
        }
        return $query->row();
    }

    public function update_tracking($data)
    {
        // Karena hanya ada 1 baris setting, kita langsung update semuanya
        $this->db->update('seo_tracking_settings', $data);
    }

    // --- BAGIAN 2: PAGE METADATA ---
    public function get_all_meta()
    {
        return $this->db->get('seo_metadata')->result();
    }

    public function get_meta_by_url($url)
    {
        return $this->db->where('page_url', $url)->get('seo_metadata')->row();
    }

    public function save_meta($url, $data)
    {
        $exists = $this->db->where('page_url', $url)->get('seo_metadata')->num_rows();

        if ($exists > 0) {
            $this->db->where('page_url', $url)->update('seo_metadata', $data);
        } else {
            $data['page_url'] = $url;
            $this->db->insert('seo_metadata', $data);
        }
    }
}
