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
		"<div id=\"tes"+counterNext+"\"><table align='center'><tr><td></td><td align='right'><input type='button' onClick='hps(0)' value='x' class='btn btn-danger btn-small'></td></tr><tr><td><font face='calibri'><b>Gambar</b></font>&nbsp;&nbsp;&nbsp;</td><td><input type='file' name='foto_opl[]' required></td></tr><tr><td><font face='calibri'><b>Keterangan</b></font>&nbsp;&nbsp;&nbsp;</td><td><textarea name='keterangan[] required'></textarea></td></tr></table></div><div id=\"input"+counterNext+"\"></div>";
		counter++;
	}
</script>
</head>
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php"
?>
<form action='cek_input_opl.php' method='POST' enctype='multipart/form-data'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>Tema OPL</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='judul' required></td>
	</tr>
	
	<tr>
		<td><font face='calibri'><b>Jenis OPL</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><select name='jenis_opl' required>
		<option value=''>
		<option value='1'>Pengetahuan Dasar
		<option value='2'>Troubleshooting
		<!--<option value='3'>Improvement-->
		</select></td>
	</tr>
	</table>
	<div id="tes0">
	<table  align='center'>
	<tr>
		<td></td>
		<td align='right'><input type='button' onClick='hps(0)' value='x' class='btn btn-danger btn-small'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Gambar</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='file' name='foto_opl[]' required></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Keterangan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><textarea name='keterangan[]' required></textarea></td>
	</tr>
	</table>
	</div>
	<div id="input0">
</div>

	<center><input onClick="tambah()" value="+ Tambah Step" class='btn btn-success btn-small' type="button" ><br/><br/><br/>
	<input type='submit' value='Simpan Data' class='btn btn-primary btn-small'> <a href='opl_baru.php'><input type='reset' value='Ulangi' class='btn btn-danger btn-small'></a></center>
</form>

</div>

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>