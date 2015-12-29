<?php
error_reporting(0);
require("koneksi.php");
$pemeriksa=$_POST['pemeriksa'];
$query2 = "SELECT * FROM pemeriksa where username='$pemeriksa'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
	$pemeriksa2=$row2['username'];
}
if ($pemeriksa == 'kosong') {
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Anda belum memilih data atasan, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}
else if ($pemeriksa2 != NULL){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Data atasan yang anda pilih sudah tersedia di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} else {
	 	mysql_query("insert into pemeriksa(username) values 
	('$pemeriksa')") or die(mysql_error());	
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, $pemeriksa berhasil ditambahkan sebagai atasan');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=setting_pemeriksa.php'>";
}
?>