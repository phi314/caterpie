<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$kode=$_GET['username'];
$querys = "SELECT * FROM user
	JOIN level on (user.id_level=level.id_level)
	JOIN jabatan on (jabatan.id_jabatan=user.id_jabatan)
	JOIN circle_group on (circle_group.id_cg=user.id_cg)
	JOIN sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
	JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
where user.username='$kode'";
$results = mysql_query($querys) or die ('error, query failed.'.mysql_error());
while ($rows=mysql_fetch_array($results)) {
$id=$rows['id'];
$nik=$rows['username'];
$password=$rows['password'];
$fullname=$rows['fullname'];
$inisial=$rows['inisial'];
$email=$rows['email'];
$ext=$rows['ext'];
$foto=$rows['foto'];
}
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
<center><font face='calibri'><b>Ubah Data User</b></font></center><br/>
<form action='simpan_ubah_user.php' method='POST' enctype='multipart/form-data'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>NIK</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='username' value='<?php echo"$nik"; ?>'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Kata Sandi</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='password' value='<?php echo"$password"; ?>'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Nama</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='fullname' value='<?php echo"$fullname"; ?>'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Inisial</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='inisial' value='<?php echo"$inisial"; ?>'></td>
	</tr>
	<tr>
	<tr>
		<td><font face='calibri'><b>Email</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='email' value='<?php echo"$email"; ?>'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Telepon</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='ext' value='<?php echo"$ext"; ?>'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Jabatan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select class="form-control" name="id_jabatan" >
			<option value='kosong'> </option>
                <?php
                    $query = "SELECT id_jabatan,nama_jabatan FROM jabatan";
                    $result = mysql_query($query);
                    while($row=mysql_fetch_array($result))
                    {

                        echo"<option value='$row[id_jabatan]'>$row[nama_jabatan]</option>";
                    }
                ?>
            </select></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Hak Akses</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select class="form-control" name="id_level">
			<option value='kosong'> </option>
                <?php
                    $query1 = "SELECT id_level,nama_level FROM level";
                    $result1 = mysql_query($query1);
                    while($row=mysql_fetch_array($result1))
                    {

                        echo"<option value='$row[id_level]'>$row[nama_level]</option>";
                    }
                ?>
            </select></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Circle Group</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select class="form-control" name="id_cg">
			<option value='kosong'> </option>
                <?php
                    $query2 = "SELECT id_cg,nama_cg FROM circle_group";
                    $result2 = mysql_query($query2);
                    while($row=mysql_fetch_array($result2))
                    {

                        echo"<option value='$row[id_cg]'>$row[nama_cg]</option>";
                    }
                ?>
            </select></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Foto</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><img src='foto/<?php echo"$foto"; ?>' width='70px'></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type='file' name='foto'>
		</td>
	</tr>
	<tr><td></td><td><br/></td></tr>
	<tr>
		<td><font face='calibri'><b>Setting Atasan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select name="pemeriksa">
			<option value='kosong'> </option>
                <?php
                    $query3 = "SELECT * FROM pemeriksa
					join user on (pemeriksa.username=user.username)";
                    $result3 = mysql_query($query3);
                    while($row=mysql_fetch_array($result3))
                    {

                        echo"<option value='$row[username]'>$row[fullname]</option>";
                    }
                ?>
            </select></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Setting Komite</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select name="komite">
			<option value='kosong'> </option>
                <?php
                    $query4 = "SELECT * FROM komite
					join user on (komite.username=user.username)";
                    $result4 = mysql_query($query4);
                    while($row=mysql_fetch_array($result4))
                    {

                        echo"<option value='$row[username]'>$row[fullname]</option>";
                    }
                ?>
            </select></td>
	</tr>
	<tr><td></td><td><input type='hidden' name='id' value='<?php echo"$id"; ?>'><br/></td></tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan Perubahan' class='btn btn-primary btn-small'> <input type='reset' value='Ulangi' class='btn btn-danger btn-small'></td>
	</tr>
</table>
</form>
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
	$query = "SELECT * FROM user 
	JOIN level on (user.id_level=level.id_level)
	JOIN jabatan on (jabatan.id_jabatan=user.id_jabatan)
	JOIN circle_group on (circle_group.id_cg=user.id_cg)
	JOIN sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
	JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
	where user.id_level=1
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
		<td><center><small><font face='calibri'><a href='lihat_data_user.php?username=$karyawan'><span class='badge badge-info'><b>Lihat</b></span></a> 
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

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>