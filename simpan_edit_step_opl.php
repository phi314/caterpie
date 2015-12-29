<?php
error_reporting(0);
include"koneksi.php";
session_start();
$no_step = $_POST['no_step'];
$no_opl_temp = $_POST['no_opl_temp'];
$keterangan = mysql_escape_string($_POST['keterangan']);

$file_name = $_FILES['foto']['name'];
$size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$source = $_FILES['foto']['tmp_name'];
$direktori = "foto_opl/$file_name";

$queryY = "SELECT * FROM detail_opl WHERE no_opl_temp='$no_opl_temp' and no_step=$no_step";
		$resultY = mysql_query($queryY) or die ('error, query failed.'.mysql_error());
		while ($rowY=mysql_fetch_array($resultY)) {
			$gambar2=$rowY['gambar'];
		}
		
move_uploaded_file($source,$direktori);	
	rename($direktori, "foto_opl/".$gambar2."");
	$direktori=$gambar2."";
	

mysql_query("update detail_opl set gambar='$direktori',keterangan='$keterangan' WHERE no_opl_temp='$no_opl_temp' and no_step=$no_step;")
		or die(mysql_error());
		
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Sukses, Proses update detail opl berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=detail_opl_koreksi.php?no_opl_temp=$no_opl_temp'>";



?>