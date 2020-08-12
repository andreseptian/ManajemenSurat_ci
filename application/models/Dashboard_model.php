<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    function getunit(){
        $this->db->select('id_unit, nama_unit');
        return $this->db->get('unit')->result();
    }   

    function get_cart_pemohon($id_unit){
         $this->db->select("count(id_surat) as jml_diarsipkan, MONTH(tgl_surat) as bln");
        $this->db->where('id_unit', $id_unit);
        $this->db->group_by('MONTH(tgl_surat)');
        $this->db->where('id_user', $this->session->user_id);
        return $this->db->get('surat')->result_array();
    }

    function get_cart_semua($id_unit){
         $this->db->select("count(id_surat) as jml_diarsipkan, MONTH(tgl_surat) as bln");
        $this->db->where('id_unit', $id_unit);
        $this->db->group_by('MONTH(tgl_surat)');
        return $this->db->get('surat')->result_array();
    }

    function getcountbystat($id_user, $status){
    	$this->db->where('id_user', $id_user);
    	$this->db->where('status', $status);
    	return $this->db->get('surat')->num_rows();
    }

    function getcountdiarsipkan($id_user){
    	$this->db->where('id_user', $id_user);
    	$this->db->where('arsip', '1');
    	return $this->db->get('surat')->num_rows();
    }

    function getnotifikasi($id_user){
    	$this->db->join('notifikasi', 'notifikasi.id_surat = surat.id_surat');
    	$this->db->where('id_user', $id_user);
    	$this->db->limit('10');
    	return $this->db->get('surat')->result();
    }

    function get_cartdiarsipkan_pemohon(){
        $this->db->select("count(id_surat) as jml_diarsipkan, MONTH(tgl_surat) as bln");
        $this->db->where('arsip', '1');
        $this->db->group_by('MONTH(tgl_surat)');
        $this->db->where('id_user', $this->session->user_id);
        return $this->db->get('surat')->result_array();
    }

      function get_cartmenunggu_pemohon(){
        $this->db->select("count(id_surat) as jml_diarsipkan, MONTH(tgl_surat) as bln");
        $this->db->where('status', '0');
        $this->db->group_by('MONTH(tgl_surat)');
        $this->db->where('id_user', $this->session->user_id);
        return $this->db->get('surat')->result_array();
    }
}