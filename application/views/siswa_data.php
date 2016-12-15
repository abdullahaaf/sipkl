           <div class="row">
                <div class="col-md-12">
                    <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr class="success">
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Orang Tua</th>
                            <th>Telepon Orang Tua</th>
                            <th>Status</th>
                            <th style="width:50px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>                   
                </div>
            </div>       

<script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {        
        table = $('#table').dataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Csiswa/ajax_list')?>",
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

    function add_person()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal-register').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

    function edit_data(nis)
    {
      // alert('cvss');
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('Csiswa/ajax_edit/')?>/" + nis,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nis"]').val(data.nis);
            $('[name="nama"]').val(data.nama);
            $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
            $('[name="alamat"]').val(data.alamat);
            $('[name="telp_siswa"]').val(data.telp_siswa);
            $('[name="nama_ortu"]').val(data.nama_ortu);
            $('[name="telp_ortu"]').val(data.telp_ortu);
            $('[name="status"]').val(data.status);

            $('#modal-register').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function save()
    {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('Csiswa/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('Csiswa/ajax_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
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
                    <input type="text" id="form2" class="form-control">
                    <label for="form2">Nis</label>
                </div>

                <div class="md-form">
                    <input type="text" id="form3" class="form-control">
                    <label for="form3">Nama</label>
                </div>

                <div class="md-form">
                  <input type="text" id="form4" class="form-control" >
                  <label for="form4">Jenis Kelamin</label>
                </div>

                <div class="md-form">
                  <input type="text" id="form5" class="form-control">
                  <label for="form5">Alamat</label>
                </div>

                <div class="md-form">
                  <input type="text" id="form6" class="form-control">
                  <label for="form6">Telp Siswa</label>
                </div>

                <div class="md-form">
                    <input type="text" id="form7" class="form-control">
                    <label for="form7">Nama Ortu</label>
                </div>

                <div class="md-form">
                  <input type="text" id="form8" class="form-control">
                  <label for="form8">Telpon Ortu</label>
                </div>

                <div class="text-xs-center">
                    <button class="btn btn-primary btn-lg">Simpan</button>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal End -->
