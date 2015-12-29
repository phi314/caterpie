<?php
error_reporting(0);
require("koneksi.php");
$user=$_POST['user'];
$pemeriksa=$_POST['pemeriksa'];
$komite=$_POST['komite'];

	 	mysql_query("insert into agreement_opl(user,pemeriksa,komite) values 
	('$user','$pemeriksa','$komite')") or die(mysql_error());	
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Setting agreement user $user tersimpan');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=setting_agreement.php'>";

?>