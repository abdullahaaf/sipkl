<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div id="welcome">
			<center><h1>SELAMAT DATANG</h1></center>
		</div>
		<br>
		<div id="welcome2">
			<center><h1>DI</h1></center>
		</div>
		<br>
		<div id="welcome3">
			<center><h1>SISTEM INFORMASI PENDAFTARAN PKLI</h1></center>
		</div>
		<br>
		<br>
		<br>
		<div id="welcome4">
			<center><h5>untuk melakukan pendaftaran pkli, silahkan klik tombol dibawah !</h5></center>
		</div>
		<div id="button1">
			<center>
			<button class="btn btn-primary" onclick="window.location.replace('<?php echo site_url('Cregister')?>');">Mulai Pendaftaran !</button>
			</center>
		</div>
		<script type="text/javascript">
			$('#welcome').addClass('animated bounceInRight');
			$('#welcome2').addClass('animated bounceInRight');
			$('#welcome3').addClass('animated bounceInRight');
			$('#welcome4').addClass('animated bounceInLeft');
			$('#button1').addClass('animated bounceInLeft');
		</script>
	</body>
</html>