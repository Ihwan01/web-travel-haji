<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journal_model extends CI_Model
{
    protected $table = 'journals';

    // [BARU] Fungsi memanggil kategori untuk dropdown Form
    public function get_categories()
    {
        return $this->db->get('journal_categories')->result();
    }

    // [BARU] Fungsi mengambil kategori yang HANYA memiliki artikel berstatus 'Published'
    public function get_active_categories()
    {
        $this->db->select('journal_categories.*');
        $this->db->from('journal_categories');
        // JOIN INNER memastikan hanya kategori yang punya relasi dengan jurnal yang ditarik
        $this->db->join('journals', 'journals.category_id = journal_categories.id', 'inner');
        $this->db->where('journals.status', 'Published');
        // GROUP BY mencegah kategori muncul ganda jika ada lebih dari 1 artikel di kategori yang sama
        $this->db->group_by('journal_categories.id');
        $this->db->order_by('journal_categories.name', 'ASC');

        return $this->db->get()->result();
    }

    public function get_all()
    {
        // [PEMBARUAN] Sub-query jumlah komentar dan JOIN nama kategori
        $this->db->select('journals.*, journal_categories.name as category_name, (SELECT COUNT(id) FROM journal_comments WHERE journal_id = journals.id) as comment_count');
        $this->db->join('journal_categories', 'journal_categories.id = journals.category_id', 'left');
        return $this->db->order_by('journals.created_at', 'DESC')->get($this->table)->result();
    }

    public function get_published($limit = NULL)
    {
        $this->db->select('journals.*, journal_categories.name as category_name');
        $this->db->join('journal_categories', 'journal_categories.id = journals.category_id', 'left');
        $this->db->where('journals.status', 'Published')->order_by('journals.created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }

    public function get_by_author($author_id)
    {
        // [PEMBARUAN] Sub-query jumlah komentar untuk Kontributor
        $this->db->select('journals.*, journal_categories.name as category_name, (SELECT COUNT(id) FROM journal_comments WHERE journal_id = journals.id) as comment_count');
        $this->db->join('journal_categories', 'journal_categories.id = journals.category_id', 'left');
        $this->db->where('journals.author_id', $author_id);
        return $this->db->order_by('journals.created_at', 'DESC')->get($this->table)->result();
    }

    public function get_by_slug($slug)
    {
        $this->db->select('journals.*, journal_categories.name as category_name');
        $this->db->join('journal_categories', 'journal_categories.id = journals.category_id', 'left');
        return $this->db->where('journals.slug', $slug)->where('journals.status', 'Published')->get($this->table)->row();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }
}
