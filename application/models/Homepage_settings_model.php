<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage_settings_model extends CI_Model
{

    public function get_settings()
    {
        return $this->db->get('homepage_settings')->row();
    }

    public function update_settings($data)
    {
        $this->db->where('id', 1)->update('homepage_settings', $data);
    }

    // --- LOGIKA SLIDES ---
    public function get_slides()
    {
        return $this->db->order_by('sort_order', 'ASC')->get('hero_slides')->result();
    }

    public function clear_slides()
    {
        $this->db->empty_table('hero_slides');
    }

    public function insert_slide($data)
    {
        $this->db->insert('hero_slides', $data);
    }
}
