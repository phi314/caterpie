<?php
require("koneksi.php");	
$id_level=$_POST['id_level'];
$nama_level=$_POST['nama_level'];
mysql_query("update level set nama_level='$nama_level' WHERE id_level='$id_level';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses update data hak akses sukses');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_level.php'>";

?>