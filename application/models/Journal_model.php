<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {

    protected $table = 'journals';

    public function get_published($limit = NULL)
    {
        $this->db->where('status', 'Published')->order_by('created_at', 'DESC');
        if ($limit) $this->db->limit($limit);
        return $this->db->get($this->table)->result();
    }

    public function get_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->where('status', 'Published')->get($this->table)->row();
    }

    public function get_all()
    {
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
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
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }
}
