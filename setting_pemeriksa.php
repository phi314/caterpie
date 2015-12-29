<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php"
?>
<ul class="nav nav-pills">
  <li role="presentation" ><a href="index.php"><font face='calibri'><big>USER</big></font></a></li>
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big><big>ATASAN</big></big></big></big></font></a></li>
  <li role="presentation" ><a href="setting_komite.php"><font face='calibri'><big>KOMITE</big></font></a></li>
  <li role="presentation" ><a href="kelola_jabatan.php"><font face='calibri'><big>JABATAN</big></font></a></li>
  <li role="presentation"  ><a href="kelola_cg.php"><font face='calibri'><big>CIRCLE GROUP</big></font></a></li>
  <li role="presentation" ><a href="kelola_sub_dep.php"><font face='calibri'><big>SUB DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_dep.php"><font face='calibri'><big>DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_level.php"><font face='calibri'><big>HAK AKSES</big></font></a></li>
</ul>
<center><font face='calibri'><b>Tambah Atasan</b></font></center><br/>
<form action='cek_setting_pemeriksa.php' method='POST' enctype='multipart/form-data'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>Atasan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select name="pemeriksa">
			<option value='kosong'> </option>
                <?php
                    $query = "SELECT * FROM user where id_level=1";
                    $result = mysql_query($query);
                    while($row=mysql_fetch_array($result))
                    {
					
                        echo"<option value='$row[username]'>$row[fullname]</option>";
                    }
                ?>
            </select></td>
	</tr>
	
	<tr><td></td><td><br/></td></tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan Konfigurasi' class='btn btn-primary btn-small'></td>
	</tr>
</table>
</form>
<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr class='warning'>
			<td><center><small><font face='calibri'><b>NIK</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nama</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Circle Group</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Departmen</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Menu</b></font></small></center></td>
		</tr>
	<?php
	$query2 = "SELECT * FROM pemeriksa
	JOIN user on (user.username=pemeriksa.username)
	JOIN level on (user.id_level=level.id_level)
	JOIN jabatan on (jabatan.id_jabatan=user.id_jabatan)
	JOIN circle_group on (circle_group.id_cg=user.id_cg)
	JOIN sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
	JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
	order by pemeriksa.id desc";
	$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
	
	while ($row2=mysql_fetch_array($result2)) {
	$pemeriksa=$row2['username'];
	echo"
	<tr class='info'>
		<td><font face='calibri'>$row2[username]</font></td>
		<td><font face='calibri'>$row2[fullname] ($row2[inisial])</font></td>
		<td><font face='calibri'>$row2[nama_cg]</font></td>
		<td><font face='calibri'>$row2[nama_sub_dep] / $row2[nama_dep]</font></td>
		<td><center><small><font face='calibri'>
		<a href='hapus_pemeriksa.php?username=$pemeriksa'><span class='badge badge-important'><b>Hapus Data</b></span></a></font></small></center></td>
		
	</tr>
	";
	} 
	
	if ($pemeriksa==NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data atasan yang ditampilkan</font></center></td></tr>";
} else { echo""; }
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