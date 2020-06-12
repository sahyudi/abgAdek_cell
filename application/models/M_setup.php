<?php

class M_setup extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_operator($id = null)
    {
        $this->db->select('*');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $data = $this->db->get('tb_operator');
        return $data;
    }

    function get_pulsa()
    {
        $this->db->select('A.*, B.nama as operator');
        $this->db->join('tb_operator B', 'A.operator_id = B.id', 'left');
        $data = $this->db->get('tb_harga_pulsa A');
        return $data;
    }

    function get_aksesoris($id = null)
    {
        $this->db->select('*');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $data = $this->db->get('tb_aksesoris');
        return $data;
    }

    function get_outlet($id = null)
    {
        $this->db->select('*');
        if ($id) {
            $this->db->where('id', $id);
        }
        $data = $this->db->get('tb_outlet');
        return $data;
    }
}
