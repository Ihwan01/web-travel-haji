<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage_settings_model extends CI_Model
{

    public function get_settings()
    {
        return $this->db->get('homepage_settings')->row();
    }

    public function update($data)
    {
        $this->db->where('id', 1)->update('homepage_settings', $data);
    }
}
