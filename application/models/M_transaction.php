<?php

class M_transaction extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_transfer($id = null)
    {
        $this->db->select('*');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $data = $this->db->get('tb_trans_transfer');
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

    function get_transPulsa()
    {
        $this->db->select('A.*, B.nama as operator');
        $this->db->join('tb_operator B', 'A.operator_id = B.id', 'left');
        $data = $this->db->get('tb_trans_pulsa A');
        return $data;
    }

    function get_stocksAksesoris()
    {
        $this->db->select('A.*, B.stock, B.update_at');
        $this->db->join('tb_stock_aksesoris B', 'A.id = B.aksesoris_id');
        return $this->db->get('tb_aksesoris A');
    }

    function get_transAksesoris()
    {
        $this->db->select('A.*, B.nama as nama_item, C.nama as nama_toko');
        $this->db->join('tb_aksesoris B', 'A.aksesoris_id = B.id');
        $this->db->join('tb_outlet C', 'A.outlet_id = C.id');
        return $this->db->get('tb_trans_penjualan A');
    }
}
