<?php
require("koneksi.php");
$circle_group=$_POST['nama_cg'];
$id_sub_dep=$_POST['nama_sub_dep'];

if ($circle_group == NULL or $id_sub_dep =='kosong') {	
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Kolom nama circle group belum diisi, silakan ulangi proses !');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} else {
	$query = "select * from circle_group";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	if ($circle_group == $data['nama_cg']) {
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, Nama circle group sudah ada di database, silakan ulangi proses !');";
		echo "</script>";
		echo "<script>javascript:history.back()</script>";
	} else {
		mysql_query("insert into circle_group(nama_cg,id_sub_dep) values ('$circle_group','$id_sub_dep')") 
		or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses input circle group berhasil.');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_cg.php'>";
	}
}
?>