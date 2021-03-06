<?php

function get_parent_menu($id)
{
    $CI = get_instance();
    $CI->db->select('title');
    $CI->db->where('id', $id);
    $data = $CI->db->get('menus')->row();

    if (!empty($data->title)) {
        return $data->title;
    } else {
        return 'Parent Menu';
    }
}

function log_r($string = null, $var_dump = false)
{
    if ($var_dump) {
        var_dump($string);
    } else {
        echo "<pre>";
        print_r($string);
    }
    exit;
}

function check_persmission_pages($id_group, $link)
{
    $CI = get_instance();
    $CI->db->select('*');
    $CI->db->from('user_access_role A');
    $CI->db->join('menus B', 'A.menu_id = B.id');
    $CI->db->where('A.group_id', $id_group);
    $CI->db->where('B.link', $link);
    $data = $CI->db->get();

    if ($data->num_rows() > 0) {
        return true;
    } else {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Anda tidak memilik akses !</div>');
        if ($CI->session->userdata('group_id') == 3) {
            redirect('pos');
        } else {
            redirect('employee');
        }
    }
}

function check_permision_menu($id_group, $link)
{
    $CI = get_instance();
    $CI->db->select('*');
    $CI->db->from('user_access_role A');
    $CI->db->join('menus B', 'A.menu_id = B.id');
    $CI->db->where('A.group_id', $id_group);
    $CI->db->where('B.link', $link);
    $data = $CI->db->get();

    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

function check_persmission_views($id_group, $menu_id)
{
    $CI = get_instance();
    $CI->db->select('*');
    $CI->db->from('user_access_role');
    $CI->db->where('group_id', $id_group);
    $CI->db->where('menu_id', $menu_id);
    $data = $CI->db->get();

    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

function check_menu($id_group, $menu_id)
{
    $CI = get_instance();
    $CI->db->select('*');
    $CI->db->from('user_access_role');
    $CI->db->where('group_id', $id_group);
    $CI->db->where('menu_id', $menu_id);
    $data = $CI->db->get();

    if ($data->num_rows() > 0) {
        return 'checked';
    }
}

function cek_status($status)
{
    if ($status == 1) {
        return '<span class="badge badge-succees">Done</span>';
    } else if ($status == 2) {
        return '<span class="badge badge-danger">Pending</span>';
    } else {
        return '<span class="badge badge-warning">On progress</span>';
    }
}


function get_user_name($id)
{
    $CI = get_instance();
    $CI->db->select('name');
    $CI->db->where('id', $id);
    $data = $CI->db->get('users')->row();
    if ($data->name) {
        return $data->name;
    } else {
        return 'default';
    }
}

function get_material_name($id)
{
    $CI = get_instance();
    $CI->db->select('nama');
    $CI->db->where('id', $id);
    $data = $CI->db->get('material')->row();
    if ($data->name) {
        return $data->nama;
    } else {
        return 'default';
    }
}

function replace_angka($angka)
{
    return str_replace(",", "", $angka);
}
