<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('m_emp');
    }

    public function index()
    {
        $data['emp'] = $this->m_emp->get_emp()->result();
        $data['outlet'] = $this->db->get('tb_outlet')->result();
        $data['active'] = 'employee';
        $data['title'] = 'Employee';
        $data['subview'] = 'emp/index';
        // log_r($data['emp']);
        $this->load->view('template/main', $data);
    }

    function registration()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('group_id', 'Group', 'required|trim');
        $this->form_validation->set_rules('outlet_id', 'Outlet', 'required|trim');
        $this->form_validation->set_rules('no_ktp', 'No KTP', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont matches!',
            'min_length' => 'Password to short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password]');

        if ($this->form_validation->run() == false) {
            $data['group'] = $this->db->get('groups')->result();
            $data['outlet'] = $this->db->get('tb_outlet')->result();
            $data['active'] = 'employee';
            $data['title'] = 'Register';
            $data['subview'] = 'emp/register';
            // log_r($data['emp']);
            $this->load->view('template/main', $data);
            // $this->load->view('emp/register');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'group_id' => htmlspecialchars($this->input->post('group_id', true)),
                'outlet_id' => htmlspecialchars($this->input->post('outlet_id', true)),
                'no_ktp' => htmlspecialchars($this->input->post('no_ktp', true)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Anda telah menambahkan satu user baru</div>');
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Congratulations your acount has been created. Please Login</div>');
            redirect('employee');
        }
    }

    function add()
    {
        $this->db->trans_begin();

        $id = $this->input->post('id');
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'outlet_id' => htmlspecialchars($this->input->post('outlet_id', true)),
            'no_ktp' => htmlspecialchars($this->input->post('no_ktp', true)),
            'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
        ];
        // log_r($data);
        if ($id) {
            $this->db->update('users', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Employee berhasil diperbarui !</div>');
        } else {
            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Employee baru berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Employee berhasil dihapus !</div>');
        redirect('employee');
    }

    function get_employee($id)
    {
        if ($id) {
            $data = $this->db->get_where('users', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_employee($id)
    {
        if ($id) {
            $this->db->delete('tb_employee', ['id' => $id]);
        }
        redirect('employee');
    }

    function agama()
    {
        check_persmission_pages($this->session->userdata('group_id'), 'employee/agama');
        $data['agama'] = $this->db->get('tb_agama')->result();
        $data['active'] = 'employee/agama';
        $data['title'] = 'Agama';
        $data['subview'] = 'emp/agama';
        $this->load->view('template/main', $data);
    }

    function add_agama()
    {
        $this->db->trans_begin();
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
        ];

        if ($id) {
            $this->db->update('tb_agama', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Agama berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_agama', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Agama berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('employee/agama');
    }

    function get_agama($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_agama', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_agama($id)
    {
        if ($id) {
            $this->db->delete('tb_agama', ['id' => $id]);
        }
        redirect('employee/agama');
    }

    function gol_darah()
    {
        $data['gol_darah'] = $this->db->get('tb_gol_darah')->result();
        $data['active'] = 'employee/gol_darah';
        $data['title'] = 'Gol Darah';
        $data['subview'] = 'emp/gol_darah';
        $this->load->view('template/main', $data);
    }

    function add_gol_darah()
    {
        $this->db->trans_begin();
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
        ];

        if ($id) {
            $this->db->update('tb_gol_darah', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Gol Darah berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_gol_darah', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Gol Darah berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('employee/gol_darah');
    }

    function get_gol_darah($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_gol_darah', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_gol_darah($id)
    {
        if ($id) {
            $this->db->delete('tb_gol_darah', ['id' => $id]);
        }
        redirect('employee/gol_darah');
    }

    function pendidikan()
    {
        $data['pendidikan'] = $this->db->get('tb_pendidikan')->result();
        $data['active'] = 'employee/pendidikan';
        $data['title'] = 'Pendidikan';
        $data['subview'] = 'emp/pendidikan';
        $this->load->view('template/main', $data);
    }

    function add_pendidikan()
    {
        $this->db->trans_begin();
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'singkatan' => $this->input->post('singkatan'),
        ];

        if ($id) {
            $this->db->update('tb_pendidikan', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pendidikan berhasil diperbarui !</div>');
        } else {
            $this->db->insert('tb_pendidikan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pendidikan berhasil disimpan !</div>');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        redirect('employee/pendidikan');
    }

    function get_pendidikan($id)
    {
        if ($id) {
            $data = $this->db->get_where('tb_pendidikan', ['id' => $id])->row();
            echo json_encode($data);
        }
    }

    function delete_pendidikan($id)
    {
        if ($id) {
            $this->db->delete('tb_pendidikan', ['id' => $id]);
        }
        redirect('employee/pendidikan');
    }
}
