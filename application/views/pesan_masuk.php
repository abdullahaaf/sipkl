<!-- pesan masuk -->
<div class="card">
    <div class="card-block">
          <br>
          <div class="form-header">
            <center>
                <h3>Pesan Masuk</h3>
            </center>
          </div>

           <div class="row">
                <div class="col-md-12" style="overflow-x:scroll;">
                    <table id="table_pesan_masuk" class="table table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr class="success">
                            <th>ID</th>
                            <th>Nomor Pengirim</th>
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
    </div>
</div>    

<script type="text/javascript">

    var save_method; //for save method string
    var table_pesan_masuk;
    $(document).ready(function() {   
        $('textarea#textarea1').characterCounter();

        table_pesan_masuk = $('#table_pesan_masuk').dataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Csms/ajax_list_pesan_masuk')?>",
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

    function edit_data(id)
    {
      $.ajax({
        url : "<?php echo site_url('Csms/ajax_edit_pesan_masuk/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nomor-pengirim"]').val(data.SenderNumber);
            $('[name="pesan-pengirim"]').val(data.TextDecoded);
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function kirim_balasan()
    {
        url = "<?php echo site_url('Csms/ajax_kirim_balasan')?>";
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                $('[name="nomor-pengirim"]').val("");
                $('[name="pesan-pengirim"]').val("");
                $('[name="pesan"]').val("");
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
            url : "<?php echo site_url('Csms/ajax_delete')?>/"+nis+"/inbox",
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
                <h3><i class="fa fa-refresh"></i> Balas</h3>
            </div>
            <!--Body-->
            <div class="modal-body">
              <form action="#" id="form">
                <div class="md-form">
                    <i class="fa fa-user prefix"></i>
                    <input type="text" placeholder="Pengirim" name="nomor-pengirim" readonly="readonly" id="form2" class="form-control">
                    <label for="form2"><font color="text-green">Pengirim</font></label>
                </div>

                <div class="md-form">
                  <i class="fa fa-cloud-download prefix"></i>
                  <textarea placeholder="Pesan Pengirim" name="pesan-pengirim" id="textarea1" class="md-textarea" disabled="disabled"></textarea>
                  <label for="textarea1"><font color="text-green">Pesan Pengirim</font></label>
                </div>

                <div class="md-form">
                  <i class="fa fa-envelope-o prefix"></i>
                  <textarea name="pesan" id="textarea1" class="md-textarea" length="160" maxlength="160"></textarea>
                  <label for="textarea1">Ketik Text Balasan</label>
                </div>
              </form>

                <div class="text-xs-center">
                    <button onclick="kirim_balasan()" data-dismiss="modal" class="btn btn-primary btn-lg"><i class="fa fa-send-o"></i> Balas</button>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal End -->
