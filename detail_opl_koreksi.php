<!DOCTYPE html>
<?php
	$no_opl_temp = $_GET['no_opl_temp'];
?>
<html lang="en">

<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$queryjml = "
select * FROM opl where no_opl_temp='$no_opl_temp'";
$jmlresult = mysql_query($queryjml) or die ('error, query failed.'.mysql_error());
while ($rowjml=mysql_fetch_array($jmlresult)) {  
$status=$rowjml['status'];
if ($status == 2) {
	$tes1=$rowjml['alasan_koreksi_pemeriksa'];
} else if ($status == 4) {
	$tes1=$rowjml['alasan_koreksi_komite'];
} else {
	$tes1=$rowjml['alasan_koreksi_koordinator'];
}
echo"
<a href='daftar_opl_koreksi.php'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a><br/>
<br/><font face='calibri'>Alasan koreksi : <b>$tes1</b></font><hr/>
<form action='cek_koreksi_opl.php' method='POST' enctype='multipart/form-data'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>Tema OPL</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='judul' value='$rowjml[tema_opl]'></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='hidden' name='status' value='$rowjml[status]'></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Jenis OPL</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><select name='jenis_opl'>
		<option value='1'>Pengetahuan Dasar
		<option value='2'>Troubleshooting
		</select></td>
	</tr>
	</table><br/>";
	}
	$query1 = "
	select * FROM detail_opl where no_opl_temp='$no_opl_temp' order by no_step asc";
	$result1 = mysql_query($query1) or die ('error, query failed.'.mysql_error());
	while ($row1=mysql_fetch_array($result1)) { 
	echo"
	<table>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td><a href='edit_step_opl.php?no_step=$row1[no_step]&no_opl_temp=$row1[no_opl_temp]'><span class='label label-info'>Edit</span></a> 
		<a href='hapus_step_opl.php?no_step=$row1[no_step]&no_opl_temp=$row1[no_opl_temp]'><span class='label label-important'>Hapus</span></a></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;&nbsp;</td>
		<td><img src='foto_opl/$row1[gambar]' width='150px'></td>
	</tr>
	<tr>
		<td></td>
		<td><font face='calibri'><b>$row1[keterangan]</b></font></td>
	</tr>
	</table><br/>
	";
	}
	echo"
";?>
	
	
	<?php
	echo"
	<center><br/>
	<input type='hidden' name='no_opl_temp' value='$no_opl_temp'>
	<input type='submit' value='Selesai Koreksi' class='btn btn-primary btn-small'>
	<a href='tambah_step_opl.php?no_opl_temp=$no_opl_temp'><input type='button' class='btn btn-success btn-small' value='+ Tambah Step'></a><br/><br/>
	</center>
</form>";

?>
	
</div>

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>