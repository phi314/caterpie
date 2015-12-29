<?php
require("koneksi.php");	
$koreksi_opl_komite=mysql_escape_string($_POST['koreksi_opl_komite']);
$no_opl_temp=$_POST['no_opl_temp'];
date_default_timezone_set('Asia/Jakarta');
	$tgl_koreksi_komite = date('Y-m-d H:i:s');
mysql_query("update opl set status=4, tgl_koreksi_komite='$tgl_koreksi_komite', alasan_koreksi_komite='$koreksi_opl_komite'
 WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses koreksi OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>