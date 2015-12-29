<?php
require("koneksi.php");	
$id_dep=$_POST['id_dep'];
$nama_dep=$_POST['nama_dep'];
mysql_query("update departmen set nama_dep='$nama_dep' WHERE id_dep='$id_dep';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses update data departmen berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_dep.php'>";

?>