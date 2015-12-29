<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$foto_profil=$_SESSION['foto'];

?>
<ul class="nav nav-pills">
  <li role="presentation" ><a href='index.php'><font face='calibri'><big>KEMBALI</big></font></a></li>
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>UBAH FOTO PROFIL</big></big></big></font></a></li>
</ul>
<center></center>
<?php
echo"<center><img src='foto/$foto_profil' width='250px'></center>";
?>
<hr/>
<form action='update_foto.php' method='POST' enctype='multipart/form-data'>
<table border='0' align='center'>

<tr>
<td></td>
<td><input type='file' name='foto'></td>
</tr>
<tr>
<td><font face='calibri'><b>Konfirmasi Kata Sandi&nbsp;&nbsp;</b></font></td>
<td><input type='password' name='password'></td>
</tr>
<tr>
<td></td>
<td><br/><input type='submit' class='btn btn-primary' value='Simpan Perubahan'></td>
</tr>
</table>

</form>
</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>