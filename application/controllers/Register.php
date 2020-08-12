<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['message'] = $this->session->userdata('message');
        $this->load->view('auth/register', $data);
    }

    public function insert(){
    	$username = $this->input->post('email', true);
	    $password = $this->input->post('password', true);
	    $email = $this->input->post('email', true);
	    $first_name = $this->input->post('nama');
	    $last_name = $this->input->post('nik');
	    $phone = $this->input->post('notelp');
	    $company = $this->input->post('alamat');
	    $additional_data = array(
	                'first_name' => $first_name,
	                'last_name' => $last_name,
	                'phone' => $phone,
	                'company' => $company
	                );
	    $group = array('5'); // Sets user to admin.

	    $insert = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
    	if($insert){
    		$this->session->set_flashdata('message', "Register Berhasil");
    		header('location: '.site_url('login'));
    	}else{
    		$this->session->set_flashdata('message', "Register Gagal Periksa kembali inputan anda atau email sudah terdaftar");
    		header('location: '.site_url('register'));
    	}
    }

}
