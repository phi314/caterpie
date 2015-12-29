<?php
include"koneksi.php";
error_reporting(0);
session_start();
$username=$_SESSION['username'];
$user= $_POST['user'];
$no_opl_temp=$_POST['no_opl_temp'];
$t=0;
$f=1;
foreach ($user as $userdata){
	 mysql_query("insert into akses_opl(no_opl_temp,username) values 
				('$no_opl_temp','$userdata')") or die(mysql_error());
}

echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Setting konfigurasi hak akses opl disimpan');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=setting_akses.php?no_opl_temp=$no_opl_temp'>";
?>
