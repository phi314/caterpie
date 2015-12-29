<?php
error_reporting(0);
require("koneksi.php");
$jabatan=$_POST['nama_jabatan'];
$query2 = "SELECT * FROM jabatan where nama_jabatan='$jabatan'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
	$jabatan2=$row2['nama_jabatan'];
}
if ($jabatan == NULL) {	
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Kolom nama jabatan belum diisi, silakan ulangi proses !');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}else if ($jabatan2 != NULL){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Data Jabatan yang anda pilih sudah tersedia di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}	
else {
	$query = "select * from jabatan";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	if ($jabatan == $data['nama_jabatan']) {
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, Nama jabatan sudah ada di database, silakan ulangi proses !');";
		echo "</script>";
		echo "<script>javascript:history.back()</script>";
	} else {
		mysql_query("insert into jabatan(nama_jabatan) values ('$jabatan')") 
		or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, proses input jabatan berhasil.');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_jabatan.php'>";
	}
}
?>