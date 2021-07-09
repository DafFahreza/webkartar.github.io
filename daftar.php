<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
	<link rel="stylesheet" type="text/css" href="style1.css">

</head>
<body>
	<div class="container">
		<h1>LogIn</h1>
		<form action="" method="POST">
			<label>Username</label><br>
			<input type="text" name="username"><br>
			<label>Nama</label><br>
			<input type="text" name="nama">
			<label>E-mail</label><br>
			<input type="text" name="email">
			<label>Password</label><br>
			<input type="Password" name="password"><br>
			<input type="submit" name="daftar" value="Daftar" ><br>
		</form>

		<?php
			if(isset($_POST['daftar'])){
					$username = $_POST['username'];
					$nama = $_POST['nama'];
					$email = $_POST['email'];
					$password = $_POST['password'];
				include 'koneksi.php';
				$insert = "INSERT INTO db_user VALUES ('$username','$nama','$email','$password')";
				if ($insert) {
					echo 'berhasil';
				}else{
					echo 'gagal';
				}
			}

		 ?>
		
	</div>

</body>
</html>