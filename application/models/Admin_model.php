<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get_admin_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('admins')->row_array();
    }
}
