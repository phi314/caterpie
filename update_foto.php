<?php
session_start();
error_reporting(0);
include"koneksi.php";
$username=$_SESSION['username'];
$file_name = $_FILES['foto']['name'];
$size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$source = $_FILES['foto']['tmp_name'];
$direktori = "foto/$file_name";
$pass=$_POST['password'];

$query = "SELECT * FROM user where username='$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
if ($pass == $data['password']) {
move_uploaded_file($source,$direktori);	
	rename($direktori, "foto/".$username.".jpg");
	$direktori=$username.".jpg";
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Sukses, Proses update foto berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
} else {
	?><script type="text/javascript">alert("Error, Kata Sandi yang anda masukkan salah. Silakan ulangi proses!");</script><?php 
	echo"<meta http-equiv='refresh' content='0;url=ganti_foto.php'>";
}

?>