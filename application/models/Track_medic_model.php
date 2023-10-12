<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Track_medic_model extends CI_Model
{

    public $table = 'track_medic';
    public $id = 'track_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('track_id,idsiswa,idperson,idunit,idperiode,no_trans,person_id,anamnesa,terapi,kif,tgl,no_rak,no_baris,no_urut,no_antri');
        $this->datatables->from('track_medic');
        //add this line for join
        //$this->datatables->join('table2', 'track_medic.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('track_medic/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . anchor(site_url('track_medic/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"') . "  " . anchor(site_url('track_medic/delete/$1'), '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'track_medic/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'track_id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('track_id', $q);
        $this->db->or_like('track_id', $q);
        $this->db->or_like('idsiswa', $q);
        $this->db->or_like('idperson', $q);
        $this->db->or_like('idunit', $q);
        $this->db->or_like('idperiode', $q);
        $this->db->or_like('no_trans', $q);
        $this->db->or_like('person_id', $q);
        $this->db->or_like('anamnesa', $q);
        $this->db->or_like('terapi', $q);
        $this->db->or_like('kif', $q);
        $this->db->or_like('tgl', $q);
        $this->db->or_like('no_rak', $q);
        $this->db->or_like('no_baris', $q);
        $this->db->or_like('no_urut', $q);
        $this->db->or_like('no_antri', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('track_id', $q);
        $this->db->or_like('track_id', $q);
        $this->db->or_like('idsiswa', $q);
        $this->db->or_like('idperson', $q);
        $this->db->or_like('idunit', $q);
        $this->db->or_like('idperiode', $q);
        $this->db->or_like('no_trans', $q);
        $this->db->or_like('person_id', $q);
        $this->db->or_like('anamnesa', $q);
        $this->db->or_like('terapi', $q);
        $this->db->or_like('kif', $q);
        $this->db->or_like('tgl', $q);
        $this->db->or_like('no_rak', $q);
        $this->db->or_like('no_baris', $q);
        $this->db->or_like('no_urut', $q);
        $this->db->or_like('no_antri', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
    //check pk data is exists 

    function is_exist($id)
    {
        $query = $this->db->get_where($this->table, array($this->id => $id));
        $count = $query->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
