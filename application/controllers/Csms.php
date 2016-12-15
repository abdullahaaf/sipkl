<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sms','model');
    }

    public function view_full_auto_sms()
    {
        $this->load->view('pesan_run_auto');        
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('pesan_masuk');        
        $this->load->view('footer');
    }

    public function pesan_auto()
    {
        $this->load->view('header');
        $this->load->view('pesan_auto');        
        $this->load->view('footer');
    }

    public function pesan_keluar()
    {
        $this->load->view('header');
        $this->load->view('pesan_keluar');        
        $this->load->view('footer');
    }

    public function pesan_kirim()
    {
        $this->load->view('header');
        $data['kelas']=$this->model->ambil_kelas();
        $this->load->view('pesan_kirim',$data);        
        $this->load->view('footer');
    }

    public function ambil_siswa($value)
    {
        $hasil=$this->model->ambil_siswa($value);
        echo json_encode($hasil);
    }

    public function pesan_masuk()
    {
        $this->load->view('header');
        $this->load->view('pesan_masuk');        
        $this->load->view('footer');
    }

    public function pesan_terkirim()
    {
        $this->load->view('header');
        $this->load->view('pesan_terkirim');        
        $this->load->view('footer');
    }

    // pesan keluar
    public function ajax_list()
    {
        $list = $this->model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model) {
            $no++;
            $row = array();
            $row[] = $model->ID;
            $row[] = $model->DestinationNumber;
            $row[] = $model->SendingDateTime;
            $row[] = $model->TextDecoded;

            //add html for action
            $row[] = '
                  <a href="javascript:void()" title="Hapus" onclick="delete_data('."'".$model->ID."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
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

    // pesan masuk
    public function ajax_list_pesan_masuk()
    {
        $list = $this->model->get_datatables_pesan_masuk();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model) {
            $no++;
            $row = array();
            $row[] = $model->ID;
            $row[] = $model->SenderNumber;
            $row[] = $model->ReceivingDateTime;
            $row[] = $model->TextDecoded;

            //add html for action
            $row[] = '<a href="javascript:void()" data-toggle="modal" data-target="#modal-register" title="Balas" onclick="edit_data('."'".$model->ID."'".')"><i class="fa fa-paper-plane text-primary"></i></a>
                  <a href="javascript:void()" title="Hapus" onclick="delete_data('."'".$model->ID."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model->count_all_pesan_masuk(),
                        "recordsFiltered" => $this->model->count_filtered_pesan_masuk(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // pesan terkirim
    public function ajax_list_pesan_terkirim()
    {
        $list = $this->model->get_datatables_pesan_terkirim();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $model) {
            $no++;
            $row = array();
            $row[] = $model->ID;
            $row[] = $model->DestinationNumber;
            $row[] = $model->SendingDateTime;
            $row[] = $model->TextDecoded;

            //add html for action
            $row[] = '
                  <a href="javascript:void()" title="Hapus" onclick="delete_data('."'".$model->ID."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->model->count_all_pesan_terkirim(),
                        "recordsFiltered" => $this->model->count_filtered_pesan_terkirim(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit_pesan_masuk($id)
    {
        $data = $this->model->get_by_id_pesan_masuk($id);
        echo json_encode($data);
    }

    public function ajax_kirim_balasan()
    {
        $data = array(
                'DestinationNumber' => $this->input->post('nomor-pengirim'),
                'TextDecoded' => $this->input->post('pesan'),
            );
        $insert = $this->model->save_kirim_balasan($data);
        echo json_encode(array("status" => TRUE));
    }
    
//delete untuk fungsi uneversal
    public function ajax_delete($id,$tabel)
    {
        $this->model->delete_by_id($id,$tabel);
        echo json_encode(array("status" => TRUE));
    }

}
