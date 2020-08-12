<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->model("Dashboard_model");
	}
	
	public function index()
	{
		
		$id_user = $this->session->user_id;
		if($this->ion_auth->in_group('Pemohon')){
			//pemohon
			$data['sebagai'] = 'pemohon';
			$data['titlewidget1'] = 'Surat Menunggu Konfirmasi';
			$data['titlewidget2'] = 'Surat di ACC';
			$data['titlewidget3'] = 'Surat di Reject';
			$data['titlewidget4'] = 'Surat di Arsipkan';
			$data['contentwidget1'] = $this->Dashboard_model->getcountbystat($id_user, '0');
			$data['contentwidget2'] = $this->Dashboard_model->getcountbystat($id_user, '1');
			$data['contentwidget3'] = $this->Dashboard_model->getcountbystat($id_user, 'Reject Unit');
			$data['contentwidget4'] = $this->Dashboard_model->getcountdiarsipkan($id_user);
			$data['notifikasi'] = $this->Dashboard_model->getnotifikasi($id_user);
			// $data['cart'] = $this->Dashboard_model->getcart('pemohon', $id_user);

			$dataunit = $this->Dashboard_model->getunit();
			$label = array();

			$data['dataunit'] = $dataunit;
			$cartdata=array();
			foreach ($dataunit as $key => $value) {
				$datanya = array_fill(0, 12, 0);
				$cart = $this->Dashboard_model->get_cart_pemohon($value->id_unit);
				$i = 0;
				foreach ($cart as $key => $val) {
					$datanya[$val['bln']] = (int)$val['jml_diarsipkan'];
				}
				$cartdata[$value->nama_unit] = json_encode($datanya);
			}
			$data['cart'] = $cartdata;
		}else{
		//pemohon
			$data['sebagai'] = 'lain';
			$data['titlewidget1'] = 'Surat Menunggu Konfirmasi';
			$data['titlewidget2'] = 'Surat di ACC';
			$data['titlewidget3'] = 'Surat di Reject';
			$data['titlewidget4'] = 'Surat di Arsipkan';
			$data['contentwidget1'] = $this->Dashboard_model->getcountbystat($id_user, '0');
			$data['contentwidget2'] = $this->Dashboard_model->getcountbystat($id_user, '1');
			$data['contentwidget3'] = $this->Dashboard_model->getcountbystat($id_user, 'Reject Unit');
			$data['contentwidget4'] = $this->Dashboard_model->getcountdiarsipkan($id_user);
			$data['notifikasi'] = $this->Dashboard_model->getnotifikasi($id_user);
			$dataunit = $this->Dashboard_model->getunit();
			$label = array();

			$data['dataunit'] = $dataunit;
			$cartdata=array();
			foreach ($dataunit as $key => $value) {
				$datanya = array_fill(0, 12, 0);
				$cart = $this->Dashboard_model->get_cart_semua($value->id_unit);
				$i = 0;
				foreach ($cart as $key => $val) {
					$datanya[$val['bln']] = (int)$val['jml_diarsipkan'];
				}
				$cartdata[$value->nama_unit] = json_encode($datanya);
			}
			$data['cart'] = $cartdata;
		}
		
		// var_dump(json_encode($cartdiarsipkan));
		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];
        //$this->layout->set_privilege(1);
		$data['code_js'] = 'Dashboard/codejs';
		$data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}

}
