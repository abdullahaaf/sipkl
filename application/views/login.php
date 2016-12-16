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

    <!-- Your custom styles (optional) -->
    <!-- <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet"> -->
    <style type="text/css">
        html,
        body,
        .view {
            height: 100%;
        }

        /*Intro*/

        .view {
            background: url("<?php echo base_url('assets/img/uin.jpg');?>")no-repeat center center fixed;            
                -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        @media (max-width: 768px) {
            .full-bg-img,
            .view {
                height: auto;
                position: relative;
            }
        }

        /* Navigation*/

        .navbar {
            background-color: transparent;
        }

        .top-nav-collapse {
            background-color: #1C2331;
        }

        @media only screen and (max-width: 768px) {
            .navbar {
                background-color: #1C2331;
            }
        }

        .description {
            padding-top: 25%;
            padding-bottom: 3rem;
            color: #fff
        }

        @media (max-width: 992px) {
            .description {
                padding-top: 7rem;
                text-align: center;
            }
        }
    </style>

</head>

<body>


    <!--Navbar-->
    <nav class="navbar navbar-dark navbar-fixed-top scrolling-navbar">

        <!-- Collapse button-->
        <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
            <i class="fa fa-bars"></i>
        </button>

        <div class="container">

            <!--Collapse content-->
            <!-- <div class="collapse navbar-toggleable-xs" id="collapseEx"> -->
                <!--Navbar Brand-->
                <!-- <a class="navbar-brand" href="" target="_blank">SIKUS</a> -->
                <!--Links-->
               <!--  <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#best-features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                </ul> -->
            <!-- </div> -->
            <!--/.Collapse content-->

        </div>

    </nav>
    <!--/.Navbar-->

    <!--Mask-->
    <div class="view hm-black-strong">
        <div class="full-bg-img flex-center">
            <div class="container">
                <div class="row" id="home">

                    <!--First column-->
                    <div class="col-lg-6" id="deskripsi">
                        <div class="description">
                            <h2>Sistem Pendaftaran PKLI </h2>
                            <hr class="hr-dark">
                            <p class="wow fadeInLeft" data-wow-delay="0.4s">Aplikasi sistem pendaftaran ini ditujukan kepada mahasiswa jurusan Teknik Informatika untuk mempermudah proses dalam pendaftaran PKLI</p>
                        </div>
                    </div>

                    <script type="text/javascript">
                        $('deskripsi').addClass('animated fadeInUp');
                    </script>

                    <!--/.First column-->

                    <!--Second column-->
                    <div class="col-lg-6">
                        <!--Form-->
                        <div class="card wow fadeInRight">
                            <div class="card-block">
                                <div class="text-xs-center">
                                    <h3>LOGIN</h3>
                                </div>                                
                                <form action="<?php echo $action; ?>" method="post" >
                                <!--Body-->
                                <?php echo $error; ?>

                                <div class="md-form">
                                    <i class="fa fa-user prefix"></i>
                                    <input name="username" type="text" id="form2" class="form-control">
                                    <label for="form2">Username</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix"></i>
                                    <input name="password" type="password" id="form4" class="form-control">
                                    <label for="form4">Password</label>
                                </div>

                                <div class="text-xs-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                                    <hr>
                                </div>
                                </form>

                            </div>
                        </div>
                        <!--/.Form-->
                    </div>
                    <!--/Second column-->
                </div>
            </div>
        </div>
    </div>
    <!--/.Mask-->

    <!--Main container-->
    <div class="container">

        <!-- <div class="divider-new">
            <h2 class="h2-responsive wow fadeInDown">Best Features</h2>
        </div> -->

        <!--Section: Best features-->
        <!--/Section: Best features-->

       <!--  <div class="divider-new">
            <h2 class="h2-responsive">Contact us</h2>
        </div> -->

        <!--Section: Contact-->
        <section id="contact">
            <div class="row">
                <!--First column-->
                <div class="col-md-8">

                </div>
                <!--/First column-->

                <!--Second column-->
                <div class="col-md-4">

                </div>
                <!--/Second column-->
            </div>
        </section>
        <!--Section: Contact-->

    </div>
    <!--/Main container-->

    <!--Footer-->
    <footer class="page-footer center-on-small-only">


    </footer>
    <!--/.Footer-->


    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.3.min.js');?>"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/tether.min.js');?>"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js');?>"></script>

</body>

</html>