<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cauth extends CI_Controller {

    function __construct() {
        parent::__construct();        
    }

    public function index($error = NULL) {
        
        $data = array(
            'action' => site_url('Cauth/login'),
            'error' => $error
        );
        $this->load->view('login',$data);
    }

    public function login() {
        $this->load->model('Auth','model');
        $login = $this->model->login($this->input->post('username'), md5($this->input->post('password')));

        if ($login == 1) {
//          ambil detail data
            $row = $this->model->data_login($this->input->post('username'), md5($this->input->post('password')));

//          daftarkan session
            $data = array(
                'sikus' => TRUE,
                'nama' => $row->nama,
                'username' => $row->username,
                'role' => $row->role
            );
            $this->session->set_userdata($data);

//            redirect ke halaman sukses
            if($row->role=="bendahara"){
                redirect(site_url('Cdashboard'));
            }
        } else {
//            tampilkan pesan error
            $error = '<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong><center><font color="red">Warning!</center></strong><center>Masukan ada yang kurang tepat!</font></center></div>';
            $this->index($error);
        }
    }
    function logout() {
//        destroy session
        $this->session->sess_destroy();
        
//        redirect ke halaman login
        redirect(site_url('Cauth'));
    }
}
