<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Model {

	public function upload_data($filename){
        ini_set('memory_limit', '-1');
        $inputFileName = './assets/uploads/'.$filename;
        try {
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);

        //$i untuk import nya mulai row brapa
        for ($i=2; $i < ($numRows+1) ; $i++) { 
            //nama field db
	        $ins = array(
	        		"nis"      		=> $worksheet[$i]["A"],
	        		"nama"   		=> $worksheet[$i]["B"],
	        		"jenis_kelamin" => $worksheet[$i]["C"],
	        		"alamat"      	=> $worksheet[$i]["D"],
	        		"telp_siswa"    => $worksheet[$i]["E"],
	        		"nama_ortu"     => $worksheet[$i]['F'],
	        		"telp_ortu"     => $worksheet[$i]["G"],
	        		"status"      	=> $worksheet[$i]["H"],
	        	   );
            //nama tabel db
	        $this->db->insert('siswa', $ins);

	        $kls = $worksheet[$i]["I"];
	        $tngkat = $worksheet[$i]["J"];
	        $kelas = array(
	        		"kelas"     => $kls,
	        		"tingkat"   => $tngkat,
	        	   );
            //nama tabel db
            $cek = $this->cek_tingkat($tngkat,$kls);
            if ($cek == 0) {
            	$this->db->insert('kelas', $kelas);

            	$sql = 'select id_kls from kelas where tingkat = "'.$tngkat.'" && kelas = "'.$kls.'"';
            	$query = $this->db->query($sql);
            	$id_kls = $query->row()->id_kls;
            	$siswa_kelas = array(
	        		"nis"     => $worksheet[$i]["A"],
	        		"id_kls"   => $id_kls,
	        		"id_thnajar"   => "1",
	        	   );
            	$this->db->insert('siswa_kelas', $siswa_kelas);
            }

	    }
    }

    public function cek_tingkat($tingkat,$kls)
    {
		$query =  'select * from kelas where tingkat = "'.$tingkat.'" && kelas = "'.$kls.'"';
		$sql = $this->db->query($query);    	
		return $sql->num_rows();
    }


	var $table = 'siswa';
	var $column = array('nis','nama','jenis_kelamin','alamat','telp_siswa','nama_ortu','telp_ortu','status');
	var $order = array('nis' => 'desc');

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
		$this->db->where('nis',$id);
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

	public function delete_by_id($id)
	{
		$this->db->where('nis', $id);
		$this->db->delete($this->table);
	}


}
