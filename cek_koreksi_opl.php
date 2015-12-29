<?php
require("koneksi.php");	
$no_opl_temp=$_POST['no_opl_temp'];
$judul=mysql_escape_string($_POST['judul']);
$jenis_opl=$_POST['jenis_opl'];
$status=$_POST['status'];
if ($status == 2) {
	$status_fix=1;
} else if ($status ==4) {
	$status_fix=3;
} else if ($status ==6) {
	$status_fix=5;
}

mysql_query("update opl set tema_opl='$judul',jenis_opl='$jenis_opl',status='$status_fix' where no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses koreksi OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=daftar_opl_koreksi.php'>";

?>