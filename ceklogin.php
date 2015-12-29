<?php 
session_start();
require("koneksi.php");
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user where username='$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

if ($password == $data['password']) {
	if ($data['Status'] == 1){
		$_SESSION['username']=$data['username'];
		$_SESSION['id_level']=$data['id_level'];
		$_SESSION['fullname']=$data['fullname'];
		$_SESSION['inisial']=$data['inisial'];
		$_SESSION['foto']=$data['foto'];
		header("location:index.php");
	} else {
		?><script type="text/javascript">alert("Error, status user tidak aktif, hubungi administrator!");</script><?php
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";
	}
} else {
	?><script type="text/javascript">alert("Error, NIK atau Kata Sandi yang anda masukkan salah. Silakan ulangi proses!");</script><?php 
	echo"<meta http-equiv='refresh' content='0;url=index.php'>";	
}
?>
