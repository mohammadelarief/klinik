<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medic_track extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Medic_track_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Medic Track';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Medic Track' => '',
        ];
        $data['code_js'] = 'medic_track/codejs';
        $data['page'] = 'medic_track/medic_track_list';
        $this->load->view('template/backend', $data);
    }
    public function medical()
    {
        $data['title'] = 'Rekam Medis';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Medic Track' => '',
        ];
        $data['code_js'] = 'medic_track/codejs';
        $data['page'] = 'medic_track/index';
        $this->load->view('template/backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Medic_track_model->json();
    }

    public function read($id)
    {
        $row = $this->Medic_track_model->get_by_id($id);
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
            $data['title'] = 'Medic Track';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'medic_track/medic_track_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('medic_track'));
        }
    }

    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->Medic_track_model->search_idyys($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'value' => $row->idperson,
                        'label'    => $row->nama . ' - ' . $row->title . ' - ' . $row->keterangan,
                        'nama'    => $row->nama,
                        't_lahir'    => $row->lahirtempat,
                        'tgl_lahir'    => $row->lahirtanggal,
                        'jk'    => $row->gender,
                        'idperiode'    => $row->idperiode,
                        'keterangan'    => $row->keterangan,
                        'alamat'    => $row->alamat,
                        'idunit' => $row->idunit,
                        'title' => $row->title,
                        'unit' => $row->departemen,
                        'idsiswa' => $row->idsiswa,
                    );
                echo json_encode($arr_result);
            }
        }
    }

    public function check_register()
    {
        $idperson = $this->input->post('idperson');
        // $idperiode = $this->input->post('idperiode');
        $result = $this->Medic_track_model->search($idperson); // Ganti Your_Model_Name dengan nama model Anda

        echo json_encode($result);
    }
    public function check_counter_urut()
    {
        $idperson = $this->input->post('idperson');
        $idperiode = $this->input->post('idperiode');
        // $result = counter_rak($idperson, $idperiode); // Ganti Your_Model_Name dengan nama model Anda
        $result = counter_rak(); // Ganti Your_Model_Name dengan nama model Anda

        echo json_encode($result);
    }

    public function get_siswa()
    {
        $idsiswa = $this->input->post('idsiswa');
        $result = $this->Medic_track_model->get_siswa($idsiswa); // Ganti Your_Model_Name dengan nama model Anda

        echo json_encode($result);
    }

    public function create()
    {
        $now = date('Y-m-d H:i:s');
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('medic_track/create_action'),
            'track_id' => generate_custom_string(),
            'idsiswa' => set_value('idsiswa'),
            'idperson' => set_value('idperson'),
            'idunit' => set_value('idunit'),
            'idperiode' => set_value('idperiode'),
            'no_trans' => counter_trans(),
            'person_id' => null,
            'anamnesa' => null,
            'terapi' => null,
            'kif' => null,
            'tgl' => $now,
            'no_rak' => set_value('no_rak'),
            'no_baris' => set_value('no_baris'),
            'no_urut' => set_value('no_urut'),
            'no_antri' => set_value('no_antri'),
        );
        $data['title'] = 'Registrasi Klinik';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['user'] = $this->ion_auth->user()->row();

        $data['code_js'] = 'medic_track/js';
        $data['page'] = 'medic_track/medic_track_form';
        $this->load->view('template/backend', $data);
    }

    function get_Full_data()
    {
        $id = $this->input->post("id");
        $data['fullData'] = $this->Medic_track_model->getDatainModal($id);
        $data['medic'] = $this->Medic_track_model->get_track_medic($id);
        // $this->load->view('pdb/modal_data', $data);
        $this->load->view('medic_track/modal_data', $data);
    }
    public function exportExcel()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        // Membuat objek PHPExcel
        $objPHPExcel = new PHPExcel();

        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Inisialisasi data
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "DAFTAR REKAPITULASI PASIEN KLINIK"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $objPHPExcel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "YAYASAN DARUT TAQWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $objPHPExcel->getActiveSheet()->mergeCells('A2:L2'); // Set Merge Cell pada kolom A1 sampai E1
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16); // Set font size 15 untuk kolom A1
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        $data = $this->Medic_track_model->ekspor_excel(); // Ganti ModelAnda dengan nama model yang sesuai
        // Membuat kolom judul
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'No')
            ->setCellValue('B4', 'Tanggal')
            ->setCellValue('C4', 'No Rekam Medis')
            ->setCellValue('D4', 'IDYYS')
            ->setCellValue('E4', 'Nama')
            ->setCellValue('F4', 'Periode')
            ->setCellValue('G4', 'Unit')
            ->setCellValue('H4', 'Kamar/Kelas')
            ->setCellValue('I4', 'Anamnesa')
            ->setCellValue('J4', 'Terapi')
            ->setCellValue('K4', 'KIF')
            ->setCellValue('L4', 'Dokter');

        $objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray($style_col);
        $objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray($style_col);
        // Mengisi data dari model ke file Excel
        $no = 1;
        $row = 5; // Mulai dari baris ke-5
        foreach ($data as $item) {
            $objPHPExcel->getActiveSheet()
                ->setCellValue('A' . $row, $no)
                ->setCellValue('B' . $row, $item->tgl)
                ->setCellValue('C' . $row, $item->no_rak)
                ->setCellValue('D' . $row, $item->idperson)
                ->setCellValue('E' . $row, $item->nama)
                ->setCellValue('F' . $row, $item->idperiode)
                ->setCellValue('G' . $row, $item->title)
                ->setCellValue('H' . $row, $item->keterangan)
                ->setCellValue('I' . $row, $item->anamnesa)
                ->setCellValue('J' . $row, $item->terapi)
                ->setCellValue('K' . $row, $item->kif)
                ->setCellValue('L' . $row, $item->dokter);

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->applyFromArray($style_row);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->applyFromArray($style_row);

            $no++;
            $row++;
        }


        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Set width kolom B
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true); // Set width kolom E
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $objPHPExcel->getActiveSheet(0)->setTitle("Laporan Pasien Klinik");
        $objPHPExcel->setActiveSheetIndex(0);
        // Mengatur nama file dan tipe konten
        $filename = 'REKAPITULASI PASIEN KLINIK DARUT TAQWA.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Menyimpan file Excel
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
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
                'no_baris' => null,
                'no_urut' => null,
                'no_antri' => $this->input->post('no_antri', TRUE),
            );
            if (!$this->Medic_track_model->is_exist($this->input->post('track_id'))) {
                $this->Medic_track_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('track_medic'));
            } else {
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, track_id is exist');
            }
        }
    }

    public function update_norekmed()
    {
        // Mendapatkan data dari AJAX request
        $id = $this->input->post('id');
        $data_to_update = $this->input->post('data_to_update');
        $datas = array(
            'no_rak' => $data_to_update,
        );

        // Validasi data jika diperlukan
        if (!$id || !$data_to_update) {
            // Tangani jika data tidak lengkap
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            return;
        }

        // Panggil fungsi model untuk mengupdate data
        $result = $this->Medic_track_model->update_norekmed($id, $datas);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data']);
        }
    }

    public function update($id)
    {
        $row = $this->Medic_track_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('medic_track/update_action'),
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
                'uri' => $this->uri->segment(2),
            );
            $data['title'] = 'Rekam Medis';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['code_js'] = 'medic_track/js';
            $data['page'] = 'medic_track/medic_track_forms';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('medical'));
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

            $this->Medic_track_model->update($this->input->post('track_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('medical'));
        }
    }

    public function delete($id)
    {
        $row = $this->Medic_track_model->get_by_id($id);

        if ($row) {
            $this->Medic_track_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('medic_track'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('medic_track'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Medic_track_model->deletebulk();
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
        $this->form_validation->set_rules('no_trans', 'no_trans', 'trim|required');
        $this->form_validation->set_rules('person_id', 'person id', 'trim');
        $this->form_validation->set_rules('anamnesa', 'anamnesa', 'trim');
        $this->form_validation->set_rules('terapi', 'terapi', 'trim');
        $this->form_validation->set_rules('kif', 'kif', 'trim');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim');
        $this->form_validation->set_rules('no_rak', 'no rak', 'trim|required');
        $this->form_validation->set_rules('no_baris', 'no baris', 'trim');
        $this->form_validation->set_rules('no_urut', 'no urut', 'trim');
        $this->form_validation->set_rules('no_antri', 'no antri', 'trim|required');

        $this->form_validation->set_rules('track_id', 'track_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Medic_track.php */
