<?php
require("koneksi.php");
$level=$_POST['level'];

if ($level == NULL) {	
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Errror, Kolom nama hak akses belum diisi, silakan ulangi proses !');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} else {
	$query = "select * from level";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	if ($level == $data['nama_level']) {
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, Nama hak akses sudah ada di database, silakan ulangi proses !');";
		echo "</script>";
		echo "<script>javascript:history.back()</script>";
	} else {
		mysql_query("insert into level(nama_level) values ('$level')") 
		or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses tambah data hak akses berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=kelola_level.php'>";
	}
}
?>