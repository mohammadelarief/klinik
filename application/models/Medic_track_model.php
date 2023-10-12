<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medic_track_model extends CI_Model
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
        $start = date('Y-m-d', strtotime($this->input->post('_start')));
        $end = date('Y-m-d', strtotime($this->input->post('_end')));
        $curdate = date('Y-m-d', strtotime($this->input->post('_curdate')));
        $check = $this->input->post('_check');

        $this->datatables->select('km.track_id,km.idsiswa,km.idperson,km.idunit,km.idperiode,km.no_trans,km.person_id,km.anamnesa,km.terapi,km.kif,km.tgl,km.no_rak,km.no_baris,km.no_urut,km.no_antri,pp.nama,rd.title,sk.keterangan');
        $this->datatables->from('daruttaqwa_klinik.track_medic km');
        //add this line for join
        $this->datatables->join('daruttaqwa_sisda.tbl_siswa ss', 'ss.idsiswa = km.idsiswa');
        $this->datatables->join('daruttaqwa_person.tbl_person pp', 'pp.idperson = ss.idperson');
        $this->datatables->join('daruttaqwa_sisda.tbl_kelas sk', 'sk.idkelas = ss.idkelas');
        $this->datatables->join('daruttaqwa_referensi.tbl_departemen rd', 'rd.idunit = sk.idunit');
        // $this->datatables->where('km.anamnesa', null);
        if ($check == 'all') {
        } else if ($check == '1') {
            $this->datatables->where('km.anamnesa <>', null);
        } else {
            $this->datatables->where('km.anamnesa', null);
        }
        if ($start == '1970-01-01' && $end == '1970-01-01') {
            $this->datatables->where('date(km.tgl) <= ', $curdate);
        } else {
            $this->datatables->where('date(km.tgl) >= ', $start);
            $this->datatables->where('date(km.tgl) <= ', $end);
        }
        $this->datatables->add_column(
            'action',
            // anchor(site_url('medic_track/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . 
            anchor(site_url('medic_track/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"')
            //  . "  " . anchor(site_url('medic_track/delete/$1'), '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'medic_track/delete/$1\')" data-toggle="tooltip" title="Delete"')
            ,
            'track_id'
        );
        return $this->datatables->generate();
    }

    function ekspor_excel()
    {
        $start = date('Y-m-d', strtotime($this->input->post('_start')));
        $end = date('Y-m-d', strtotime($this->input->post('_end')));
        $curdate = date('Y-m-d', strtotime($this->input->post('_curdate')));
        $check = $this->input->post('_check');

        $this->db->select('km.track_id,km.idsiswa,km.idperson,km.idunit,km.idperiode,km.no_trans,km.person_id,km.anamnesa,km.terapi,km.kif,km.tgl,km.no_rak,km.no_baris,km.no_urut,km.no_antri,pp.nama,rd.title,sk.keterangan,d.nama as dokter');
        $this->db->from('daruttaqwa_klinik.track_medic km');
        //add this line for join
        $this->db->join('daruttaqwa_sisda.tbl_siswa ss', 'ss.idsiswa = km.idsiswa');
        $this->db->join('daruttaqwa_person.tbl_person pp', 'pp.idperson = ss.idperson');
        $this->db->join('daruttaqwa_sisda.tbl_kelas sk', 'sk.idkelas = ss.idkelas');
        $this->db->join('daruttaqwa_referensi.tbl_departemen rd', 'rd.idunit = sk.idunit');
        $this->db->join('daruttaqwa_klinik.dokter d', 'd.id = km.person_id');
        // $this->db->where('km.anamnesa', null);
        // if ($check == 'all') {
        // } else if ($check == '1') {
        //     $this->db->where('km.anamnesa <>', null);
        // } else {
        //     $this->db->where('km.anamnesa', null);
        // }
        // if ($start == '1970-01-01' && $end == '1970-01-01') {
        //     $this->db->where('date(km.tgl) <= ', $curdate);
        // } else {
        //     $this->db->where('date(km.tgl) >= ', $start);
        //     $this->db->where('date(km.tgl) <= ', $end);
        // }
        return $this->db->get()->result();
    }
    function search_idyys($title)
    {
        $tapel = is_periode();
        $queries = "SELECT `p`.`idsiswa`, `p`.`idperson`, `p`.`idkelas`, `p`.`status`, `k`.`idperiode`, `k`.`idunit`, `d`.`title`, `d`.`departemen`, `k`.`keterangan`, `pd`.`nama`, `pd`.`gender`, `pd`.`lahirtempat`, `pd`.`lahirtanggal`, `pd`.`alamat` FROM `daruttaqwa_sisda`.`tbl_siswa` `p` JOIN `daruttaqwa_person`.`tbl_person_details` `pd` ON `pd`.`idperson` = `p`.`idperson` JOIN `daruttaqwa_sisda`.`tbl_kelas` `k` ON `k`.`idkelas` = `p`.`idkelas` JOIN `daruttaqwa_referensi`.`tbl_departemen` `d` ON `d`.`idunit` = `k`.`idunit` WHERE (`p`.`idperson` LIKE '%{$title}%' ESCAPE '!' OR `pd`.`nama` LIKE '%{$title}%' ESCAPE '!') AND `p`.`status` = 1 AND `k`.`idperiode` = '{$tapel}' AND `pd`.`type` = 'siswa' ORDER BY `p`.`idperson` ASC LIMIT 8";

        return $this->db->query($queries)->result();
    }

    public function search($idperson)
    {
        // $this->db->where('idperson', $idperson); // Ganti nama_kolom dengan nama kolom di database Anda
        // $this->db->where('idperiode', $idperiode); // Ganti nama_kolom dengan nama kolom di database Anda
        // $query = $this->db->get('track_medic'); // Ganti nama_tabel dengan nama tabel di database Anda
        $query = "select * from track_medic where idperson = '{$idperson}'";
        return $this->db->query($query)->result();
    }

    function get_siswa($idsiswa)
    {
        $query = "select km.track_id,km.idsiswa,km.idperson,km.idunit,km.idperiode,km.no_trans,km.person_id,km.anamnesa,km.terapi,km.kif,km.tgl,km.no_rak,km.no_baris,km.no_urut,km.no_antri,pp.nama,rd.title,sk.keterangan 
        from daruttaqwa_klinik.track_medic km 
        join daruttaqwa_sisda.tbl_siswa ss on ss.idsiswa = km.idsiswa
        join daruttaqwa_person.tbl_person pp on pp.idperson = ss.idperson
        join daruttaqwa_sisda.tbl_kelas sk on sk.idkelas = ss.idkelas
        join daruttaqwa_referensi.tbl_departemen rd on rd.idunit = sk.idunit
        where km.idsiswa = '{$idsiswa}'";
        return $this->db->query($query)->result();
    }
    function getDatainModal($id)
    {
        $this->db->select('p.idperson,  p.nama, p.gender, pd.lahirtempat, pd.lahirtanggal,daruttaqwa_person.calculate_age(pd.lahirtanggal) AS usia,pd.alamat, pp.pemilik, pp.phone_number');
        $this->db->from('daruttaqwa_person.tbl_person p');
        $this->db->join('daruttaqwa_person.tbl_person_details pd', 'pd.idperson = p.idperson');
        $this->db->join('daruttaqwa_person.tbl_person_phone pp', 'pp.idperson = p.idperson');
        $this->db->where('pd.type', 'siswa');
        $this->db->where('pp.pemilik <>', 'siswa');
        $this->db->where('p.idperson', $id);
        return $fullData = $this->db->get('daruttaqwa_person.tbl_person')->row();
    }
    function get_track_medic($id)
    {
        $query = "select km.track_id,km.idsiswa,km.idperson,km.idunit,km.idperiode,km.no_trans,km.person_id,km.anamnesa,km.terapi,km.kif,km.tgl,km.no_rak,km.no_baris,km.no_urut,km.no_antri, d.nama
        from daruttaqwa_klinik.track_medic km
        join daruttaqwa_klinik.dokter d on d.id = km.person_id
        where idperson = '{$id}'
        ORDER BY tgl ASC ";
        return $this->db->query($query)->result();
    }
    public function update_norekmed($id, $data_to_update)
    {
        // Lakukan validasi dan query update sesuai dengan kebutuhan Anda
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data_to_update); // Gantilah 'your_table' dengan nama tabel Anda

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
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
        $this->db->or_like('unit', $q);
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
