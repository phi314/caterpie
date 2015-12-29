<?php
require("koneksi.php");	
$no_opl_temp=$_GET['no_opl_temp'];
date_default_timezone_set('Asia/Jakarta');
	$tgl_approve_komite = date('Y-m-d H:i:s');
mysql_query("update opl set status=5, tgl_approve_komite='$tgl_approve_komite' WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses approve OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>