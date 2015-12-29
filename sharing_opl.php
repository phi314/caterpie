<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$username=$_SESSION['username'];
?>
<ul class="nav nav-pills">
  <li role="presentation" ><a href='index.php'><font face='calibri'><big>BERANDA</big></font></a></li>
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>SHARING OPL</big></big></big></font></a></li>
</ul>

<table class="table table-hover table-condensed table-bordered">
				
				<?php echo "<tbody>
<tr class='warning'>

					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Pembuat</b></center></font></small></td>
					
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tema OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Jenis OPL</b></center></font></small></td>
  </tr>
";
$query2 = "SELECT * FROM akses_opl 
join opl on (opl.no_opl_temp=akses_opl.no_opl_temp)
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where akses_opl.username='$username' and akses_opl.nilai=0 and
opl.status != '8'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {

$jenis_opl=$row2['jenis_opl'];
$status_opl=$row2['status'];
$no_opl=$row2['no_opl'];

if ($jenis_opl == 1){
	$jenis='Pengetahuan Dasar';
} else if ($jenis_opl == 2){
	$jenis='Troubleshooting';
} else {
	$jenis ='Improvement';
}

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
echo "
<tr class='info'>

<td><small><center><font face='calibri'><a href='detail_opl_sharing.php?no_opl_temp=$row2[no_opl_temp]'>";
if ($no_opl != NULL){
echo"$no_opl";	
} else {
echo"$row2[no_opl_temp]";
}
echo"</a></font></center></small></td>
<td ><small><font face='calibri'><center>$row2[fullname]</center></font></td>
<td ><small><font face='calibri'><center>$row2[tgl_pembuatan]</center></font></small></td>
<td ><small><font face='calibri'>$row2[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td></tr>";
$no++;
} 
	
?></tbody> 
			</table>		

</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>