<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ckirim_pesan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kirim_pesan','model');
    }

    public function kirim_pesan()
    {
        $pilih_kelas = $this->input->post('pilih_kelas'); 
        $nis = $this->input->post('pilih_siswa');
        $pilih_nomer = $this->input->post('pilihNomer');
        $pesan = $this->input->post('pesan');

        if ($nis!=null) {
            //sesuai pilihan siswa            
            $this->model->kirim($pesan,$nis,$pilih_nomer,$pilih_kelas);
        }else{
            //broadcast
            $this->model->kirim_broadcast($pesan,$pilih_nomer,$pilih_kelas);
        }                                        
        echo json_encode(array("status" => TRUE));
    }

    public function cek_auto_reply()
    {
        $this->model->auto_reply();
    }
}
