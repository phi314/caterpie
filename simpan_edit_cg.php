<?php
require("koneksi.php");	
$id_cg=$_POST['id_cg'];
$nama_cg=$_POST['nama_cg'];
$id_sub_dep=$_POST['id_sub_dep'];
mysql_query("update circle_group set nama_cg='$nama_cg',id_sub_dep='$id_sub_dep' WHERE id_cg='$id_cg';")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses edit data circle group berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_cg.php'>";

?>