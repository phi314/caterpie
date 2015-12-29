<?php
require("koneksi.php");	
$id_jabatan=$_POST['id_jabatan'];
$nama_jabatan=$_POST['nama_jabatan'];
mysql_query("update jabatan set nama_jabatan='$nama_jabatan' WHERE id_jabatan='$id_jabatan';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses update data jabatan berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_jabatan.php'>";

?>