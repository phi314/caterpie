
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
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
	$query = "SELECT * FROM user 
	JOIN level on (user.id_level=level.id_level)
	JOIN jabatan on (jabatan.id_jabatan=user.id_jabatan)
	JOIN circle_group on (circle_group.id_cg=user.id_cg)
	JOIN sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
	JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
	where user.id_level='1'
	order by user.id desc";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
	
	while ($row=mysql_fetch_array($result)) {
	$karyawan=$row['username'];
	$status=$row['Status'];
	echo"
	<tr class='info'>
		<td><font face='calibri'>$row[username]</font></td>
		<td><font face='calibri'>$row[fullname] ($row[inisial])</font></td>
		<td><font face='calibri'>$row[nama_level]</font></td>
		<td><font face='calibri'>$row[nama_cg]</font></td>
		<td><font face='calibri'>$row[nama_dep]</font></td>
		<td><font face='calibri'>$row[password]</font></td>
		<td><center><small><font face='calibri'>
		<a href='lihat_data_user.php?username=$karyawan'><span class='badge badge-info'><b>Lihat</b></span></a> 
		<a href='ubah_data_user.php?username=$karyawan'><span class='badge badge-info'><b>Ubah</b></span></a>"; 
		if (($status) == 1) {
		echo" <a href='nonaktif_user.php?username=$karyawan'><span class='badge badge-success'><b>Aktif</b></span></a>";
		} else if (($status) == 0) {
		echo" <a href='aktif_user.php?username=$karyawan'><span class='badge badge-important'><b>Non Aktif</b></span></a>";
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
	