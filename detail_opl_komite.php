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
<?php
include"koneksi.php";
$no_opl_temp=$_GET['no_opl_temp'];

$queryalasan = "
select * FROM opl where no_opl_temp='$no_opl_temp'";
$resultalasan = mysql_query($queryalasan) or die ('error, query failed.'.mysql_error());
while ($rowalasan=mysql_fetch_array($resultalasan)) {  
$alasan=$rowalasan['alasan_koreksi_komite'];
}

echo"
<a href='index.php'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a>
<a href='approve_opl_komite.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-primary btn-small' value='Approve'></a>
<a href='koreksi_opl_komite.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-primary btn-small' value='Koreksi'></a>
<a href='reject_opl_komite.php?no_opl_temp=$no_opl_temp'><input type='submit' class='btn btn-danger btn-small' value='Reject'></a>
";
if ($alasan != NULL)
{
	echo"<br/><br/><font face='calibri'> Alasan koreksi sebelumnya &nbsp: <b>&nbsp&nbsp$alasan</b></font>";
}else
{
	"";
}
echo"
<hr/>
<center><font face='calibri'><b>ONE POINT LESSON</b></font></center><br/><br/>";
$query = "SELECT * FROM opl
	JOIN agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
where opl.no_opl_temp='$no_opl_temp'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
 
while ($row=mysql_fetch_array($result)) {
$pemeriksa=$row['pemeriksa'];
$komite=$row['komite'];

$query2 = "SELECT * FROM user
where username='$pemeriksa'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());

$query3 = "SELECT * FROM user
where username='$komite'";
$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());

$query4 = "SELECT * FROM detail_opl
where no_opl_temp='$no_opl_temp'";
$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());

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
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row[no_opl_temp]</b></font></td>
</tr>
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

while ($row4=mysql_fetch_array($result4)) {
echo"<tr>
	<td><font face='calibri'></font></td>
	<td>&nbsp;&nbsp;</td>
	<td><font face='calibri'>Step ke $row4[no_step]</font><br/><img src='foto_opl/$row4[gambar]' width='250px'><br/>
	<font face='calibri'>Keterangan : <b>$row4[keterangan]</b></font><br/><br/></td>
</tr>";	
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