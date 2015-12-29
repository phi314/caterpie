<?php
error_reporting(0);
require("koneksi.php");
$user=$_POST['user'];
$pemeriksa=$_POST['pemeriksa'];
$komite=$_POST['komite'];
$id=$_POST['id'];

	 	mysql_query("update agreement_opl set pemeriksa='$pemeriksa',komite='$komite' where id_agreement='$id' ") or die(mysql_error());	
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Setting agreement user $user tersimpan');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=index.php'>";

?>