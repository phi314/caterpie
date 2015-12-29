<?php
require("koneksi.php");	
$reject_opl_komite=mysql_escape_string($_POST['reject_opl_komite']);
$no_opl_temp=$_POST['no_opl_temp'];
date_default_timezone_set('Asia/Jakarta');
	$tgl_reject_pemeriksa = date('Y-m-d H:i:s');
mysql_query("update opl set status=8, tgl_reject='$tgl_reject_pemeriksa', alasan_reject_komite='$reject_opl_komite'
 WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
mysql_query("delete from akses_opl WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses reject OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>