<?php
error_reporting(0);
require("koneksi.php");
$komite=$_POST['komite'];
$query2 = "SELECT * FROM komite where username='$komite'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
	$komite2=$row2['username'];
}
if ($komite == 'kosong') {
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Anda belum memilih data komite, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}
else if ($komite2 != NULL){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Data komite yang anda pilih sudah tersedia di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} else {
	 	mysql_query("insert into komite(username) values 
	('$komite')") or die(mysql_error());	
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, $komite berhasil ditambahkan sebagai komite');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=setting_komite.php'>";
}
?>