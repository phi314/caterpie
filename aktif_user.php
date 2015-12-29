<?php
include"koneksi.php";
$username=$_GET['username'];
mysql_query("update user set status=1 where username='$username'")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, status user $username berhasil diaktifkan');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>