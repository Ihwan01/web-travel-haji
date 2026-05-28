<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_model extends CI_Model
{
    public function get_profile()
    {
        $query = $this->db->get('company_profile');
        if ($query->num_rows() == 0) {
            $this->db->insert('company_profile', ['company_name' => 'Nuansa Rindu']);
            return $this->db->get('company_profile')->row();
        }
        return $query->row();
    }

    public function update_profile($data)
    {
        return $this->db->where('id', 1)->update('company_profile', $data);
    }
}
