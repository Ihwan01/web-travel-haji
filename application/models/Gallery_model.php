<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gallery_model extends CI_Model
{

    protected $table = 'gallery_media';

    public function get_all()
    {
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function get_by_type($type)
    {
        return $this->db->where('media_type', $type)->order_by('created_at', 'DESC')->get($this->table)->result();
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

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
    }
}
