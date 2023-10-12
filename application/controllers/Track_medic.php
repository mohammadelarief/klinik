<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Track_medic extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Track_medic_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Track Medic';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Track Medic' => '',
        ];
        $data['code_js'] = 'track_medic/codejs';
        $data['page'] = 'track_medic/Track_medic_list';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Track_medic_model->json();
    }

    public function read($id)
    {
        $row = $this->Track_medic_model->get_by_id($id);
        if ($row) {
            $data = array(
                'track_id' => $row->track_id,
                'idsiswa' => $row->idsiswa,
                'idperson' => $row->idperson,
                'idunit' => $row->idunit,
                'idperiode' => $row->idperiode,
                'no_trans' => $row->no_trans,
                'person_id' => $row->person_id,
                'anamnesa' => $row->anamnesa,
                'terapi' => $row->terapi,
                'kif' => $row->kif,
                'tgl' => $row->tgl,
                'no_rak' => $row->no_rak,
                'no_baris' => $row->no_baris,
                'no_urut' => $row->no_urut,
                'no_antri' => $row->no_antri,
            );
            $data['title'] = 'Track Medic';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'track_medic/Track_medic_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('track_medic'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('track_medic/create_action'),
            'track_id' => set_value('track_id'),
            'idsiswa' => set_value('idsiswa'),
            'idperson' => set_value('idperson'),
            'idunit' => set_value('idunit'),
            'idperiode' => set_value('idperiode'),
            'no_trans' => set_value('no_trans'),
            'person_id' => set_value('person_id'),
            'anamnesa' => set_value('anamnesa'),
            'terapi' => set_value('terapi'),
            'kif' => set_value('kif'),
            'tgl' => set_value('tgl'),
            'no_rak' => set_value('no_rak'),
            'no_baris' => set_value('no_baris'),
            'no_urut' => set_value('no_urut'),
            'no_antri' => set_value('no_antri'),
        );
        $data['title'] = 'Track Medic';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'track_medic/Track_medic_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'track_id' => $this->input->post('track_id', TRUE),
                'idsiswa' => $this->input->post('idsiswa', TRUE),
                'idperson' => $this->input->post('idperson', TRUE),
                'idunit' => $this->input->post('idunit', TRUE),
                'idperiode' => $this->input->post('idperiode', TRUE),
                'no_trans' => $this->input->post('no_trans', TRUE),
                'person_id' => $this->input->post('person_id', TRUE),
                'anamnesa' => $this->input->post('anamnesa', TRUE),
                'terapi' => $this->input->post('terapi', TRUE),
                'kif' => $this->input->post('kif', TRUE),
                'tgl' => $this->input->post('tgl', TRUE),
                'no_rak' => $this->input->post('no_rak', TRUE),
                'no_baris' => $this->input->post('no_baris', TRUE),
                'no_urut' => $this->input->post('no_urut', TRUE),
                'no_antri' => $this->input->post('no_antri', TRUE),
            );
            if (!$this->Track_medic_model->is_exist($this->input->post('track_id'))) {
                $this->Track_medic_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('track_medic'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, track_id is exist');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Track_medic_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('track_medic/update_action'),
                'track_id' => set_value('track_id', $row->track_id),
                'idsiswa' => set_value('idsiswa', $row->idsiswa),
                'idperson' => set_value('idperson', $row->idperson),
                'idunit' => set_value('idunit', $row->idunit),
                'idperiode' => set_value('idperiode', $row->idperiode),
                'no_trans' => set_value('no_trans', $row->no_trans),
                'person_id' => set_value('person_id', $row->person_id),
                'anamnesa' => set_value('anamnesa', $row->anamnesa),
                'terapi' => set_value('terapi', $row->terapi),
                'kif' => set_value('kif', $row->kif),
                'tgl' => set_value('tgl', $row->tgl),
                'no_rak' => set_value('no_rak', $row->no_rak),
                'no_baris' => set_value('no_baris', $row->no_baris),
                'no_urut' => set_value('no_urut', $row->no_urut),
                'no_antri' => set_value('no_antri', $row->no_antri),
            );
            $data['title'] = 'Track Medic';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'track_medic/Track_medic_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('track_medic'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('track_id', TRUE));
        } else {
            $data = array(
                'track_id' => $this->input->post('track_id', TRUE),
                'idsiswa' => $this->input->post('idsiswa', TRUE),
                'idperson' => $this->input->post('idperson', TRUE),
                'idunit' => $this->input->post('idunit', TRUE),
                'idperiode' => $this->input->post('idperiode', TRUE),
                'no_trans' => $this->input->post('no_trans', TRUE),
                'person_id' => $this->input->post('person_id', TRUE),
                'anamnesa' => $this->input->post('anamnesa', TRUE),
                'terapi' => $this->input->post('terapi', TRUE),
                'kif' => $this->input->post('kif', TRUE),
                'tgl' => $this->input->post('tgl', TRUE),
                'no_rak' => $this->input->post('no_rak', TRUE),
                'no_baris' => $this->input->post('no_baris', TRUE),
                'no_urut' => $this->input->post('no_urut', TRUE),
                'no_antri' => $this->input->post('no_antri', TRUE),
            );

            $this->Track_medic_model->update($this->input->post('track_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('track_medic'));
        }
    }

    public function delete($id)
    {
        $row = $this->Track_medic_model->get_by_id($id);

        if ($row) {
            $this->Track_medic_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('track_medic'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('track_medic'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Track_medic_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('track_id', 'track id', 'trim|required');
        $this->form_validation->set_rules('idsiswa', 'idsiswa', 'trim|required');
        $this->form_validation->set_rules('idperson', 'idperson', 'trim|required');
        $this->form_validation->set_rules('idunit', 'idunit', 'trim|required');
        $this->form_validation->set_rules('idperiode', 'idperiode', 'trim|required');
        $this->form_validation->set_rules('no_trans', 'no trans', 'trim|required');
        $this->form_validation->set_rules('person_id', 'person id', 'trim|required');
        $this->form_validation->set_rules('anamnesa', 'anamnesa', 'trim|required');
        $this->form_validation->set_rules('terapi', 'terapi', 'trim|required');
        $this->form_validation->set_rules('kif', 'kif', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
        $this->form_validation->set_rules('no_rak', 'no rak', 'trim|required');
        $this->form_validation->set_rules('no_baris', 'no baris', 'trim|required');
        $this->form_validation->set_rules('no_urut', 'no urut', 'trim|required');
        $this->form_validation->set_rules('no_antri', 'no antri', 'trim|required');

        $this->form_validation->set_rules('track_id', 'track_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Track_medic.php */
