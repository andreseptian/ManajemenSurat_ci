<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Suratpemohon_model extends CI_Model
{

    public $table = 'surat';
    public $id = 'id_surat';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
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
        $this->db->join('users', 'users.id = surat.id_user');
        $this->db->join('klasifikasi', 'klasifikasi.id_klasifikasi = surat.id_klasifikasi');
        $this->db->join('unit', 'unit.id_unit = surat.id_unit');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL, $id_user) {

        $this->db->join('users', 'users.id = surat.id_user');
        $this->db->join('klasifikasi', 'klasifikasi.id_klasifikasi = surat.id_klasifikasi');
        $this->db->join('unit', 'unit.id_unit = surat.id_unit');
         if($id_user != '1'){
            $this->db->where('id_user', $id_user);
        }
         // $this->db->where('id', $id_user);
        $this->db->group_start();
        $this->db->like('id_surat', $q);
        $this->db->or_like('klasifikasi.nama_klasifikasi', $q);
        $this->db->or_like('users.first_name', $q);
        $this->db->or_like('tujuan', $q);
        $this->db->or_like('nomor_surat', $q);
        $this->db->or_like('perihal', $q);
        $this->db->or_like('tgl_surat', $q);
        $this->db->or_like('file_surat', $q);
        $this->db->or_like('surat.keterangan', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('arsip', $q);
        $this->db->group_end();
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $id_user) {
        $this->db->select('*, surat.keterangan as ketsurat');
        $this->db->join('users', 'users.id = surat.id_user');
        $this->db->join('klasifikasi', 'klasifikasi.id_klasifikasi = surat.id_klasifikasi');
        $this->db->join('unit', 'unit.id_unit = surat.id_unit');
        $this->db->order_by($this->id, $this->order);
        if($id_user != '1'){
            $this->db->where('id_user', $id_user);
        }
        // $this->db->where('id', $id_user);
        $this->db->group_start();
        $this->db->like('id_surat', $q);
        $this->db->or_like('klasifikasi.nama_klasifikasi', $q);
        $this->db->or_like('users.first_name', $q);
        $this->db->or_like('tujuan', $q);
        $this->db->or_like('nomor_surat', $q);
        $this->db->or_like('perihal', $q);
        $this->db->or_like('tgl_surat', $q);
        $this->db->or_like('file_surat', $q);
        $this->db->or_like('surat.keterangan', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('arsip', $q);
        $this->db->group_end();
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
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }

    function get_lastid(){
        $this->db->select('max(id_surat) as last_id');
        return $this->db->get('surat')->row()->last_id;
    }


}

