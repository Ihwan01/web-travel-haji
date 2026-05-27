<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journal_comment_model extends CI_Model
{
    protected $table = 'journal_comments';

    public function get_by_journal($journal_id)
    {
        return $this->db->where('journal_id', $journal_id)
            ->order_by('created_at', 'ASC')
            ->get($this->table)->result();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id)->update($this->table, ['status' => $status]);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
        // Hapus juga balasan yang terkait dengan komentar ini
        $this->db->where('parent_id', $id)->delete($this->table);
    }
}
