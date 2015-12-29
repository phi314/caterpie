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
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big><big>CIRCLE GROUP</big></big></big></big></font></a></li>
  <li role="presentation" ><a href="kelola_sub_dep.php"><font face='calibri'><big>SUB DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_dep.php"><font face='calibri'><big>DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_level.php"><font face='calibri'><big>HAK AKSES</big></font></a></li>
</ul>

<center><font face='calibri'><b>Ubah Data Circle Group</b></font></center><br/>
<?php
error_reporting(0);
include"koneksi.php";
$id_cg=$_GET['id_cg'];
$id_sub_dep=$_GET['id_sub_dep'];
$query = "SELECT * FROM circle_group JOIN sub_dep ON (sub_dep.id_sub_dep = circle_group.id_sub_dep) WHERE id_cg='$id_cg'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
while ($row=mysql_fetch_array($result)) {  
$nama_cg=$row['nama_cg'];
$nama_sub_dep=$row['nama_sub_dep'];
}
echo"<form method='post' action='simpan_edit_cg.php'>

<table align='center'>
	<tr>
		<td><font face='calibri'><b>Nama Circle Group</b></font></td>
		<td><input type='text' name='nama_cg' value='$nama_cg'></td>
	</tr>
	
		<tr>
		<td><font face='calibri'><b>Nama Sub Department</b></font>&nbsp;&nbsp;</td>
		<td>
			<select  name='id_sub_dep'>
			";
                    $query1 = 'SELECT id_sub_dep, nama_sub_dep FROM sub_dep';
                    $result1 = mysql_query($query1);
                    while($row=mysql_fetch_array($result1))
                    {

                        echo "<option value='$row[id_sub_dep]'>$row[nama_sub_dep]</option>";
                    }
            echo"
            </select>
		</td>
		</tr>
		
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan Perubahan' class='btn btn-primary btn-small'>
	</tr>
	<tr>
		<td colspan='3'><input type='hidden' name='id_cg' value='$id_cg'></td>
	</tr>
</table>
<input type='hidden' name='id_cg' value='$id_cg'>
</form>
";
?>
<hr/>
<a href='tambah_data_cg.php'><input type='submit' class='btn btn-info btn-small' value='+ Tambah Data'></a><br/><br/>
<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr class='warning'>
			<td><center><small><font face='calibri'><b>ID Circle Group</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nama Circle Group</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nama Sub Departmen</b></font></small></center></td>
			<td colspan="2"><small><center><font face='calibri'><b>Menu</b></font></center></small></td>
		</tr>
	<?php
	$query = "SELECT * FROM circle_group JOIN sub_dep ON (circle_group.id_sub_dep = sub_dep.id_sub_dep) order by id_cg asc";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
	?>
	<tbody>
	<?php
	while ($row=mysql_fetch_array($result)) {
	$nama_cg=$row['nama_cg'];
	echo"
	<tr class='info'>
		<td><font face='calibri'>$row[id_cg]</font></td>
		<td><font face='calibri'>$row[nama_cg]</font></td>
		<td><font face='calibri'>$row[nama_sub_dep]</font></td>
		<td><center><font face='calibri'><a href='edit_cg.php?id_cg=$row[id_cg]'><span class='badge badge-info'>Ubah</span></a></font></center></td>	
		</tr>
	";
	} 
	if ($nama_cg == NULL) {
		echo"<tr class='info'><td colspan='11'><center><font face='calibri'>Tidak ada data CG yang ditampilkan</font></center></td></tr>";
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