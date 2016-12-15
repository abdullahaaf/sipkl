<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Model {

	public function ambil_kelas()
	{
		$this->db->select('DISTINCT(kelas.tingkat), siswa_kelas.id_sk, kelas.kelas, siswa_kelas.id_kls');
		$this->db->from('siswa_kelas');
		$this->db->join('kelas','siswa_kelas.id_kls=kelas.id_kls','left');
		$this->db->join('tahun_ajr','siswa_kelas.id_thnajar=tahun_ajr.id_thnajar','left');
		$this->db->where('tahun_ajr.status="1"');
		$hasil = $this->db->get();
		return $hasil->result();
	}

	public function ambil_siswa($value)
	{
		$sql='SELECT * FROM siswa_kelas 
				LEFT JOIN kelas ON siswa_kelas.id_kls=kelas.id_kls
				LEFT JOIN tahun_ajr ON siswa_kelas.id_thnajar=tahun_ajr.id_thnajar
				LEFT JOIN siswa ON siswa_kelas.nis=siswa.nis 
				WHERE tahun_ajr.status=1 && siswa_kelas.id_kls='.$value;
		$hasil = $this->db->query($sql);
		return $hasil->result();
	}

	// pesan keluar
	var $table = 'outbox';
	var $column = array('ID','DestinationNumber','SendingDateTime','TextDecoded');
	var $order = array('ID' => 'desc');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);

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
		$this->db->where('ID',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id,$tabel)
	{
		$this->db->where('ID', $id);
		$this->db->delete($tabel);
	}


	// pesan masuk
	var $table_pesan_masuk = 'inbox';
	var $column_pesan_masuk = array('ID','ReceivingDateTime','SenderNumber','TextDecoded');

	private function _get_datatables_query_pesan_masuk()
	{
		$this->db->from($this->table_pesan_masuk);

		$i = 0;
	
		foreach ($this->column_pesan_masuk as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column_pesan_masuk[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column_pesan_masuk[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_pesan_masuk()
	{
		$this->_get_datatables_query_pesan_masuk();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_pesan_masuk()
	{
		$this->_get_datatables_query_pesan_masuk();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_pesan_masuk()
	{
		$this->db->from($this->table_pesan_masuk);
		return $this->db->count_all_results();
	}

	public function get_by_id_pesan_masuk($id)
	{
		$this->db->from($this->table_pesan_masuk);
		$this->db->where('ID',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_kirim_balasan($data)
	{
		$this->db->insert('outbox', $data);
		return $this->db->insert_id();
	}

	public function delete_by_id_pesan_masuk($id)
	{
		$this->db->where('ID', $id);
		$this->db->delete($this->table_pesan_masuk);
	}




	// pesan terkirim
	var $table_pesan_terkirim = 'sentitems';
	var $column_pesan_terkirim = array('ID','SendingDateTime','DestinationNumber','TextDecoded');

	private function _get_datatables_query_pesan_terkirim()
	{
		$this->db->from($this->table_pesan_terkirim);

		$i = 0;
	
		foreach ($this->column_pesan_terkirim as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column_pesan_terkirim[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column_pesan_terkirim[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_pesan_terkirim()
	{
		$this->_get_datatables_query_pesan_terkirim();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_pesan_terkirim()
	{
		$this->_get_datatables_query_pesan_terkirim();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_pesan_terkirim()
	{
		$this->db->from($this->table_pesan_terkirim);
		return $this->db->count_all_results();
	}

	public function get_by_id_pesan_terkirim($id)
	{
		$this->db->from($this->table_pesan_terkirim);
		$this->db->where('ID',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id_pesan_terkirim($id)
	{
		$this->db->where('ID', $id);
		$this->db->delete($this->table_pesan_terkirim);
	}
}
