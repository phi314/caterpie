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
<ul class="nav nav-pills">
  <li role="presentation" ><a href="index.php"><font face='calibri'><big>USER</big></font></a></li>
  <li role="presentation" ><a href="setting_pemeriksa.php"><font face='calibri'><big>ATASAN</big></font></a></li>
  <li role="presentation" ><a href="setting_komite.php"><font face='calibri'><big>KOMITE</big></font></a></li>
  <li role="presentation" ><a href="kelola_jabatan.php"><font face='calibri'><big>JABATAN</big></font></a></li>
  <li role="presentation" ><a href="kelola_cg.php"><font face='calibri'><big>CIRCLE GROUP</big></font></a></li>
  <li role="presentation" ><a href="kelola_sub_dep.php"><font face='calibri'><big>SUB DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_dep.php"><font face='calibri'><big>DEPARTMEN</big></font></a></li>
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big><big>HAK AKSES</big></big></big></big></font></a></li>
</ul>
<center><font face='calibri'><b>Tambah Data Hak Akses</b></font></center><br/>

<form method='POST' action='cek_input_level.php'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>Nama Hak Akses</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='level'></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan Data' class='btn btn-primary btn-small'> <input type='reset' value='Ulangi' class='btn btn-danger btn-small'></td>
	</tr>
</table>
</form>

<hr/>
<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr class='warning'>
			<td><center><small><font face='calibri'><b>ID Hak Akses</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nama Hak Akses</b></font></small></center></td>
			<td colspan="2"><small><center><font face='calibri'><b>Menu</b></font></center></small></td>
		</tr>
	<?php
	$query = "SELECT * FROM level order by id_level asc";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());

	while ($row=mysql_fetch_array($result)) {
	$nama_level=$row['nama_level'];
	echo"
	<tr class='info'>
		<td><font face='calibri'>$row[id_level]</font></td>
		<td><font face='calibri'>$row[nama_level]</font></td>
		<td><center><font face='calibri'><a href='edit_level.php?id_level=$row[id_level]'><span class='badge badge-info'>Ubah</span></a></font></center></td>
	</tr>
	";
	} 
	if ($nama_level == NULL) {
		echo"<tr class='info'><td colspan='11'><center><font face='calibri'>Tidak ada data level yang ditampilkan</font></center></td></tr>";
	} else {
		echo"";
	}
	?>
	</tbody>
</table>
</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>