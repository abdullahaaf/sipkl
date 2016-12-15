<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctransaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaksi','model');
        $this->load->model('Sms','modelsms');
    }

    public function index()
    {
    	$this->load->view('header');
        $data['kelas']=$this->modelsms->ambil_kelas();
        $data['jns_byr']=$this->model->jenis_bayar();
        $this->load->view('transaksi_proses',$data);        
        $this->load->view('footer');
    }

    public function transaksi_proses()
    {
    	$this->load->view('header');        
        $data['kelas']=$this->modelsms->ambil_kelas();
        $data['jns_byr']=$this->model->jenis_bayar();
        $this->load->view('transaksi_proses',$data);        
        $this->load->view('footer');
    }

    public function ajax_add()
    {
        $data = array(
                'id_kls' => $this->input->post('pilih_kelas'),
                'nis' => $this->input->post('pilih_siswa'),
                'tgl_byr' => $this->input->post('tanggal'),
                'id_jnsbyr' => $this->input->post('pilih_jnsbyr'),
                'ket' => $this->input->post('keterangan'),
            );
        $insert = $this->model->save($data);
        echo json_encode(array("status" => TRUE));
    }

// ====== history data pembayaran
    public function transaksi_rekap()
    {
    	$this->load->view('header');
        $this->load->view('transaksi_rekap');        
        $this->load->view('footer');
    }

    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $model->nis;
            $row[] = $model->nama;
            $row[] = $model->tingkat." ".$model->kelas;
            $row[] = $model->nama_byr;
            $row[] = $model->tgl_byr;
            $row[] = $model->ket;

            $row[] = '
                  <a href="javascript:void_namabyr()" title="Hapus" onclick="delete_data('."'".$model->id_transaksi."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model->count_all(),
                        "recordsFiltered" => $this->model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_delete($id)
    {
        $this->model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


}
