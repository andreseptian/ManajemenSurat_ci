<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Arsipdigital extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Arsipdigital_model');
        $this->load->library('form_validation');
        $this->load->helper('download');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'arsipdigital?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'arsipdigital?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'arsipdigital';
            $config['first_url'] = base_url() . 'arsipdigital';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Arsipdigital_model->total_rows($q);
        $arsipdigital = $this->Arsipdigital_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'arsipdigital_data' => $arsipdigital,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Arsipdigital';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Arsipdigital' => '',
        ];
        $data['code_js'] = 'arsipdigital/codejs';
        $data['page'] = 'arsipdigital/surat_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Arsipdigital_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_surat' => $row->id_surat,
		 'nama_klasifikasi' => $row->nama_klasifikasi,
              'pemohon' => $row->first_name,
              'nama_unit' => $row->nama_unit,
		'tujuan' => $row->tujuan,
		'nomor_surat' => $row->nomor_surat,
		'perihal' => $row->perihal,
		'tgl_surat' => $row->tgl_surat,
		'file_surat' => $row->file_surat,
		'keterangan' => $row->keterangan,
		'status' => $row->status,
		'arsip' => $row->arsip,
	    );
        $data['title'] = 'Arsipdigital';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'arsipdigital/surat_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsipdigital'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arsipdigital/create_action'),
	    'id_surat' => set_value('id_surat'),
	    'id_klasifikasi' => set_value('id_klasifikasi'),
	    'id_user' => set_value('id_user'),
	    'id_unit' => set_value('id_unit'),
	    'tujuan' => set_value('tujuan'),
	    'nomor_surat' => set_value('nomor_surat'),
	    'perihal' => set_value('perihal'),
	    'tgl_surat' => set_value('tgl_surat'),
	    'file_surat' => set_value('file_surat'),
	    'keterangan' => set_value('keterangan'),
	    'status' => set_value('status'),
	    'arsip' => set_value('arsip'),
	);
        $data['title'] = 'Arsipdigital';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'arsipdigital/surat_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'id_unit' => $this->input->post('id_unit',TRUE),
		'tujuan' => $this->input->post('tujuan',TRUE),
		'nomor_surat' => $this->input->post('nomor_surat',TRUE),
		'perihal' => $this->input->post('perihal',TRUE),
		'tgl_surat' => $this->input->post('tgl_surat',TRUE),
		'file_surat' => $this->input->post('file_surat',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'arsip' => $this->input->post('arsip',TRUE),
	    );$this->Arsipdigital_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('arsipdigital'));}
    }
    
    public function update($id) 
    {
        $row = $this->Arsipdigital_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arsipdigital/update_action'),
		'id_surat' => set_value('id_surat', $row->id_surat),
		'id_klasifikasi' => set_value('id_klasifikasi', $row->id_klasifikasi),
		'id_user' => set_value('id_user', $row->id_user),
		'id_unit' => set_value('id_unit', $row->id_unit),
		'tujuan' => set_value('tujuan', $row->tujuan),
		'nomor_surat' => set_value('nomor_surat', $row->nomor_surat),
		'perihal' => set_value('perihal', $row->perihal),
		'tgl_surat' => set_value('tgl_surat', $row->tgl_surat),
		'file_surat' => set_value('file_surat', $row->file_surat),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'status' => set_value('status', $row->status),
		'arsip' => set_value('arsip', $row->arsip),
	    );
            $data['title'] = 'Arsipdigital';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'arsipdigital/surat_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsipdigital'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_surat', TRUE));
        } else {
            $data = array(
		'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
		'id_user' => $this->input->post('id_user',TRUE),
		'id_unit' => $this->input->post('id_unit',TRUE),
		'tujuan' => $this->input->post('tujuan',TRUE),
		'nomor_surat' => $this->input->post('nomor_surat',TRUE),
		'perihal' => $this->input->post('perihal',TRUE),
		'tgl_surat' => $this->input->post('tgl_surat',TRUE),
		'file_surat' => $this->input->post('file_surat',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'status' => $this->input->post('status',TRUE),
		'arsip' => $this->input->post('arsip',TRUE),
	    );

            $this->Arsipdigital_model->update($this->input->post('id_surat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arsipdigital'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Arsipdigital_model->get_by_id($id);

        if ($row) {
            $this->Arsipdigital_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arsipdigital'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsipdigital'));
        }
    }

    public function deletebulk(){
        $delete = $this->Arsipdigital_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_klasifikasi', 'id klasifikasi', 'trim|required');
	$this->form_validation->set_rules('id_user', 'id user', 'trim|required');
	$this->form_validation->set_rules('id_unit', 'id unit', 'trim|required');
	$this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
	$this->form_validation->set_rules('nomor_surat', 'nomor surat', 'trim|required');
	$this->form_validation->set_rules('perihal', 'perihal', 'trim|required');
	$this->form_validation->set_rules('tgl_surat', 'tgl surat', 'trim|required');
	$this->form_validation->set_rules('file_surat', 'file surat', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('arsip', 'arsip', 'trim|required');

	$this->form_validation->set_rules('id_surat', 'id_surat', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "surat.xls";
        $judul = "surat";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Klasifikasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Unit");
	xlsWriteLabel($tablehead, $kolomhead++, "Tujuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nomor Surat");
	xlsWriteLabel($tablehead, $kolomhead++, "Perihal");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Surat");
	xlsWriteLabel($tablehead, $kolomhead++, "File Surat");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Arsip");

	foreach ($this->Arsipdigital_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_klasifikasi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_unit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tujuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nomor_surat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->perihal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_surat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->file_surat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteNumber($tablebody, $kolombody++, $data->arsip);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function printdoc(){
        $data = array(
            'arsipdigital_data' => $this->Arsipdigital_model->get_all(),
            'start' => 0
        );
        $this->load->view('arsipdigital/arsipdigital_print', $data);
    }

    public function download($id_surat){
        $this->db->select('file_surat');
        $this->db->where('id_surat', $id_surat);
        $filesurat = $this->db->get('surat')->row()->file_surat;
        $path = FCPATH.'assets/uploads/surat/'.$filesurat;
        force_download($path, NULL);

    }

}

