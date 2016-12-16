<head>
			<center><h3>Form Pendaftaran Kelompok PKLI</h3></center>
			<h5><center>Lakukan pengisian form dibawah ini untuk melakukan pendaftaran PKLI </center></h5>


</head>
<br>
<div class="card">
	<div class="card-block">
		<div class="container">
			<h3><center>FORM DATA KELOMPOK</center></h3>
			<br>
			<div class="row">
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user prefix"></i>
						<input type="text" id="anggota1" class="form-control">
						<label for="anggota1">Nama Anggota</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user-md prefix"></i>
						<input type="text" id="nim1" class="form-control">
						<label for="jurusan">Nim</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-mobile-phone prefix"></i>
						<input type="text" id="telpon1" class="form-control">
						<label for="jurusan">Nomor Telepon</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user prefix"></i>
						<input type="text" id="anggota2" class="form-control">
						<label for="anggota1">Nama Anggota</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user-md prefix"></i>
						<input type="text" id="nim2" class="form-control">
						<label for="jurusan">Nim</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-mobile-phone prefix"></i>
						<input type="text" id="telpon2" class="form-control">
						<label for="jurusan">Nomor Telepon</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user prefix"></i>
						<input type="text" id="anggota3" class="form-control">
						<label for="anggota1">Nama Anggota</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user-md prefix"></i>
						<input type="text" id="nim3" class="form-control">
						<label for="jurusan">Nim</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-mobile-phone prefix"></i>
						<input type="text" id="telpon3" class="form-control">
						<label for="jurusan">Nomor Telepon</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user prefix"></i>
						<input type="text" id="anggota4" class="form-control">
						<label for="anggota1">Nama Anggota</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user-md prefix"></i>
						<input type="text" id="nim4" class="form-control">
						<label for="jurusan">Nim</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-mobile-phone prefix"></i>
						<input type="text" id="telpon4" class="form-control">
						<label for="jurusan">Nomor Telepon</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user prefix"></i>
						<input type="text" id="anggota5" class="form-control">
						<label for="anggota1">Nama Anggota</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-user-md prefix"></i>
						<input type="text" id="nim5" class="form-control">
						<label for="jurusan">Nim</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="md-form">
						<i class="fa fa-mobile-phone prefix"></i>
						<input type="text" id="telpon5" class="form-control">
						<label for="jurusan">Nomor Telepon</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-block">
		<div class="container">
		<h3><center>FORM DATA TEMPAT dan WAKTU PKL</center></h3>
		<br>
			<div class="row">
				<div class="col-md-6">
					<div class="md-form">
						<i class="fa fa-building prefix"></i>
						<input type="text" id="tempatpkl">
						<label for="tempatpkl">Nama Instansi / Perusahaan</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form">
						<i class="fa fa-home prefix"></i>
						<input type="text" id="alamatpkl">
						<label for="tempatpkl">Alamat</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form">
						<i class="fa fa-calendar prefix"></i>
						<input type="text" name="tanggalmulai" id="tanggalmulai" class="form-control">
						<label for="tanggalmulai">Tanggal Mulai</label>
					</div>

					<!-- javascript buat datepicker -->

					<script type="text/javascript">

                        $(function(){
                          $('#tanggalmulai').datepicker({
                            format: 'yyyy/mm/dd',
                            autoclose: true,
                            todayHighlight: true
                          });
                        });
                      </script>

				</div>
				<div class="col-md-6">
					<div class="md-form">
						<i class="fa fa-calendar prefix"></i>
						<input type="text" name="tanggalselesai" id="tanggalselesai" class="form-control">
						<label for="tanggalselesai">Tanggal Selesai</label>
					</div>

					<!-- javascript buat datepicker -->

					<script type="text/javascript">

                        $(function(){
                          $('#tanggalselesai').datepicker({
                            format: 'yyyy/mm/dd',
                            autoclose: true,
                            todayHighlight: true
                          });
                        });
                      </script>

				</div>
			</div>
		</div>
	</div>
</div>