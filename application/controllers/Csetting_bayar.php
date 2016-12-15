<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csetting_bayar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_bayar','model');
        $this->load->model('Setting_jenis_bayar','model_jenis');
    }

//-------->Setting nama pembayaran
    public function index()
    {
    	$this->load->view('header');
        $this->load->view('setting_nama_bayar');        
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
            $row[] = $model->id_namabyr;
            $row[] = $model->nama_byr;
            $row[] = $model->ket;

            //add html for action
            $row[] = '<a href="javascript:void_namabyr()" title="Edit" onclick="edit_data('."'".$model->id_namabyr."'".')"><i class="fa fa-edit text-primary"></i></a>
                  <a href="javascript:void_namabyr()" title="Hapus" onclick="delete_data('."'".$model->id_namabyr."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
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

    public function ajax_edit($id)
    {
        $data = $this->model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array(
                'nama_byr' => $this->input->post('nama_pembayaran'),
                'ket' => $this->input->post('keterangan'),
            );
        $insert = $this->model->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
                'nama_byr' => $this->input->post('nama_pembayaran'),
                'ket' => $this->input->post('keterangan'),
            );
        $this->model->update(array('id_namabyr' => $this->input->post('id_update')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


//---------setting jenis bayar
    public function jenis_bayar()
    {
    	$this->load->view('header');
        $data['tingkat']=$this->model_jenis->ambil_tingkat();
        $data['jns_byr']=$this->model_jenis->jenis_bayar();
        $this->load->view('setting_jenis_bayar',$data);        
        $this->load->view('footer');
    }

    public function ajax_list2()
    {
        $list = $this->model_jenis->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model_jenis) {
            $no++;
            $row = array();
            $row[] = $no;
            // $row[] = $model_jenis->id_jnsbyr;
            $row[] = $model_jenis->nama_byr;
            $row[] = $model_jenis->biaya;
            $row[] = $model_jenis->tingkat;

            //add html for action
            $row[] = '<a href="javascript:void_namabyr()" title="Edit" onclick="edit_data('."'".$model_jenis->id_jnsbyr."'".')"><i class="fa fa-edit text-primary"></i></a>
                  <a href="javascript:void_namabyr()" title="Hapus" onclick="delete_data('."'".$model_jenis->id_jnsbyr."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
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

    public function ajax_edit2($id)
    {
        $data = $this->model_jenis->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add2()
    {
        $data = array(
                'id_namabyr' => $this->input->post('namapembayaran'),
                'id_kls' => $this->input->post('tingkat'),
                'biaya' => $this->input->post('besarpembayaran'),
                'id_thnajar' => "1",
            );
        $insert = $this->model_jenis->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update2()
    {
        $data = array(
                'id_namabyr' => $this->input->post('namapembayaran'),
                'id_kls' => $this->input->post('tingkat'),
                'biaya' => $this->input->post('besarpembayaran'),
                'id_thnajar' => "1",
            );
        $this->model_jenis->update(array('id_jnsbyr' => $this->input->post('id_jnsbyr')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete2($id,$tabel)
    {
        $this->model_jenis->delete_by_id($id,$tabel);
        echo json_encode(array("status" => TRUE));
    }
}