<div class="card">
	<div class="card-block">
		<div class="row">
			<h3><center>Tambah Data Setting Pembayaran</center></h3>
		</div>
		<br>
		<div class="row">
              <form id="form_tambah">
			          <div class="col-xs-3">
                    <div class="md-form">
                        <select id="namapembayaran" name="namapembayaran" class="mdb-select2 colorful-select dropdown-warning">
                            <option value="">--Nama Pembayaran</option>
                            <?php
                            foreach ($jns_byr as $key2) {
                                echo "<option value=".$key2->id_namabyr.">".$key2->nama_byr."</option>";
                            }
                            ?>
                        </select>
                        <label for="namapembayaran">Pilih Nama Pembayaran</label>                
                    </div>
                    <script type="text/javascript">
                            $(document).ready(function() {
                                $('.mdb-select2').material_select();
                              });                   
                    </script>
                </div>
                
                <div class="col-xs-3">
                    <div class="md-form">
                        <select id="tingkat" name="tingkat" class="mdb-select2 colorful-select dropdown-warning">
                            <option value="#">-- pilih tingkat --</option>
                            <?php
                                foreach ($tingkat as $tkt) {
                                    echo "<option value='$tkt->id_kls'>$tkt->tingkat</option>";
                                }                                
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="md-form">
                        <i class="fa fa-dollar prefix"></i>
                        <input name="besarpembayaran" placeholder="Besar Pembayaran" type="text" id="besarpembayaran" class="form-control">
                        <input name="id_jnsbyr" type="hidden" id="id_jnsbyr" class="form-control">
                        <label for="besarpembayaran">Besar Pembayaran</label>
                    </div>
                </div>
              </form>
        		    <div class="col-md-3">
                    <div class="text-xs-center">
                        <a onclick="tambah_data()" class="btn btn-success"><i class="fa fa-plus left"></i> Tambah</a>
                    </div>
                </div>
   		</div>

		<!-- javascript script -->
		<script type="text/javascript">
			$(document).ready(function() {
						$('.mdb-select').material_select();
					});
			$('.datepicker').pickadate();
		</script>

	</div>
	<br>
</div>	
<div class="card">
	<div class="card-block">
          <br>
          <div class="form-header">
            <center>
                <h3>Data Nama Pembayaran</h3>
            </center>
          </div>
          <br>
           <div class="row">
                <div class="col-md-12" style="overflow-x:scroll;">
                    <div class="table-responsive">
                    	<table id="table" class="table table-bordered table-hover" cellspacing="0" width="100%">
	                        <thead>
		                          <tr class="success">
		                            <th>Nomor</th>
		                            <th>Nama Pembayaran</th>
		                            <th>Besar Pembayaran</th>
                                    <th>Tingkat</th>
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
            "url": "<?php echo site_url('Csetting_bayar/ajax_list2')?>",
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


    function tambah_data()
    {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('Csetting_bayar/ajax_add2')?>";
      }
      else
      {
        url = "<?php echo site_url('Csetting_bayar/ajax_update2')?>";
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
              window.location.reload(true);
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
        url : "<?php echo site_url('Csetting_bayar/ajax_edit2/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_jnsbyr"]').val(data.id_jnsbyr);
            $('[name="namapembayaran"]').val(data.id_namabyr);
            $('[name="tingkat"]').val(data.id_kls);
            $('[name="besarpembayaran"]').val(data.biaya);
            alert("Silahkan lihat dan update di form atas!");
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
            url : "<?php echo site_url('Csetting_bayar/ajax_delete2')?>/"+id+"/jenis_bayar",
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