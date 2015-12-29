<?php
	include"koneksi.php";
	error_reporting(0);
	$no_step = $_GET['no_step'];
	$no_opl_temp = $_GET['no_opl_temp'];

	$query = "select * from detail_opl where no_opl_temp='$no_opl_temp' and no_step=$no_step";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
	$row=mysql_fetch_array($result);//untuk menghapus foto di dalam folder
	$folder="foto_opl/$row[gambar]";
	unlink($folder);

	mysql_query("delete from detail_opl where no_step='$no_step'")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses hapus detail opl berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=detail_opl_koreksi.php?no_opl_temp=$no_opl_temp'>";
	
?>