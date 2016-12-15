<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Model {
	public function jenis_bayar()
	{
		$this->db->from('jenis_bayar');
		$this->db->join('nama_bayar','jenis_bayar.id_namabyr=nama_bayar.id_namabyr','left');
		$this->db->join('kelas','jenis_bayar.id_kls=kelas.id_kls','left');
		$query = $this->db->get();
		return $query->result();
	}


// ======== history transaksi pembayaran
	var $table = 'transaksi';
	var $column = array('transaksi.id_transaksi','transaksi.nis','siswa.nama','kelas.kelas','kelas.tingkat','nama_bayar.nama_byr','transaksi.tgl_byr','transaksi.ket');
	var $order = array('id_transaksi' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		// $sql="SELECT siswa.nis, siswa.nama, kelas.kelas, kelas.tingkat, nama_bayar.nama_byr, transaksi.tgl_byr, transaksi.ket 
		// 	FROM transaksi
		// 	LEFT JOIN kelas ON transaksi.id_kls=kelas.id_kls
		// 	LEFT JOIN siswa ON transaksi.nis = siswa.nis
		// 	LEFT JOIN jenis_bayar ON transaksi.id_jnsbyr = jenis_bayar.id_jnsbyr
		// 	LEFT JOIN nama_bayar ON jenis_bayar.id_namabyr = nama_bayar.id_namabyr";

		$this->db->select($this->column);
		$this->db->from($this->table);
		$this->db->join('kelas','transaksi.id_kls=kelas.id_kls','left');
		$this->db->join('siswa','transaksi.nis=siswa.nis','left');
		$this->db->join('jenis_bayar','transaksi.id_jnsbyr=jenis_bayar.id_jnsbyr','left');
		$this->db->join('nama_bayar','jenis_bayar.id_namabyr=nama_bayar.id_namabyr','left');

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

	public function delete_by_id($id)
	{
		$this->db->where('id_transaksi', $id);
		$this->db->delete($this->table);
	}	
}