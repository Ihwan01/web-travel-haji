<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    // ==========================================
    // 1. FUNGSI OTENTIKASI UTAMA (Yang sudah ada)
    // ==========================================
    public function get_admin_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('admins')->row_array();
    }

    // ==========================================
    // 2. FUNGSI CRUD MANAJEMEN PENGGUNA (Baru)
    // ==========================================

    // Membaca semua data admin (Password sengaja tidak ditarik demi keamanan memori)
    public function get_all_admins()
    {
        $this->db->select('id, username, email, role_id, created_at');
        $this->db->order_by('role_id', 'ASC'); // Mengurutkan dari Super Admin ke bawah
        return $this->db->get('admins')->result_array();
    }

    // Membaca data satu admin spesifik berdasarkan ID (Untuk form Edit)
    public function get_admin_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('admins')->row_array();
    }

    // Mengeksekusi penambahan akun baru ke basis data
    public function insert_admin($data)
    {
        return $this->db->insert('admins', $data);
    }

    // Mengeksekusi pembaruan data akun
    public function update_admin($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);
    }

    // Mengeksekusi penghapusan akun
    public function delete_admin($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('admins');
    }

    // ==========================================
    // 3. FUNGSI VALIDASI KEAMANAN (Baru)
    // ==========================================

    // Mencegah ada 2 orang menggunakan Username atau Email yang sama persis
    public function check_duplicate($field, $value, $exclude_id = NULL)
    {
        $this->db->where($field, $value);
        if ($exclude_id !== NULL) {
            $this->db->where('id !=', $exclude_id); // Abaikan ID milik sendiri saat sedang mengedit profil
        }
        $query = $this->db->get('admins');
        return $query->num_rows() > 0; // Mengembalikan nilai TRUE jika duplikat ditemukan
    }
}
