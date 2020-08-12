<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pemohon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pemohon_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pemohon?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pemohon?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pemohon';
            $config['first_url'] = base_url() . 'pemohon';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pemohon_model->total_rows($q);
        $pemohon = $this->Pemohon_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pemohon_data' => $pemohon,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Pemohon';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pemohon' => '',
        ];
        $data['code_js'] = 'pemohon/codejs';
        $data['page'] = 'pemohon/pemohon_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Pemohon_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pemohon' => $row->id_pemohon,
		'nama' => $row->nama,
		'jk' => $row->jk,
		'alamat' => $row->alamat,
		'no_hp' => $row->no_hp,
	    );
        $data['title'] = 'Pemohon';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pemohon/pemohon_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemohon'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pemohon/create_action'),
	    'id_pemohon' => set_value('id_pemohon'),
	    'nama' => set_value('nama'),
	    'jk' => set_value('jk'),
	    'alamat' => set_value('alamat'),
	    'no_hp' => set_value('no_hp'),
	);
        $data['title'] = 'Pemohon';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pemohon/pemohon_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jk' => $this->input->post('jk',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
	    );$this->Pemohon_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pemohon'));}
    }
    
    public function update($id) 
    {
        $row = $this->Pemohon_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pemohon/update_action'),
		'id_pemohon' => set_value('id_pemohon', $row->id_pemohon),
		'nama' => set_value('nama', $row->nama),
		'jk' => set_value('jk', $row->jk),
		'alamat' => set_value('alamat', $row->alamat),
		'no_hp' => set_value('no_hp', $row->no_hp),
	    );
            $data['title'] = 'Pemohon';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pemohon/pemohon_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemohon'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pemohon', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jk' => $this->input->post('jk',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
	    );

            $this->Pemohon_model->update($this->input->post('id_pemohon', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pemohon'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pemohon_model->get_by_id($id);

        if ($row) {
            $this->Pemohon_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pemohon'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pemohon'));
        }
    }

    public function deletebulk(){
        $delete = $this->Pemohon_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jk', 'jk', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');

	$this->form_validation->set_rules('id_pemohon', 'id_pemohon', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
