<?php
// why
require("koneksi.php");
session_start();	
$nilai=$_POST['nilai'];
$no_opl_temp=$_POST['no_opl_temp'];
$username=$_SESSION['username'];
date_default_timezone_set('Asia/Jakarta');
	$tgl_penilaian = date('Y-m-d H:i:s');
	if ($nilai == 'kosong'){
		echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Kolom nilai belum diisi, silakan ulangi proses !');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
	} else {
mysql_query("update akses_opl set nilai='$nilai',tgl_penilaian='$tgl_penilaian' WHERE no_opl_temp='$no_opl_temp' and username='$username';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses penilaian sharing OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";
	}
?>
