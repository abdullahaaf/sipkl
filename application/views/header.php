<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>.: SIP_PKL :.</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/font/fontawesome/css/font-awesome.min.css');?>">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url('assets/css/mdb.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/compiled.min.css');?>" rel="stylesheet">

    <!-- Your custom styles (optional) -->
    <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/js/datatables/dataTables.bootstrap.css');?>" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.3.min.js');?>"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/tether.min.js');?>"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

    <!-- MDB core JavaScript -->
    <!-- <script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js');?>"></script>   -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/materialize.js');?>"></script>

    <script src="<?=base_url('assets/js/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?=base_url('assets/js/datatables/dataTables.bootstrap.js')?>"></script>
    <link href="<?=base_url('assets/js/datepicker/datepicker3.css');?>" rel="stylesheet" type="text/css" />
    <script src="<?=base_url('assets/js/datepicker/bootstrap-datepicker.js');?>"></script>

</head>

<body>
    <header>

        <!--Navbar-->
        <nav class="navbar navbar-dark bg-primary">

            <div class="container">
                <!--Collapse content-->
                <div class="collapse navbar-toggleable-xs" id="collapseEx2">
                    <!--Navbar Brand-->
                    <!--Navbar icons-->
                    <ul class="nav navbar-nav nav-flex-icons">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?=$this->session->userdata('nama');?></a>
                            <div class="dropdown-menu dropdown-secondary" aria-labelledby="dropdownMenu1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <a class="dropdown-item text-danger" href="<?php echo site_url('Cauth/logout'); ?>">Keluar</a>
                            </div>
                        </li>
                    </ul>
                    <!--/Navbar icons-->
                    <a class="navbar-brand" href="<?php echo site_url('Cdashboard')?>">.: SIP_PKL :.</a>
                    <!--Links-->
                    <ul class="nav navbar-nav">
                        <li class="nav-item btn-group">
                            <a class="nav-link" href="<?php echo site_url('Cinfo')?>" aria-haspopup="true" aria-expanded="false">Info</a>
                        </li>
                        <!-- <li class="nav-item btn-group">
                            <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data Siswa</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <a href="<?php echo site_url('Csiswa/siswa_data')?>" class="dropdown-item">Data Siswa</a>
                                <a href="<?php echo site_url('Csiswa/siswa_tambah')?>" class="dropdown-item">Tambah Siswa</a>
                            </div>
                        </li> -->
                        <!-- <li class="nav-item btn-group">
                            <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">SMS Gateway</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <a href="<?php echo site_url('Csms/pesan_kirim')?>" class="dropdown-item">Kirim Pesan</a>
                                <a href="<?php echo site_url('Csms/pesan_keluar')?>" class="dropdown-item">Pesan Keluar</a>
                                <a href="<?php echo site_url('Csms/pesan_terkirim')?>" class="dropdown-item">Pesan Terkirim</a>
                                <a href="<?php echo site_url('Csms/pesan_masuk')?>" class="dropdown-item">Pesan Masuk</a>
                                <a href="<?php echo site_url('Csms/pesan_auto')?>" class="dropdown-item">Pengaturan Auto</a>
                            </div>
                        </li> -->
                    </ul>
                </div>
                <!--/.Collapse content-->

            </div>

        </nav>
        <!--/.Navbar-->

    </header>

    <main>

        <!--Main layout-->
        <div class="container">
        <br>