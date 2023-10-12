<?php defined('BASEPATH') or exit('No direct script access allowed');

function generate_custom_string()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $random_char = 'M';

    $epoch_time = time();

    $random_string = '';
    $length = 5;
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $random_char . $epoch_time . $random_string;
}
function is_periode()
{
    $CI = &get_instance();
    $CI->load->database();

    $tapel = 'idperiode';
    $CI->db->select($tapel);
    $CI->db->from('daruttaqwa_referensi.tbl_periode');
    $CI->db->where('aktif', 1);
    $query = $CI->db->get()->row()->$tapel;

    return $query;
}
function counter_trans()
{
    $CI = &get_instance();
    $CI->load->database();
    // $CI->load->library('ion_auth');

    // $user = $CI->ion_auth->user()->row(); // Mendapatkan data pengguna saat ini
    // $user_id = $user->id;
    $prefix = 'K.';
    $now = new DateTime();
    $dates = $now->format('Y-m-d');
    $date = $now->format('Ymd');

    $CI->db->select('no_trans');
    // $CI->db->where('person_id', $user_id);
    $CI->db->where("DATE(tgl) = '$dates'");
    // $CI->db->like('no_trans', $prefix . $date . '.' . $user_id, 'after'); // Menyaring berdasarkan tanggal
    $CI->db->like('no_trans', $prefix . $date, 'after'); // Menyaring berdasarkan tanggal
    $CI->db->order_by('no_trans', 'desc');
    $query = $CI->db->get('track_medic');
    if ($query->num_rows() > 0) {
        $row = $query->row();
        $counter_parts = explode('.', $row->no_trans);
        $counter = intval(end($counter_parts)) + 1;
    } else {
        $counter = 1;
    }

    // $counter_string = $prefix . $date . '.' . $user_id . '.' . str_pad($counter, 4, '0', STR_PAD_LEFT);
    $counter_string = $prefix . $date . '.' . str_pad($counter, 4, '0', STR_PAD_LEFT);
    return $counter_string;
}
function counter_rak()
{
    $CI = &get_instance();
    $CI->load->database();
    $now = new DateTime();
    $dates = $now->format('Y-m-d');
    $date = $now->format('Ymd');

    $CI->db->select_max('no_urut', 'max_counter');
    // $CI->db->where("idperson !=", $idperson);
    // $CI->db->where("idperiode !=", $idperiode);
    $CI->db->order_by('no_trans', 'desc');
    $query = $CI->db->get('track_medic');
    if ($query->num_rows() > 0) {
        $row = $query->row();
        $counter = $row->max_counter + 1;
    } else {
        $counter = 1;
    }
    // $counter_string =  $date . '.' . str_pad($counter, 4, '0', STR_PAD_LEFT);
    return $counter;
}

function cmb_dinamis($name, $table, $field, $pk, $selected = null, $order = null)
{
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control filter select2' id='" . $pk . "'>";
    // $cmb .= "<option value='all'";
    if ($order) {
        $ci->db->order_by($field, $order);
    }
    // $data = $ci->db->get_where($table, array('aktif' => 1))->result();
    $data = $ci->db->get($table)->result();

    foreach ($data as $d) {
        $cmb .= "<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .= ">" .  strtoupper($d->$field) . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}
