<?php
include"koneksi.php";
$no_opl_temp=$_GET['no_opl_temp'];
$username=$_GET['username'];
mysql_query("delete from akses_opl where username='$username' and no_opl_temp='$no_opl_temp'")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses hapus hak akses opl berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=setting_akses.php?no_opl_temp=$no_opl_temp'>";

?>