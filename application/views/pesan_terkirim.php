<!-- pesan terkirim -->
  <div class="card">
    <div class="card-block">
          <br>
          <div class="form-header">
            <center>
                <h3>Pesan Terkirim</h3>
            </center>
          </div>

           <div class="row">
                <div class="col-md-12" style="overflow-x:scroll;">
                    <table id="table_pesan_terkirim" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr class="success">
                            <th>ID</th>
                            <th>Nomor Tujuan</th>
                            <th>Waktu Terkirim</th>
                            <th>Pesan</th>
                            <th style="width:30px;">Action</th>
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

    var table_pesan_masuk;
    $(document).ready(function() {   
        $('textarea#textarea1').characterCounter();

        table_pesan_masuk = $('#table_pesan_terkirim').dataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Csms/ajax_list_pesan_terkirim')?>",
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
      table_pesan_masuk.ajax.reload(null,false); //reload datatable ajax 
    }

    function delete_data(nis)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('Csms/ajax_delete')?>/"+nis+"/sentitems",
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