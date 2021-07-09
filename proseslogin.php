<?php 
session_start();
require_once("connect.php");
$email = $_POST['email'];
$pass = $_POST['pass'];
$cekuser = mysql_query("SELECT * FROM user WHERE email = 'email'");
$jumlah = mysql_num_rows($cekuser);
$hasil = mysql_fetch_array($cekuser);
if ($jumlah == 0) {
	echo "Email belum Terdaftar";
	echo '<a href="login.php">Back</a>';
}else{
	if($pass <> $hasil['password']){
		echo "password salah";
		echo '<a href="login.php">Back</a>';
	}else{
		$_SESSION['email'] = $hasil['email'];
		header('location: index.php');
	}
}



 ?>

