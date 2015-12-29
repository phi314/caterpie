<?php
require("koneksi.php");	
$koreksi_opl_koordinator=mysql_escape_string($_POST['koreksi_opl_koordinator']);
$no_opl_temp=$_POST['no_opl_temp'];
date_default_timezone_set('Asia/Jakarta');
	$tgl_koreksi_koordinator = date('Y-m-d H:i:s');
mysql_query("update opl set status=6, tgl_koreksi_koordinator='$tgl_koreksi_koordinator', alasan_koreksi_koordinator='$koreksi_opl_koordinator'
 WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses koreksi OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>