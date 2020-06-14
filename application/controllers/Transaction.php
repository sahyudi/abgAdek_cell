
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
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data transaksi transfer berhasil dihapus !</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data transaksi transfer gagal dihapus !</div>');
        }
        redirect('transaction/transfer');
    }

    function pulsa()
    {
        check_persmission_pages($this->session->userdata('group_id'), 'transaction/pulsa');

        $data['pulsa'] = $this->m_transaction->get_transPulsa()->result();
        $data['harga'] = $this->m_transaction->get_pulsa()->result();
        $data['active'] = 'transaction/pulsa';
        $data['title'] = 'Trans Pulsa';
        $data['subview'] = 'transaction/pulsa';
        $this->load->view('template/main', $data);
    }

    function add_transPulsa()
    {
        $id = $this->input->post('id');
        $data = [
            'tgl_trans' => date('Y-m-d H:i:s'),
            'no_trans' => htmlspecialchars($this->input->post('no_trans', true)),
            'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
            'nominal' => htmlspecialchars($this->input->post('quantity', true)),
            'harga_id' => htmlspecialchars($this->input->post('harga_id', true)),
            'harga' => htmlspecialchars($this->input->post('harga', true)),
            'operator_id' => htmlspecialchars($this->input->post('operator_id', true)),
        ];

        if ($id) {
            $this->db->update('tb_trans_pulsa', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi pulsa berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_trans_pulsa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi pulsa berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('transaction/pulsa');
    }

    function get_transPulsa($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_trans_pulsa', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_transPulsa($id)
    {
        if ($this->db->delete('tb_trans_pulsa', ['id' => $id])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data transaksi pulsa berhasil dihapus !</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data transaksi pulsa gagal dihapus !</div>');
        }
        redirect('transaction/pulsa');
    }

    function get_hargaPulsa($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_harga_pulsa', ['id' => $id])->row();
            echo json_encode($data);
        }
    }
}
