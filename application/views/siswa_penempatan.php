<div class="card">
	<div class="card-block">
		<div class="row">
			<div class="form-header">
				<h3><center>Tambah Data Penempatan Siswa</center></h3>
			</div>
		</div>
		<br>
		<div class="row">
			<form action="#">
				<div class="col-md-3">
					<div class="md-form">
						<input type="text" name="noinduk" id="forminduk" class="form-control">
						<label for="forminduk">No Induk</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="md-form">						
						<span id="nama_siswa">Nama Siswa</span>
					</div>
				</div>
				<div class="col-md-3">
					<div class="md-form">
						<select id="kelassiswa" name="kelassiswa" class="mdb-select colorful-select dropdown-warning">
							<option value="-- pilih kelas siswa">-- pilih kelas siswa --</option>
							<option value="1A">1A</option>
							<option value="1B">1B</option>
							<option value="2A">2A</option>
							<option value="2B">2B</option>
							<option value="3A">3A</option>
							<option value="3B">3B</option>
							<option value="4A">4A</option>
							<option value="4B">4B</option>
							<option value="5A">5A</option>
							<option value="5B">5B</option>
							<option value="6A">6A</option>
							<option value="6B">6B</option>
						</select>
					</div>
				</div>
				<!-- javascript untuk combobox -->
				<script type="text/javascript">
					$(document).ready(function() {
								$('.mdb-select').material_select();
							});
					$('.datepicker').pickadate();
				</script>
				<div class="col-md-3">
                    <div class="text-xs-center">
                        <a onclick="kirim()" class="btn btn-success"><i class="fa fa-plus left"></i> Tambah</a>
                    </div>
                    <script type="text/javascript">
                        function kirim() {
                            alert('coba kirim');
                        }
                    </script>
                </div>
			</form>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-block">
		<br>
          <div class="form-header">
            <center>
                <h3>Data Penempatan Siswa</h3>
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
		                            <th>No Induk</th>
		                            <th>Nama Siswa</th>
		                            <th>Kelas</th>
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