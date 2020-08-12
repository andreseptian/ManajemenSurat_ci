<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Klasifikasi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'klasifikasi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'klasifikasi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'klasifikasi';
            $config['first_url'] = base_url() . 'klasifikasi';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Klasifikasi_model->total_rows($q);
        $klasifikasi = $this->Klasifikasi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'klasifikasi_data' => $klasifikasi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Klasifikasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Klasifikasi' => '',
        ];
        $data['code_js'] = 'klasifikasi/codejs';
        $data['page'] = 'klasifikasi/klasifikasi_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Klasifikasi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_klasifikasi' => $row->id_klasifikasi,
		'nama_klasifikasi' => $row->nama_klasifikasi,
		'keterangan' => $row->keterangan,
	    );
        $data['title'] = 'Klasifikasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'klasifikasi/klasifikasi_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('klasifikasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('klasifikasi/create_action'),
	    'id_klasifikasi' => set_value('id_klasifikasi'),
	    'nama_klasifikasi' => set_value('nama_klasifikasi'),
	    'keterangan' => set_value('keterangan'),
	);
        $data['title'] = 'Klasifikasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'klasifikasi/klasifikasi_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_klasifikasi' => $this->input->post('nama_klasifikasi',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );$this->Klasifikasi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('klasifikasi'));}
    }
    
    public function update($id) 
    {
        $row = $this->Klasifikasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('klasifikasi/update_action'),
		'id_klasifikasi' => set_value('id_klasifikasi', $row->id_klasifikasi),
		'nama_klasifikasi' => set_value('nama_klasifikasi', $row->nama_klasifikasi),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $data['title'] = 'Klasifikasi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'klasifikasi/klasifikasi_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('klasifikasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_klasifikasi', TRUE));
        } else {
            $data = array(
		'nama_klasifikasi' => $this->input->post('nama_klasifikasi',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
	    );

            $this->Klasifikasi_model->update($this->input->post('id_klasifikasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('klasifikasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Klasifikasi_model->get_by_id($id);

        if ($row) {
            $this->Klasifikasi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('klasifikasi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('klasifikasi'));
        }
    }

    public function deletebulk(){
        $delete = $this->Klasifikasi_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_klasifikasi', 'nama klasifikasi', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id_klasifikasi', 'id_klasifikasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "klasifikasi.xls";
        $judul = "klasifikasi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Klasifikasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Klasifikasi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_klasifikasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function printdoc(){
        $data = array(
            'klasifikasi_data' => $this->Klasifikasi_model->get_all(),
            'start' => 0
        );
        $this->load->view('klasifikasi/klasifikasi_print', $data);
    }

}

