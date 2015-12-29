<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
?>
<center><font face='calibri'><b>Ubah Data Kata Sandi</b></font></center><br/>
<?php
error_reporting(0);
include"koneksi.php";
$username=$_SESSION['username'];
$query1 = "select * from user where username='$username'";
$result1 = mysql_query($query1) or die ('error, query failed.'.mysql_error());
while ($row1=mysql_fetch_array($result1)) {  
$password=$row1['password'];
}
echo"<form method='post' action='simpan_edit_password.php'>

<table align='center'>
	<tr>
		<td><font face='calibri'><b>Masukkan Kata Sandi Baru</b></font>&nbsp;&nbsp;</td>
		<td><input type='password' name='password1'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Ulangi Kata Sandi Baru</b></font>&nbsp;&nbsp;</td>
		<td><input type='password' name='password2'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Konfirmasi Kata Sandi Lama</b></font>&nbsp;&nbsp;</td>
		<td><input type='password' name='password3'></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='hidden' value='$username' name='username'></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan Perubahan' class='btn btn-primary btn-small'>
	</tr>
</table>
</form>
";
?>

</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>