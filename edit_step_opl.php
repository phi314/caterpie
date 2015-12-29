<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$no_opl_temp=$_GET['no_opl_temp'];
$no_step=$_GET['no_step'];

error_reporting(0);
echo"<a href='detail_opl_koreksi.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a>";
include"koneksi.php";
$query = "select * from detail_opl where no_opl_temp='$no_opl_temp' and no_step='$no_step'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
while ($row=mysql_fetch_array($result)) {  
echo"<table align='center'>
<tr>
	<td colspan='2'>Step ke <b>$row[no_step]</b></td>
</tr>
<tr>
	<td colspan='2'><img src='foto_opl/$row[gambar]' width='150px'></td>
</tr>
<tr>
	<td><font face='calibri'>Keterangan&nbsp;&nbsp;:&nbsp;&nbsp;</font></td>
	<td><font face='calibri'><b>$row[keterangan]</b></font></td>
</tr>
</table><br/>";
}
echo"<form method='post' action='simpan_edit_step_opl.php'  enctype='multipart/form-data'>

<table align='center'>
<tr>
		<td colspan='3'><input type='hidden' name='no_step' value='$no_step'></td>
	</tr>
<tr>
		<td colspan='3'><input type='hidden' name='no_opl_temp' value='$no_opl_temp'></td>
	</tr>
	<tr>
		<td><font face='calibri'>Gambar</font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type='file' name='foto'></td>
	</tr>
	<tr>
		<td><font face='calibri'>Keterangan</font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><textarea name='keterangan'></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan Perubahan' class='btn btn-primary btn-small'> 
		
	</tr>
	
</table>";

echo"</form>
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