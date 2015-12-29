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
<center><font face='calibri'><b>Tambah Data Circle Group</b></font></center><br/>
<form method='POST' action='cek_input_cg.php'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>Nama Circle Group</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='nama_cg'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Nama Sub Department</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select class="form-control" name="nama_sub_dep">
			<option value='kosong'> </option>
                <?php
                    $query1 = "SELECT id_sub_dep, nama_sub_dep FROM sub_dep";
                    $result1 = mysql_query($query1);
                    while($row=mysql_fetch_array($result1))
                    {

                        echo "<option value='$row[id_sub_dep]'>$row[nama_sub_dep]</option>";
                    }
                ?>
            </select></td>
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
		echo"<tr class='info'><td colspan='11'><center><font face='calibri'>Tidak ada data circle group yang ditampilkan</font></center></td></tr>";
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