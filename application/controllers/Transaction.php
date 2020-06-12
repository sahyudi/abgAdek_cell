
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('m_transaction');
    }



    function transfer()
    {
        check_persmission_pages($this->session->userdata('group_id'), 'transaction/transfer');

        $data['transfer'] = $this->m_transaction->get_transfer()->result();
        $data['active'] = 'transaction/transfer';
        $data['title'] = 'Transfer';
        $data['subview'] = 'transaction/transfer';
        $this->load->view('template/main', $data);
    }

    function add_transfer()
    {
        $this->db->trans_begin();

        $id = $this->input->post('id');
        $data = [
            'no_transaksi' => $this->input->post('no_transaksi'),
            'nama' => $this->input->post('nama'),
            'bank' => $this->input->post('bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'nominal' => $this->input->post('nominal'),
            'admin' => $this->input->post('admin'),
            'keterangan' => $this->input->post('keterangan'),
            'update_at' => date('Y-m-d H:i:s')
        ];

        // log_r($data);
        if ($id) {
            $this->db->update('tb_trans_transfer', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transfer berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_trans_transfer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transfer baru berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            $last_id = $this->db->insert_id();
            $transfer['print'] = $this->m_transaction->get_transfer($last_id)->row();
            $this->load->view('transaction/print_transfer', $transfer);
        }
        // redirect('transaction/transfer');
    }

    function get_transfer($id)
    {
        if ($id) {
            $data = $this->m_transaction->get_transfer($id)->row();
            echo json_encode($data);
        }
    }

    function print_transfer($id)
    {
        $transfer['print'] = $this->m_transaction->get_transfer($id)->row();
        $this->load->view('transaction/print_transfer', $transfer);
    }

    function delete_transfer($id)
    {
        if ($this->db->delete('tb_trans_transfer', ['id' => $id])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data transfer berhasil dihapus !</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data transfer gagal dihapus !</div>');
        }
        redirect('transaction/transfer');
    }
}
