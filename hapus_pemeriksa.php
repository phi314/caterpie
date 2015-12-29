<?php
include"koneksi.php";
$pemeriksa=$_GET['username'];
mysql_query("delete from pemeriksa where username='$pemeriksa'")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, $pemeriksa berhasil dihapus sebagai atasan');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=setting_pemeriksa.php'>";

?>