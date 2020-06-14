<?php

class M_emp extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_emp($id = null)
    {
        $this->db->select('A.*, B.nama as outlet_id');
        $this->db->join('tb_outlet B', 'B.id = A.outlet_id', 'right');
        if ($id != 0) {
            $this->db->where('A.id', $id);
        }
        $data = $this->db->get('users A');
        return $data;
    }
}
