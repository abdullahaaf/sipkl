<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Csiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa','model');
        $this->load->library("PHPExcel");
    }


    var $table = 'akademik_master_guru';
    var $column = array('akademik_master_guru.nip as NIP','akademik_master_guru.namaGuru as NAMA','kesiswaan_master_agama.namaAgama as AGAMA','akademik_master_guru.jenisKelamin as JENIS KELAMIN','akademik_master_guru.tempatLahir as TEMPAT LAHIR','akademik_master_guru.tanggalLahir as TANGGAL LAHIR','akademik_master_guru.alamatGuru as ALAMAT','akademik_master_guru.teleponGuru as TELEPON','akademik_master_guru.emailGuru as EMAIL');


    public function siswa_tambah(){
        $this->load->helper('url');
        $this->import();
    }

    public function import($success=""){
        $data['output'] = "<h4><b> Sebelum mengupload, pastikan file anda berformat <strong>.xls/.xlsx.</strong></b></h4>";
        $data['output'] .= form_open_multipart('Csiswa/do_upload');
        $form = array(
                    'name'        => 'userfile',
                    'style'       => 'position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=0);opacity:0;background-color:transparent;color:transparent;',
                    'onchange'  => "$('#upload-file-info').html($(this).val());"
                );
        $data['output'] .= "<div style='position:relative;'>";
        $data['output'] .= "1. <a class='btn btn-primary' href='javascript:;'>";
        $data['output'] .= "Browse… ".form_upload($form);
        $data['output'] .= "</a>";
        $data['output'] .= "&nbsp;";
        $data['output'] .= "<span class='label label-info' id='upload-file-info'></span>";
        $data['output'] .= "</div>";
        $data['output'] .= "<br>2. ";
        $data['output'] .= form_submit('name', 'Import', 'class = "btn btn-success"');
        $data['output'] .= form_close();
        if ($success) {
            $data['pesan'] = '<div class="alert alert-success alert-dismissible">';
            $data['pesan'] .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $data['pesan'] .= '<h4><i class="icon fa fa-check"></i> Berhasil!</h4>';
            $data['pesan'] .= 'Import siswa telah berhasil dan data telah dimasuk dalam data base';
            $data['pesan'] .= '</div>';
        }
        $this->load->view('header');
        $this->load->view('siswa_tambah', $data, FALSE);
        $this->load->view('footer');
    }

    public function do_upload(){
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = '*';
        
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->model->upload_data($filename);
            unlink('./assets/uploads/'.$filename);
            redirect('Csiswa/import/success','refresh');
        }
    }
 
    public function siswa_data()
    {
        $this->load->view('header');
        $this->load->view('siswa_data');        
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
            $row[] = $model->jenis_kelamin;
            $row[] = $model->alamat;
            $row[] = $model->telp_siswa;
            $row[] = $model->nama_ortu;
            $row[] = $model->telp_ortu;
            $row[] = $model->status;

            //add html for action
            $row[] = '<a href="javascript:void()" title="Edit" onclick="edit_data('."'".$model->nis."'".')"><i class="fa fa-edit text-primary"></i></a>
                  <a href="javascript:void()" title="Hapus" onclick="delete_data('."'".$model->nis."'".')"><i class="fa fa-trash text-danger"></i></a>';
        
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
                'nis' => $this->input->post('nis'),
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'telp_siswa' => $this->input->post('telp_siswa'),
                'nama_ortu' => $this->input->post('nama_ortu'),
                'telp_ortu' => $this->input->post('telp_ortu'),
                'status' => $this->input->post('status'),
            );
        $insert = $this->model->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
                // 'nis' => $this->input->post('nis'),
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'telp_siswa' => $this->input->post('telp_siswa'),
                'nama_ortu' => $this->input->post('nama_ortu'),
                'telp_ortu' => $this->input->post('telp_ortu'),
                'status' => $this->input->post('status'),
            );
        $this->model->update(array('nis' => $this->input->post('nis')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
