<?php
include"koneksi.php";
$komite=$_GET['username'];
mysql_query("delete from komite where username='$komite'")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, $komite berhasil dihapus sebagai komite');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=setting_komite.php'>";

?>