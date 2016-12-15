
	<br>
	<br>
		<div class="card">
			<div class="card-block">
				<!-- header -->
				<div class="form-header">
					<center>
						<h3>Pilih siswa yang akan melakukan pembayaran</h3>
					</center>
				</div>
				<br>
				<!-- end of header -->
				<div class="md-form">
		            <select id="kelas" name="pilih_kelas" onchange="ambil_siswa(this.value)" class="mdb-select colorful-select dropdown-primary">
		                    <option value="">--Pilih Kelas</option>
		                    <?php
		                    foreach ($kelas as $key) {
		                        echo "<option value=".$key->id_kls.">".$key->tingkat." ".$key->kelas."</option>";
		                    }
		                    ?>
	                </select>
	                <label for="kelas">Pilih Kelas</label>
	                <script type="text/javascript">
	                    $(document).ready(function() {
	                        $('.mdb-select').material_select();
	                      });
	                </script>
				</div>
				<div class="md-form" id="pilihan_siswa">
	                <select id="siswa" name="pilih_siswa" class="mdb-select2 colorful-select dropdown-warning">
	                    <option value="">--Pilih Siswa</option>
	                </select>
	                <label for="siswa">Pilih Siswa</label>                
           		</div>
				            <script type="text/javascript">
				                    $(document).ready(function() {
				                        $('.mdb-select2').material_select();
				                      });                   
				            </script>
				            <script type="text/javascript">
				                function ambil_siswa(kelas) {
				                        var create = '<select id="siswa" name="pilih_siswa" class="mdb-select2 colorful-select dropdown-warning">';
				                            create += '<option value="">--Pilih Siswa</option>';

				                        $.ajax({
				                            url : "<?php echo site_url('Csms/ambil_siswa')?>/" + kelas,
				                            type: "GET",
				                            dataType: "JSON",
				                            success: function(data)
				                            {         
				                                for (var i = 0; i < data.length; i++) {
				                                    create += '<option value="'+data[i].nis+'">'+data[i].nama+'</option>';
				                                }
				                                create += '</select>';
				                                create += '<label for="siswa">Pilih Siswa</label>';
				                                $('#pilihan_siswa').html(create);

				                                $('.mdb-select2').material_select();
				                            },
				                            error: function (jqXHR, textStatus, errorThrown)
				                            {
				                                alert('Gagal ambil data siswa dengan ajax');
				                            }
				                        });
				                    }
				            </script>
				<div class="md-form">
					<div class="text-xs-center">
		                <a onclick="kirim()" class="btn btn-success"><i class="fa fa-th"></i> Pilih</a>
		                <hr>
            		</div>
			            <script type="text/javascript">
			                function kirim() {
			                    alert('coba kirim');
			                }
			            </script>
				</div>
			</div>
		</div>