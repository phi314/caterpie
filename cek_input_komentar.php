<?php
include"koneksi.php";
error_reporting(0);
session_start();
$username=$_SESSION['username'];
$isi_komentar=$_POST['komentar'];
$id_problem=$_GET['id_problem'];
date_default_timezone_set('Asia/Jakarta');
$tgl_komentar = date('Y-m-d H:i:s');

	mysql_query("insert into komentar(tgl_komentar,isi_komentar,id_problem,username) values 
	('$tgl_komentar','$isi_komentar','$id_problem',$username)") or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Komentar anda telah disimpan');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=forum_opl.php'>";

?>
