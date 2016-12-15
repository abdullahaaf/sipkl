<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_jenis_bayar extends CI_Model {
	// pesan keluar
	var $table = 'jenis_bayar';
	var $column = array('id_jnsbyr','id_namabyr','biaya','id_thnajar','tingkat');
	var $order = array('id_namabyr' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function jenis_bayar()
	{
		$this->db->from('nama_bayar');
		$query = $this->db->get();
		return $query->result();
	}

	public function ambil_tingkat()
	{
		$this->db->select("DISTINCT(kelas.tingkat),id_kls");
		$this->db->from("kelas");
		$this->db->group_by("tingkat");
		
		$sql = $this->db->get();
		return $sql->result();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->join('tahun_ajr','jenis_bayar.id_thnajar=tahun_ajr.id_thnajar','left');
		$this->db->join('nama_bayar','jenis_bayar.id_namabyr=nama_bayar.id_namabyr','left');
		$this->db->join('kelas','jenis_bayar.id_kls=kelas.id_kls','left');

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_jnsbyr',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id,$tabel)
	{
		$this->db->where('id_jnsbyr', $id);
		$this->db->delete($tabel);
	}
}