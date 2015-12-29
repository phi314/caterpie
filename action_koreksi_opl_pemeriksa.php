<?php
require("koneksi.php");	
$koreksi_opl_pemeriksa=mysql_escape_string($_POST['koreksi_opl_pemeriksa']);
$no_opl_temp=$_POST['no_opl_temp'];
date_default_timezone_set('Asia/Jakarta');
	$tgl_koreksi_pemeriksa = date('Y-m-d H:i:s');
mysql_query("update opl set status=2, tgl_koreksi_pemeriksa='$tgl_koreksi_pemeriksa', alasan_koreksi_pemeriksa='$koreksi_opl_pemeriksa'
 WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses koreksi OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>