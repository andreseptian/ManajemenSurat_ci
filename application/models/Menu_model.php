<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $table = 'menu';
    public $id = 'id_menu';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_menu,parent_id,icon,label,link,id,menu.id_menu_type,menu_type.type');
        $this->datatables->from('menu');
        //add this line for join
        $this->datatables->join('menu_type', 'menu.id_menu_type =  menu_type.id_menu_type');
        $this->datatables->add_column('action', anchor(site_url('menu/read/$1'),'<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"')."  ".anchor(site_url('menu/update/$1'),'<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning"')."  ".anchor(site_url('menu/delete/$1'),'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_menu');
        return $this->datatables->generate();
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
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_menu', $q);
	$this->db->or_like('parent_id', $q);
	$this->db->or_like('icon', $q);
	$this->db->or_like('label', $q);
	$this->db->or_like('link', $q);
	$this->db->or_like('id', $q);
	$this->db->or_like('id_menu_type', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_menu', $q);
	$this->db->or_like('parent_id', $q);
	$this->db->or_like('icon', $q);
	$this->db->or_like('label', $q);
	$this->db->or_like('link', $q);
	$this->db->or_like('id', $q);
	$this->db->or_like('id_menu_type', $q);
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

}

