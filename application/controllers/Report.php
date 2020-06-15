
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('m_report');
    }



    function penjualan()
    {
        check_persmission_pages($this->session->userdata('group_id'), 'report/penjualan');

        $this->form_validation->set_rules('tgl_dari', 'Dari', 'required|trim');
        $this->form_validation->set_rules('tgl_sampai', 'Sampai', 'required|trim');
        $this->form_validation->set_rules('outlet', 'Outlet', 'required|trim');
        $this->form_validation->set_rules('item_id', 'Item', 'required|trim');

        if ($this->form_validation->run() == false) {
            // log_r('false');
            $fromDate = '';
            $toDate = '';
            $item_id = '';
            $outlet = '';
        } else {
            // log_r('true');
            $fromDate = $this->input->post('tgl_dari');
            $toDate = $this->input->post('tgl_sampai');
            $item_id = $this->input->post('item_id');
            $outlet = $this->input->post('outlet');
        }
        $data['transaksi'] = $this->m_report->get_penjualan($fromDate, $toDate, $item_id, $outlet)->result();
        $data['dari'] = $fromDate;
        $data['sampai'] = $toDate;
        $data['outlet_id'] = $outlet;
        $data['item_id'] = $item_id;
        $data['outlet'] = $this->db->get('tb_outlet')->result();
        $data['item'] = $this->db->get('tb_aksesoris')->result();
        $data['active'] = 'report/penjualan';
        $data['title'] = 'Report Penjualan';
        $data['subview'] = 'report/penjualan';
        $this->load->view('template/main', $data);
    }

    function print_penjualan($fromDate, $toDate, $item_id, $outlet)
    {
        $data['transaksi'] = $this->m_report->get_penjualan($fromDate, $toDate, $item_id, $outlet)->result();
        $data['dari'] = $fromDate;
        $data['sampai'] = $toDate;
        $data['outlet_id'] = $outlet;
        $data['item_id'] = $item_id;
        $this->load->view('report/print_report', $data);
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

    function aksesoris()
    {
        check_persmission_pages($this->session->userdata('group_id'), 'transaction/aksesoris');

        $data['stock'] = $this->m_transaction->get_stocksAksesoris()->result();
        $data['stock'] = $this->m_transaction->get_stocksAksesoris()->result();
        $data['transaksi'] = $this->m_transaction->get_transAksesoris()->result();
        $data['item'] = $this->m_transaction->get_aksesoris()->result();
        $data['outlet'] = $this->db->get('tb_outlet')->result();
        // log_r($data['item']);
        $data['active'] = 'transaction/aksesoris';
        $data['title'] = 'Trans Aksesoris';
        $data['subview'] = 'transaction/aksesoris';
        $this->load->view('template/main', $data);
    }

    function add_stock()
    {
        $id = $this->input->post('id');
        $data = [
            'tanggal' => $tanggal = $this->input->post('tanggal'),
            'no_transaksi' => htmlspecialchars($this->input->post('no_transaksi', true)),
            'aksesoris_id' => $item_id = htmlspecialchars($this->input->post('aksesoris', true)),
            'quantity' => $quantity = htmlspecialchars($this->input->post('quantity', true)),
            'harga' => htmlspecialchars($this->input->post('harga', true)),
            'outlet_id' => htmlspecialchars($this->input->post('outlet_id', true)),
        ];

        $get = $this->db->get_where('tb_stock_aksesoris', ['aksesoris_id' => $item_id])->row();
        $update_stock = [
            'stock' => replace_angka($get->stock) + replace_angka($quantity),
            'update_at' => $tanggal,
        ];
        // log_r($update_stock);
        if ($id) {
            $this->db->update('tb_trans_pengadaan', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengadaan berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_trans_pengadaan', $data);
            $this->db->update('tb_stock_aksesoris', $update_stock, ['aksesoris_id' => $item_id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengadaan berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }

        redirect('transaction/aksesoris');
    }

    function add_penjualan()
    {
        $data = [
            'tanggal' => $tanggal = $this->input->post('tanggal_penjualan'),
            'no_transaksi' => htmlspecialchars($this->input->post('no_penjualan', true)),
            'aksesoris_id' => $item_id = htmlspecialchars($this->input->post('item_penjualan', true)),
            'quantity' => $quantity = htmlspecialchars($this->input->post('qty_jual', true)),
            'harga' => htmlspecialchars($this->input->post('harga_jual', true)),
            'outlet_id' => htmlspecialchars($this->input->post('outlet_penjualan', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
        ];

        $get = $this->db->get_where('tb_stock_aksesoris', ['aksesoris_id' => $item_id])->row();
        $update_stock = [
            'stock' => replace_angka($get->stock) - replace_angka($quantity),
            'update_at' => $tanggal,
        ];

        $this->db->insert('tb_trans_penjualan', $data);
        $this->db->update('tb_stock_aksesoris', $update_stock, ['aksesoris_id' => $item_id]);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Penjualan gagal disimpan !</div>');
        } else {
            $this->db->trans_commit();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Penjualan berhasil disimpan !</div>');
        }

        redirect('transaction/aksesoris');
    }
}
