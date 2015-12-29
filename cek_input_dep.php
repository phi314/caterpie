<?php
error_reporting(0);
require("koneksi.php");
$dep=$_POST['nama_dep'];
$query2 = "SELECT * FROM departmen where nama_dep='$dep'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
	$dep2=$row2['nama_dep'];
}
if ($dep == NULL) {	
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Kolom nama departmend belum diisi, silakan ulangi proses !');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}else if ($dep2 != NULL){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Data Departmen yang anda pilih sudah tersedia di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} 
else {
	$query = "select * from departmen";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	if ($dep == $data['nama_dep']) {
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, Nama departmen sudah ada di database, silakan ulangi proses !');";
		echo "</script>";
		echo "<script>javascript:history.back()</script>";
	} else {
		mysql_query("insert into departmen(nama_dep) values ('$dep')") 
		or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses input departmen berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_dep.php'>";
	}
}
?>