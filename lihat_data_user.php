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
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big><big>USER </big></big></big></big></font></a></li>
  <li role="presentation" ><a href="setting_pemeriksa.php"><font face='calibri'><big>ATASAN</big></font></a></li>
  <li role="presentation" ><a href="setting_komite.php"><font face='calibri'><big>KOMITE</big></font></a></li>
  <li role="presentation" ><a href="kelola_jabatan.php"><font face='calibri'><big>JABATAN</big></font></a></li>
  <li role="presentation"  ><a href="kelola_cg.php"><font face='calibri'><big>CIRCLE GROUP</big></font></a></li>
  <li role="presentation" ><a href="kelola_sub_dep.php"><font face='calibri'><big>SUB DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_dep.php"><font face='calibri'><big>DEPARTMEN</big></font></a></li>
  <li role="presentation" ><a href="kelola_level.php"><font face='calibri'><big>HAK AKSES</big></font></a></li>
</ul>
<center><font face='calibri'><b>Detail Data User</b></font></center><br/>

<?php
include"koneksi.php";
$username=$_GET['username'];
$query = "SELECT * FROM user
	JOIN level on (user.id_level=level.id_level)
	JOIN jabatan on (jabatan.id_jabatan=user.id_jabatan)
	JOIN circle_group on (circle_group.id_cg=user.id_cg)
	JOIN sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
	JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
where user.username='$username'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());

			echo"<table align='center'>";
 
while ($row=mysql_fetch_array($result)) {
echo"
<tr>
	<td><font face='calibri'>NIK</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[username]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Nama / Inisial</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[fullname] / $row[inisial]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Email</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[email]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Telpon</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[ext]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Jabatan</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[nama_jabatan]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Departmen</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[nama_sub_dep]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Hak Akses</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'><b>$row[nama_level]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Status</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>";
	$status=$row['Status'];
	if ($status==1){
	echo"<td><font face='calibri'><b>Aktif</b></font></td>";
	} else {
	echo"<td><font face='calibri'><b>Non Aktif</b></font></td>";
	}
echo"</tr>";
$query2 = "SELECT * FROM agreement_opl
	join user on(user.username=agreement_opl.user)
where agreement_opl.user='$username'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
$atasan=$row2['pemeriksa'];
$komite=$row2['komite'];	
}
$query3 = "SELECT * FROM user
where username='$atasan'";
$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());
while ($row3=mysql_fetch_array($result3)) {
echo"<tr>
	<td><font face='calibri'>Atasan</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'>$row3[fullname]</font></td>
</tr>";
}

$query4 = "SELECT * FROM user
where username='$komite'";
$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());
while ($row4=mysql_fetch_array($result4)) {
echo"<tr>
	<td><font face='calibri'>Komite</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><font face='calibri'>$row4[fullname]</font></td>
</tr>";
}
echo"<tr>
	<td><font face='calibri'>Foto</font></td>
	<td><font face='calibri'>&nbsp;:&nbsp;</font></td>
	<td><img src='foto/$row[foto]' width='80px'></td>
</tr>";
$query9 = "SELECT * FROM agreement_opl where user='$username'";
$result9 = mysql_query($query9) or die ('error, query failed.'.mysql_error());
while ($row9=mysql_fetch_array($result9)) {
	$userrr=$row9['pemeriksa'];
}
	if($userrr == NULL)
	{echo"
	<tr>
		<td></td><td></td><td><a href='setting_agreement.php?username=$username'><input type='submit' class='btn btn-info btn-small' value='Setting Agreement'></a></td>
	</tr>";
		
	} else
	{
	echo"
		<tr>
			<td></td><td></td><td><a href='ubah_agreement.php?username=$username'><input type='submit' class='btn btn-info btn-small' value='Ubah Agreement'></a></td>
		</tr>";	
	}


}
?> 
			</table>
<hr/>
<a href='tambah_data_user.php'><input type='submit' class='btn btn-info btn-small' value='+ Tambah Data'></a><br/><br/>
<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr class='warning'>
			<td><center><small><font face='calibri'><b>NIK</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nama</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Hak Akses</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Circle Group</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Departmen</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Kata Sandi</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Menu</b></font></small></center></td>
		</tr>
	<?php
	$query2 = "SELECT * FROM user 
	JOIN level on (user.id_level=level.id_level)
	JOIN jabatan on (jabatan.id_jabatan=user.id_jabatan)
	JOIN circle_group on (circle_group.id_cg=user.id_cg)
	JOIN sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
	JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
	where user.id_level=1
	order by user.id desc";
	$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
	
	while ($row2=mysql_fetch_array($result2)) {
	$karyawan=$row2['username'];
	$status=$row2['Status'];
	echo"
	<tr class='info'>
		<td><font face='calibri'>$row2[username]</font></td>
		<td><font face='calibri'>$row2[fullname] ($row2[inisial])</font></td>
		<td><font face='calibri'>$row2[nama_level]</font></td>
		<td><font face='calibri'>$row2[nama_cg]</font></td>
		<td><font face='calibri'>$row2[nama_dep]</font></td>
		<td><font face='calibri'>$row2[password]</font></td>
		<td><center><small><font face='calibri'><a href='lihat_data_user.php?username=$karyawan'><span class='badge badge-info'><b>Lihat</b></span></a> 
		<a href='ubah_data_user.php?username=$karyawan'><span class='badge badge-info'><b>Ubah</b></span></a>"; 
		if (($status) == 1) {
		echo" <a href='nonaktif_user.php?username=$username'><span class='badge badge-success'><b>Aktif</b></span></a>";
		} else if (($status) == 0) {
		echo" <a href='aktif_user.php?username=$username'><span class='badge badge-important'><b>Non Aktif</b></span></a>";
		}
		echo"</font></small></center></td>
	</tr>
	";
	} 
	
	if ($karyawan == NULL) {
		echo"<tr class='info'><td colspan='11'><center><font face='calibri'>Tidak ada data user yang ditampilkan</font></center></td></tr>";
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