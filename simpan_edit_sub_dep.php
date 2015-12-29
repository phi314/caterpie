<?php
require("koneksi.php");	
$id_sub_dep=$_POST['id_sub_dep'];
$id_dep=$_POST['id_dep'];
$nama_sub_dep=$_POST['nama_sub_dep'];
mysql_query("update sub_dep set nama_sub_dep='$nama_sub_dep',id_dep='$id_dep' WHERE id_sub_dep='$id_sub_dep';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses update data Sub Departmen berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_sub_dep.php'>";

?>