<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    // ==========================================
    // 1. FUNGSI OTENTIKASI UTAMA
    // ==========================================
    public function get_admin_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('admins')->row_array();
    }

    // [BARU] Mengambil data berdasarkan email (Untuk Lupa Password)
    public function get_admin_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('admins')->row_array();
    }

    // [BARU] Mengambil data berdasarkan token (Untuk Validasi Reset)
    public function get_admin_by_token($token)
    {
        $this->db->where('reset_token', $token);
        return $this->db->get('admins')->row_array();
    }

    // ==========================================
    // 2. FUNGSI CRUD MANAJEMEN PENGGUNA
    // ==========================================
    public function get_all_admins()
    {
        $this->db->select('id, username, email, role_id, created_at');
        $this->db->order_by('role_id', 'ASC');
        return $this->db->get('admins')->result_array();
    }

    public function get_admin_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('admins')->row_array();
    }

    public function insert_admin($data)
    {
        return $this->db->insert('admins', $data);
    }

    public function update_admin($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);
    }

    public function delete_admin($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('admins');
    }

    // ==========================================
    // 3. FUNGSI VALIDASI KEAMANAN
    // ==========================================
    public function check_duplicate($field, $value, $exclude_id = NULL)
    {
        $this->db->where($field, $value);
        if ($exclude_id !== NULL) {
            $this->db->where('id !=', $exclude_id);
        }
        $query = $this->db->get('admins');
        return $query->num_rows() > 0;
    }
}
