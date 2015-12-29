<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$no_opl_temp=$_GET['no_opl_temp'];


echo"<a href='detail_opl_jumlah.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a>";
?><br/><br/>
<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr class='warning'>
			<td><center><small><font face='calibri'><b>No</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nama</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Nilai</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Tanggal Penilaian</b></font></small></center></td>
		</tr>
	<?php
	$query = "SELECT * FROM akses_opl
	join user on (user.username=akses_opl.username)
	where akses_opl.no_opl_temp='$no_opl_temp'";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
	?>
	<tbody>
	<?php
	$no=1;
	while ($row=mysql_fetch_array($result)) {
	$nilai=$row['nilai'];
	if ($nilai == 1){
		$detail='Tahap belajar';
	} else if ($nilai == 2){
		$detail='Dapat melakukan dengan bantuan';
	} else if ($nilai == 3) {
		$detail='Mengerti tetapi belum dapat melakukannya';
	} else if ($nilai == 4){
		$detail='Dapat melakukan';
	}
	echo"
	<tr class='info'>
		<td><center><font face='calibri'>$no</font></center></td>
		<td><font face='calibri'>$row[fullname]</font></td>
		<td><font face='calibri'>";
		if ($nilai == 0){
			echo"Tidak ada data";
		} else {
		echo"$detail";
		}
		echo"</font></td>
		<td><center><font face='calibri'>$row[tgl_penilaian]</font></center></td>
		</tr>
	";
	$no++;
	} 
	if ($nilai == NULL) {
		echo"<tr class='info'><td colspan='4'><center><font face='calibri'>Anda belum membagikan OPL ini ke user lain</font></center></td></tr>";
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