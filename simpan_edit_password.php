<?php
require("koneksi.php");	
$password1=$_POST['password1'];
$password2=$_POST['password2'];
$password3=$_POST['password3'];
$username=$_POST['username'];

if ( $password1 == $password2){
$userquery = "
select * from user where username='$username'";
$userresult = mysql_query($userquery) or die ('error, query failed.'.mysql_error());
while ($userrow=mysql_fetch_array($userresult)) {  
$username=$userrow['username'];
$password=$userrow['password'];
}

if ($password == $password3){
	mysql_query("update user set password='$password2' where username='$username'") or die(mysql_error());	
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Proses update kata sandi berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
} else {
	echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, kata sandi administrator yang anda masukkan salah, silakan ulangi proses!');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=edit_password.php'>";
}

} else {
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, kombinasi kata sandi baru yang anda masukkan salah, silakan ulangi proses!');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=edit_password.php'>";
}
?>