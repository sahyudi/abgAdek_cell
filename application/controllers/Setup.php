
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('m_setup');
    }

    // public function index()
    // {
    //     $data['material'] = $this->m_material->get_material()->result();
    //     $data['active'] = 'material';
    //     $data['title'] = 'Material';
    //     $data['subview'] = 'material/stock';
    //     $this->load->view('template/main', $data);
    // }

    function operator()
    {
        $data['operator'] = $this->m_setup->get_operator()->result();
        $data['active'] = 'setup/operator';
        $data['title'] = 'Operator';
        $data['subview'] = 'setup/operator';
        $this->load->view('template/main', $data);
    }

    function add_operator()
    {
        $this->db->trans_begin();
        $id = $this->input->post('id');

        $data['nama'] = $this->input->post('nama');

        $upload_image = $_FILES['logo']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '2048';
            $config['upload_path']  = './assets/img/profile';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('logo')) {
                $new_image = $this->upload->data('file_name');
                $data['logo'] = $new_image;
            } else {
                echo $this->upload->display_errors();
            }
        }

        // log_r($data);
        if ($id) {
            $old_image = $this->db->get_where('tb_operator', ['id' => $id])->row();
            if ($old_image) {
                unlink(FCPATH . 'assets/img/profile/' . $old_image->logo);
            }
            $this->db->update('tb_operator', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data operator berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_operator', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data operator berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('setup/operator');
    }

    function get_operator($id)
    {
        if ($id) {
            $data = $this->m_setup->get_operator($id)->row();
            echo json_encode($data);
        }
    }

    function delete_operator($id)
    {
        $old_image = $this->db->get_where('tb_operator', ['id' => $id])->row();
        if ($this->db->delete('tb_operator', ['id' => $id])) {
            if ($old_image) {
                unlink(FCPATH . 'assets/img/profile/' . $old_image->logo);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data operator berhasil dihapus !</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data operator gagal dihapus !</div>');
        }
        redirect('setup/operator');
    }

    function pulsa()
    {
        $data['hargaPulsa'] = $this->m_setup->get_pulsa()->result();
        $data['operator'] = $this->m_setup->get_operator()->result();
        $data['active'] = 'setup/pulsa';
        $data['title'] = 'Pulsa';
        $data['subview'] = 'setup/pulsa';
        $this->load->view('template/main', $data);
    }

    function add_hargaPulsa()
    {
        $this->db->trans_begin();
        $id = $this->input->post('id');

        $data = [
            'operator_id' => $this->input->post('operator'),
            'quantity' => $this->input->post('quantity'),
            'harga' => $this->input->post('harga'),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        // log_r($data);
        if ($id) {
            $this->db->update('tb_harga_pulsa', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data harga berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_harga_pulsa', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data harga berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('setup/pulsa');
    }

    function get_hargaPulsa($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_harga_pulsa', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_hargaPulsa($id)
    {
        if ($this->db->delete('tb_harga_pulsa', ['id' => $id])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data harga berhasil dihapus !</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data harga gagal dihapus !</div>');
        }
        redirect('setup/pulsa');
    }

    function aksesoris()
    {
        $data['aksesoris'] = $this->m_setup->get_aksesoris()->result();
        $data['active'] = 'setup/asksesoris';
        $data['title'] = 'Aksesoris';
        $data['subview'] = 'setup/aksesoris';
        $this->load->view('template/main', $data);
    }

    function add_aksesoris()
    {
        $this->db->trans_begin();
        $id = $this->input->post('id');

        $data = [
            'barcode' => $this->input->post('barcode'),
            'nama' => $this->input->post('nama'),
            'harga_jual' => $this->input->post('harga_jual'),
            'keterangan' => $this->input->post('keterangan'),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        if ($id) {
            $this->db->update('tb_aksesoris', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data aksesoris berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_aksesoris', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data aksesoris berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('setup/aksesoris');
    }

    function get_aksesoris($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_aksesoris', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_aksesoris($id)
    {
        if ($this->db->delete('tb_aksesoris', ['id' => $id])) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data aksesoris berhasil dihapus !</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data aksesoris gagal dihapus !</div>');
        }
        redirect('setup/aksesoris');
    }
}
