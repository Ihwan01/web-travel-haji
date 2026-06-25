<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journal_comment_model extends CI_Model
{
    protected $table = 'journal_comments';

    // ==========================================
    // FUNGSI UNTUK HALAMAN SEMUA KOMENTAR (GLOBAL)
    // ==========================================

    // 1. Menghitung total data untuk Paginasi
    public function count_all_paginated($status = 'all', $author_id = null)
    {
        if ($status && $status !== 'all') {
            $this->db->where('status', $status);
        }
        if ($author_id) {
            $this->db->join('journals', 'journals.id = journal_comments.journal_id', 'left');
            $this->db->where('journals.author_id', $author_id);
        }
        return $this->db->count_all_results($this->table);
    }

    // 2. Mengambil data dengan Limit, Offset, dan Filter
    public function get_paginated_comments($limit, $start, $status = 'all', $author_id = null)
    {
        // JOIN dengan dirinya sendiri (parent) untuk mendapatkan nama orang yang dibalas
        $this->db->select('journal_comments.*, journals.title as journal_title, parent.name as replied_to_name');
        $this->db->join('journals', 'journals.id = journal_comments.journal_id', 'left');
        $this->db->join('journal_comments as parent', 'parent.id = journal_comments.parent_id', 'left');

        if ($status && $status !== 'all') {
            $this->db->where('journal_comments.status', $status);
        }
        if ($author_id) {
            $this->db->where('journals.author_id', $author_id);
        }

        $this->db->order_by('journal_comments.created_at', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // ==========================================
    // FUNGSI UNTUK HALAMAN PER-ARTIKEL (REKURSIF)
    // ==========================================
    public function get_by_journal($journal_id)
    {
        // Tetap mengambil semua, urutannya dari terlama ke terbaru (kronologis percakapan)
        return $this->db->where('journal_id', $journal_id)
            ->order_by('created_at', 'ASC')
            ->get($this->table)->result();
    }

    public function insert($data)
    {
        // Memaksa sistem untuk selalu menggunakan waktu PHP saat ini
        // agar seragam antara komentar klien dan balasan admin
        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        $this->db->insert($this->table, $data);
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id)->update($this->table, ['status' => $status]);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
        // Hapus juga secara berantai ke bawah jika komentar induk dihapus
        $this->db->where('parent_id', $id)->delete($this->table);
    }

    // [BARU] Fungsi untuk menghapus semua komentar berdasarkan ID Artikel
    public function delete_by_journal($journal_id)
    {
        $this->db->where('journal_id', $journal_id)->delete($this->table);
    }
}
