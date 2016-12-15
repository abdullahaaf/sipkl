
<br>
<!--Form with header-->
<div class="card">
    <div class="card-block">        
        <!--Header-->
        <div class="form-header">
        <center>
            <h3>
            Tambah Nama Pembayaran
            </h3>
        </center>
        </div>

        <!--Body-->
          <form action="javascript:;" id="form_tambah">
            
            <br>
            <div class="row">
                <div class="col-md-7">
                    <div class="md-form">
                        <i class="fa fa-plus prefix"></i>
                        <input type="hidden" id="id_update" name="id_update">
                        <input placeholder="Nama Pembayaran" name="nama_pembayaran" type="text" id="form5" class="form-control">
                        <label for="form5">Nama Pembayaran</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="md-form">
                        <select id="keterangan" name="keterangan" class="mdb-select2 colorful-select dropdown-warning">
                            <option value="">--Pilih Keterangan</option>
                            <option value="bulan">Bulan</option>
                            <option value="lain">Lain</option>
                        </select>
                        <label for="keterangan">Pilih Keterangan</label>                
                    </div>
                    <script type="text/javascript">
                            $(document).ready(function() {
                                $('.mdb-select2').material_select();
                              });                   
                    </script>
                </div>
                <div class="col-md-2">
                    <div class="text-xs-center">
                        <a onclick="save()" class="btn btn-success"><i class="fa fa-save left"></i> Simpan</a>
                    </div>
                    <script type="text/javascript">                        
                    </script>
                </div>
            </div> <!-- row -->
          </form>
    </div>
</div>
<!--/Form with header-->

<!-- pesan keluar -->
<div class="card">
    <div class="card-block">
          <br>
          <div class="form-header">
            <center>
                <h3>Data Nama Pembayaran</h3>
            </center>
          </div>

           <div class="row">
                <div class="col-md-12" style="overflow-x:scroll;">
                    <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr class="success">
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th style="width:50px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>                   
                </div>
            </div>   
    </div>
</div>    

<script type="text/javascript">

    var save_method="add"; 
    var table;
    $(document).ready(function() {   
        table = $('#table').dataTable({
        
        "processing": true, 
        "serverSide": true, 
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Csetting_bayar/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });


    function save()
    {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('Csetting_bayar/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('Csetting_bayar/ajax_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_tambah').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              save_method = 'add';
              reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function edit_data(id)
    {
      save_method = 'update';

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Csetting_bayar/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_update"]').val(data.id_namabyr);
            $('[name="nama_pembayaran"]').val(data.nama_byr);
            $('[name="keterangan"]').val(data.ket);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function delete_data(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('Csetting_bayar/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               window.location.reload(true);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
         
      }
    }
  </script>           
                                
<!-- Modal Register -->
<div class="modal fade modal-ext" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3><i class="fa fa-user"></i> Register with:</h3>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="text" id="form2" class="form-control">
                    <label for="form2">Your email</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-lock prefix"></i>
                    <input type="password" id="form3" class="form-control">
                    <label for="form3">Your password</label>
                </div>

                <div class="text-xs-center">
                    <button class="btn btn-primary btn-lg">Sign up</button>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal End -->
