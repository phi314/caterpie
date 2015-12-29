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


<?php
include"koneksi.php";
$no_opl_temp=$_GET['no_opl_temp'];
echo"
<a href='daftar_opl_selesai_koordinator.php'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a>
<a href='lihat_nilai_3.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-primary btn-small' value='Penilaian'></a>
<a href='cetak_opl.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-success btn-small' value='Cetak OPL'></a>
<center><font face='calibri'><b>ONE POINT LESSON</b></font></center><hr/>";
$query = "SELECT * FROM opl
	JOIN agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
where opl.no_opl_temp='$no_opl_temp'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
 
while ($row=mysql_fetch_array($result)) {
$pemeriksa=$row['pemeriksa'];
$komite=$row['komite'];
$pembuat=$row['user'];
$no_opl = $row['no_opl'];

$query2 = "SELECT * FROM user
where username='$pemeriksa'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());

$query3 = "SELECT * FROM user
where username='$komite'";
$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());

$query4 = "SELECT * FROM detail_opl
where no_opl_temp='$no_opl_temp'";
$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());

$query5 = "SELECT * FROM user
where username='$pembuat'";
$result5 = mysql_query($query5) or die ('error, query failed.'.mysql_error());

$jenis_opl=$row['jenis_opl'];
if ($jenis_opl==1){
	$jenis='Pengetahuan Dasar';
} else if ($jenis_opl==2){
	$jenis='Troubleshooting';
} else {
	$jenis='Improvement';
}
echo"
<table align='left'>
<tr>
	<td><font face='calibri'>Nomor OPL</font></td>
	<td>&nbsp;:&nbsp;</td>";
	if($no_opl != NULL){
	echo"<td><font face='calibri'><b>$row[no_opl]</b></font></td>";
	}
	else
	{
		echo"<td><font face='calibri'><b>$row[no_opl_temp]</b></font></td>";
	}
echo"</tr>
<tr>
	<td><font face='calibri'>Tanggal Pembuatan</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row[tgl_pembuatan]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Jenis OPL</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$jenis</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Tema OPL</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row[tema_opl]</b></font></td>
</tr>";
$status_opl=$row['status'];
if ($status_opl == 1){
	$status='Menunggu Atasan';
} else if ($status_opl == 2){
	$status='Koreksi Atasan';
} else if ($status_opl==3){
	$status='Menunggu Komite';
} else if ($status_opl==4){
	$status='Koreksi Komite';
} else if ($status_opl==5){
	$status='Menunggu Koordinator';
} else if ($status_opl==6){
	$status='Koreksi Koordinator';
} else if ($status_opl==7){
	$status='Selesai';
} else {
	$status='Reject';
}
echo"<tr>
	<td><font face='calibri'>Status OPL</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$status</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Tanggal Approve</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row[tgl_approve_koordinator]</b></font></td>
</tr>";
while ($row5=mysql_fetch_array($result5)) {
echo"<tr>
	<td><font face='calibri'>Pembuat</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row5[fullname]</b></font></td>
</tr>";	
}
while ($row2=mysql_fetch_array($result2)) {
echo"<tr>
	<td><font face='calibri'>Atasan</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row2[fullname]</b></font></td>
</tr>";	
}
while ($row3=mysql_fetch_array($result3)) {
echo"<tr>
	<td><font face='calibri'>Komite</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row3[fullname]</b></font></td>
</tr>";	
}
echo"<tr><td colspan='3'><br/></td></tr>";
$no=1;
while ($row4=mysql_fetch_array($result4)) {
echo"<tr>
	<td><font face='calibri'></font></td>
	<td>&nbsp;&nbsp;</td>
	<td><font face='calibri'>Step ke $no</font><br/><img src='foto_opl/$row4[gambar]' width='250px'><br/>
	<font face='calibri'>Keterangan : <b>$row4[keterangan]</b></font><br/><br/></td>
</tr>";	
$no++;
}
echo"</table>
";
}
?>
<br/>
</div>

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>