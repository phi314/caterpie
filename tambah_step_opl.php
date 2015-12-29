<!DOCTYPE html>
<html lang="en">
<head>
<script language="JavaScript" type="text/JavaScript">
	function hps(x)
	{
		 z = x ;
		document.getElementById("tes"+z).innerHTML = "";
	}
</script>
<script language="JavaScript" type="text/JavaScript">
	counter = 0;
	function tambah()
	{
		counterNext = counter + 1;
		counterId = counter + 1;
		document.getElementById("input"+counter).innerHTML = 
		"<div id=\"tes"+counterNext+"\"><table align='center'><tr><td></td><td align='right'><input type='button' onClick='hps(0)' value='x' class='btn btn-danger btn-small'></td></tr><tr><td><font face='calibri'><b>Gambar</b></font>&nbsp;&nbsp;&nbsp;</td><td><input type='file' name='foto_opl[]'></td></tr><tr><td><font face='calibri'><b>Keterangan</b></font>&nbsp;&nbsp;&nbsp;</td><td><textarea name='keterangan[]'></textarea></td></tr></table></div><div id=\"input"+counterNext+"\"></div>";
		counter++;
	}
</script>
</head>
<div class="container">

<?php
$no_opl_temp = $_GET['no_opl_temp'];
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";

$query1 = "SELECT * FROM opl where no_opl_temp='$no_opl_temp'";
$result1 = mysql_query($query1) or die ('error, query failed.'.mysql_error());
while ($row1=mysql_fetch_array($result1)) {
	$tema_opl=$row1['tema_opl'];
}

echo"<a href='detail_opl_koreksi.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a>";
?>
<form action='cek_input_step_opl.php' method='POST' enctype='multipart/form-data'>
	<div id="tes0">
	<table  align='center'>
	<tr>
		<td></td>
		<td align='right'><input type='button' onClick='hps(0)' value='x' class='btn btn-danger btn-small'></td>
	</tr>
	<tr>
		<td></td>
		<td align='right'><input type='hidden' name='no_opl_temp' value='<?php echo"$no_opl_temp"; ?>'></td>
	</tr>
	<tr>
		<td></td>
		<td align='right'><input type='hidden' name='tema_opl' value='<?php echo"$tema_opl"; ?>'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Gambar</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='file' name='foto_opl[]'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Keterangan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><textarea name='keterangan[]'></textarea></td>
	</tr>
	</table>
	</div>
	<div id="input0">
</div>

	<center><input onClick="tambah()" value="+ Tambah Step" class='btn btn-success btn-small' type="button" ><br/><br/><br/>
	<input type='submit' value='Simpan Perubahan' class='btn btn-primary btn-small'> <a href='opl_baru.php'><input type='reset' value='Ulangi' class='btn btn-danger btn-small'></a></center>
</form>

</div>

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>