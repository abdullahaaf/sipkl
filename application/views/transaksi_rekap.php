<div class="card">
	<div class="card-block">
		<div class="row">
			<h3><center>Data History Pembayaran Siswa</center></h3>
		</div>
	<br>
	<br>
	<div class="row">
		<div class="table-responsive">
			<table id="table-rekap" class="table table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Nis</th>
						<th>Nama</th>
						<th>Kelas</th>						
						<th>Jenis Pembayaran</th>
						<th>Tanggal Bayar</th>						
						<th>Keterangan</th>
						<th>Aksi</th>
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
        table_pesan_masuk = $('#table-rekap').dataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Ctransaksi/ajax_list')?>",
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

    function delete_data(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('Ctransaksi/ajax_delete')?>/"+id,
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