<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suratpemohon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Suratpemohon_model');
        $this->load->model('Klasifikasi_model');
        $this->load->model('Unit_model');
        $this->load->library('form_validation');
    }



    public function index()
    {
        $id_user = $this->session->user_id;
        $per_page = urldecode($this->input->get('pp', TRUE));
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if($per_page == ''){
            $per_page = 10;
        }
        if ($q <> '') {
            $config['base_url'] = base_url() . 'suratpemohon?pp='.$per_page.'&q=' . urlencode($q);
            $config['first_url'] = base_url() . 'suratpemohon?pp='.$per_page.'&q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'suratpemohon?pp='.$per_page;
            $config['first_url'] = base_url() . 'suratpemohon?pp='.$per_page;
        }



        $config['per_page'] = $per_page;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Suratpemohon_model->total_rows($q, $id_user);
        $suratpemohon = $this->Suratpemohon_model->get_limit_data($config['per_page'], $start, $q, $id_user);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'suratpemohon_data' => $suratpemohon,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'per_page' => $per_page 
        );
        $data['title'] = 'Suratpemohon';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Suratpemohon' => '',
        ];
        
        $data['code_js'] = 'suratpemohon/codejs';
        $data['page'] = 'suratpemohon/surat_list';
        $this->load->view('template/backend', $data);

    }

    public function read($id) 
    {
        $row = $this->Suratpemohon_model->get_by_id($id);
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
            $data['title'] = 'Suratpemohon';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'suratpemohon/surat_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suratpemohon'));
        }
    }

    public function create() 
    {
        $id_user = $this->session->user_id;

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'suratpemohon/create?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'suratpemohon/create?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'suratpemohon/create';
            $config['first_url'] = base_url() . 'suratpemohon/create';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Suratpemohon_model->total_rows($q, $id_user);
        $suratpemohon = $this->Suratpemohon_model->get_limit_data($config['per_page'], $start, $q, $id_user);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['last_id'] = $this->Suratpemohon_model->get_lastid();

        $data = array(
            'button' => 'Create',
            'action' => site_url('suratpemohon/create_action'),
            'id_surat' => set_value('id_surat'),
            'id_klasifikasi' => set_value('id_klasifikasi'),
            'id_user' => set_value('id_user'),
            'id_unit' => set_value('id_unit'),
            'tujuan' => set_value('tujuan'),
            'nomor_surat' => set_value('nomor_surat'),
            'last_id' => set_value('nomor_surat', "BBKSDA/".date('Y')."/".date('m')."/".date('d')."/".$data['last_id']),
            'perihal' => set_value('perihal'),
            'tgl_surat' => set_value('tgl_surat', date('Y-m-d')),
            'file_surat' => set_value('file_surat'),
            'keterangan' => set_value('keterangan'),
            'status' => '0',
            'arsip' => '0',
        );
        $data['suratpemohon_data'] = $suratpemohon;
        $data['q'] = $q;
        $data['pagination'] = $this->pagination->create_links();
        $data['total_rows'] = $config['total_rows'];
        $data['start'] = $start;
        $data['title'] = 'Suratpemohon';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['klasifikasi'] = $this->Klasifikasi_model->get_all();
        $data['unit'] = $this->Unit_model->get_all();
        $data['page'] = 'suratpemohon/surat_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $surat = "";
        if (!empty($_FILES["file_surat"]["name"])){

            $config['upload_path']          = './assets/uploads/surat';
            $config['allowed_types'] = 'pdf|doc|docx';
            $config['max_size']      = 2048;
            $config['overwrite'] = TRUE;
            $surat = date('YmdHis');
            $config['file_name'] = $surat;
            $surat = $surat.".".pathinfo($_FILES["file_surat"]["name"], PATHINFO_EXTENSION);

            

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file_surat'))
            {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // $this->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                
                $surat .= $file_ext;
                // $this->load->view('upload_success', $data);
                echo $surat;
            }
        }
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
              'id_user' => $this->session->user_id,
              'id_unit' => $this->input->post('id_unit',TRUE),
              'tujuan' => $this->input->post('tujuan',TRUE),
              'nomor_surat' => $this->input->post('nomor_surat',TRUE),
              'perihal' => $this->input->post('perihal',TRUE),
              'tgl_surat' => $this->input->post('tgl_surat',TRUE),
              'file_surat' => $surat,
              'keterangan' => $this->input->post('keterangan',TRUE),
              'status' => $this->input->post('status',TRUE),
              'arsip' => $this->input->post('arsip',TRUE),
          );$this->Suratpemohon_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('suratpemohon'));
        }
    }

    public function update($id) 
    {
        $id_user = $this->session->user_id;
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'suratpemohon/update/'.$id.'?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'suratpemohon/update/'.$id.'?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'suratpemohon/update/'.$id;
            $config['first_url'] = base_url() . 'suratpemohon/update/'.$id;
        }


        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Suratpemohon_model->total_rows($q, $id_user);
        $suratpemohon = $this->Suratpemohon_model->get_limit_data($config['per_page'], $start, $q, $id_user);

        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $row = $this->Suratpemohon_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('suratpemohon/update_action'),
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
            $data['suratpemohon_data'] = $suratpemohon;
            $data['q'] = $q;
            $data['pagination'] = $this->pagination->create_links();
            $data['total_rows'] = $config['total_rows'];
            $data['start'] = $start;
            $data['title'] = 'Suratpemohon';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];
            $data['last_id'] = $this->Suratpemohon_model->get_lastid();

            $data['klasifikasi'] = $this->Klasifikasi_model->get_all();
            $data['unit'] = $this->Unit_model->get_all();
            $data['page'] = 'suratpemohon/surat_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suratpemohon'));
        }
    }

    public function update_action() 
    {
        $this->_rules();
        $surat = "";
        if (!empty($_FILES["file_surat"]["name"])){

            $config['upload_path']          = './assets/uploads/surat';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 2048;
            $config['overwrite'] = TRUE;
            $surat = date('YmdHis');
            $config['file_name'] = $surat;
            $surat = $surat.".pdf";

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file_surat'))
            {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // $this->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());

                // $this->load->view('upload_success', $data);
                echo $surat;
            }
        }
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_surat', TRUE));
        } else {
            $data = array(
              'id_klasifikasi' => $this->input->post('id_klasifikasi',TRUE),
              'id_user' => $this->session->user_id,
              'id_unit' => $this->input->post('id_unit',TRUE),
              'tujuan' => $this->input->post('tujuan',TRUE),
              'nomor_surat' => $this->input->post('nomor_surat',TRUE),
              'perihal' => $this->input->post('perihal',TRUE),
              'tgl_surat' => $this->input->post('tgl_surat',TRUE),
              'keterangan' => $this->input->post('keterangan',TRUE),
              'status' => $this->input->post('status',TRUE),
              'arsip' => $this->input->post('arsip',TRUE),
          );
            if($surat != ""){
                $data['file_surat'] = $surat;
            }

            $this->Suratpemohon_model->update($this->input->post('id_surat', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('suratpemohon'));
        }
    }

    public function delete($id) 
    {
        $row = $this->Suratpemohon_model->get_by_id($id);

        if ($row) {
            $this->Suratpemohon_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('suratpemohon'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('suratpemohon'));
        }
    }

    public function deletebulk(){
        $delete = $this->Suratpemohon_model->deletebulk();
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
       // $this->form_validation->set_rules('file_surat', 'file surat', 'trim|required');
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

    foreach ($this->Suratpemohon_model->get_all() as $data) {
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
        'suratpemohon_data' => $this->Suratpemohon_model->get_all(),
        'start' => 0
    );
    $this->load->view('suratpemohon/surat_print', $data);
}

}

