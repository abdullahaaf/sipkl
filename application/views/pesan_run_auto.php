<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <title>SIKUS</title>

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

    <style>
        .login-form {
            width: 25rem;
            height: 25rem;
            position: fixed;
            top: 50%;
            margin-top: -12.375rem;
            left: 50%;
            margin-left: -12.5rem;
            background-color: #ffffff;
            opacity: 0;
            -webkit-transform: scale(.8);
            transform: scale(.8);
        }
    </style>

    <script>
        $(function(){
            var form = $(".login-form");

            form.css({
                opacity: 1,
                "-webkit-transform": "scale(1)",
                "transform": "scale(1)",
                "-webkit-transition": ".5s",
                "transition": ".5s"
            });
        });
    </script>
</head>
<body class="bg-darkTeal" onload="date()">
    <div class="login-form padding20 block-shadow">
            <center><h1 class="text-light">Sistem Informasi Keuangan</h1></center>
            <hr class="thin"/>
            <br />
                  <script type="text/javascript">
                      var detik = <?php echo date('s'); ?>;
                      var menit = <?php echo date('i'); ?>;
                      var jam   = <?php echo date('H'); ?>;

                      var tanggal = <?php echo date('d'); ?>;
                      var bulan = <?php echo date('m'); ?>;
                      var tahun = <?php echo date('Y'); ?>;
                       
                      function clock()
                      {
                          if (detik!=0 && detik%60==0) {
                              menit++;
                              detik=0;
                          }
                          second = detik;
                           
                          if (menit!=0 && menit%60==0) {
                              jam++;
                              menit=0;
                          }
                          minute = menit;
                           
                          if (jam!=0 && jam%24==0) {
                              jam=0;
                          }
                          hour = jam;
                           
                          if (detik<10){
                              second='0'+detik;
                          }
                          if (menit<10){
                              minute='0'+menit;
                          }
                           
                          if (jam<10){
                              hour='0'+jam;
                          }
                          waktu = hour+':'+minute+':'+second;
                           
                          document.getElementById("clock").innerHTML = " "+waktu;
                          detik++;
                      }

                      function date(){
                          var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                          var date = new Date();
                          var day = date.getDate();
                          var month = date.getMonth();
                          var yy = date.getYear();
                          var year = (yy < 1000) ? yy + 1900 : yy;
                          view_tanggal = day + " " + months[month] + " " + year;
                          document.getElementById("date").innerHTML = " "+view_tanggal;
                      }
                   
                      setInterval(clock,1000);
                      // setiap 24 jam
                      setInterval(date,86400);

                  </script>
                  <center>
                    <i><font color="red">Catatan: <br> Jangan tutup halaman ini! supaya auto sms tetap berjalan <hr></font></i>
                    <h1><span id="clock"></span> </span></h1>
                    <h1><span id="date"></span> </span></h1>
                    <hr>
                    <br>
                  </center>
    </div>
    <script type="text/javascript">

      $(document).ready(function() {
        setInterval(auto_reply,1000);
      });

      function auto_reply(){
          $.ajax({
              url : "<?php echo site_url('Ckirim_pesan/cek_auto_reply')?>",
              type: "POST",
              success: function(data)
              {
                 
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  
              }
          });
      } 
    </script>
</body>
</html>