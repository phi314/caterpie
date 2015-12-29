<?php
require("koneksi.php");
$nama_sub_dep=$_POST['nama_sub_dep'];
$id_dep=$_POST['id_dep'];

if ($nama_sub_dep == NULL or $id_dep == 'kosong') {	
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Kolom nama Sub Departmen belum diisi, silakan ulangi proses !');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} else {
	$query = "select * from sub_dep";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	if ($nama_sub_dep == $data['nama_sub_dep']) {
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, Nama Sub Departmen sudah ada di database, silakan ulangi proses !');";
		echo "</script>";
		echo "<script>javascript:history.back()</script>";
	} else {
		mysql_query("insert into sub_dep(nama_sub_dep, id_dep) values ('$nama_sub_dep','$id_dep')") 
		or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses input Sub Departmen berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_sub_dep.php'>";
	}
}
?>