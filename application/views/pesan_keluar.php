<!-- pesan keluar -->
<div class="card">
    <div class="card-block">
          <br>
          <div class="form-header">
            <center>
                <h3>Pesan Keluar</h3>
            </center>
          </div>

           <div class="row">
                <div class="col-md-12" style="overflow-x:scroll;">
                    <table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr class="success">
                            <th>ID</th>
                            <th>Nomor Tujuan</th>
                            <th>Waktu Kirim</th>
                            <th>Pesan</th>
                            <th style="width:50px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>                   
                </div>
            </div>   
            <!-- 
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-register">
            Modal Register
            </button> -->

    </div>
</div>    

<script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {   
        $('textarea#textarea1').characterCounter();

        table = $('#table').dataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Csms/ajax_list')?>",
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

    function edit_data(argument) {
      // alert(argument);
      $('#modal-register').modal('show');
    }
    function edit_data2(nis)
    {
      $('#modal-register').modal('show');

        $.ajax({
          url : "<?php echo site_url('Csiswa/ajax_edit/')?>/" + nis,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {            
              $('[name="penerbitBuku"]').val(data.penerbitBuku);
              $('[name="kotaPenerbitBuku"]').val(data.kotaPenerbitBuku);
              
              $('#modal-register').modal('show'); 
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

    function delete_data(nis)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('Csms/ajax_delete')?>/"+nis+"/outbox",
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
  