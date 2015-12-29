<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";

//pagination
$per_hal = 7;
$queryCount = "SELECT COUNT(opl.id) AS numrows FROM opl join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status = 7";
$resultCount = mysql_query($queryCount) or die ('error, query failed.'.mysql_error());
$rowCount=mysql_fetch_array($resultCount);
$jum=$rowCount['numrows'];
$halaman=ceil($jum/$per_hal);
$page = (isset($_GET['page']))?(int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;

$jenis=$_POST['jenis'];
$jenis_opl_select='';
if ($jenis=='2') {
	$jenis_opl_select='and opl.jenis_opl=2';
	
} else if ($jenis=='1'){
	$jenis_opl_select='and opl.jenis_opl=1';
} else if ($jenis=='All') {
	$jenis_opl_select = '';
}else{
	$jenis_opl_select = '';
}


$querya6 = "SELECT count(no_opl_temp) as c FROM opl 
		JOIN agreement_opl
		ON (opl.id_agreement=agreement_opl.id_agreement) where opl.status=5";
$resulta6 = mysql_query($querya6) or die ('error, query failed.'.mysql_error());	
while ($rowa6=mysql_fetch_array($resulta6)) {
$jmla6=$rowa6['c'];
}
if ($jmla6 == NULL) {
		$jmla66=0;
} else {
	$jmla66=$jmla6;
}

$querya7 = "SELECT count(opl.tema_opl) as h FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status = 7";
$resulta7 = mysql_query($querya7) or die ('error, query failed.'.mysql_error());	
while ($rowa7=mysql_fetch_array($resulta7)) {
$jmla7=$rowa7['h'];
}
if ($jmla7 == NULL) {
		$jmla77=0;
} else {
	$jmla77=$jmla7;
}
?>
<ul class="nav nav-pills">
  <li role="presentation"><a href='index.php'><font face='calibri'><big>DASHBOARD OPL <small><small><span class='badge badge-success'><?php echo"$jmla66"; ?></span></small></small></big></font></a></li>
  <li role="presentation"  class="active"><a><font face='calibri'><big><big><big>OPL SELESAI <small><small><span class='badge badge-warning'><?php echo"$jmla77"; ?></span></small></small></big></big></big></font></a></li>
	<li role="presentation" ><a href='score_koordinator.php'><font face='calibri'><big>PENILAIAN </big></font></a></li>
  <li role="presentation" ><a href='report_koordinator.php'><font face='calibri'><big>LAPORAN OPL </big></font></a></li>
</ul>	
<form action='daftar_opl_selesai_koordinator.php' method='post'>
<big><big><font face='calibri'> JENIS OPL &nbsp;</font></big></big><select name='jenis'>
<option value='All'>Semua
<option value='1'>Pengetahuan Dasar
<option value='2'>Troubleshooting
</select>
&nbsp;&nbsp;<input type='submit' class='btn btn-primary' value='Seleksi'>
</form>
<?php

  $rowPerPage = 10;
$pageNum = 1;
if(!empty($_GET['page']))
{
$pageNum = $_GET['page'];
}
$offset = ( $pageNum - 1) * $rowPerPage;
//Creator Status 
$query = "SELECT * FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status = '7' $jenis_opl_select
ORDER by user.id desc LIMIT $offset, $rowPerPage";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>	
			<table class="table table-hover table-condensed table-bordered">
				
				<?php echo "<tbody>
<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Pembuat</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tema OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Jenis OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center></font></small></td>
  </tr>
";
while ($row=mysql_fetch_array($result)) {
$no_opl_temp=$row['no_opl_temp'];
$jenis_opl=$row['jenis_opl'];
$status_opl=$row['status'];
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
<td><small><center><font face='calibri'><a href='detail_opl_selesai_koordinator.php?no_opl_temp=$row[no_opl_temp]'>$row[no_opl]</a></font></center></small></td>
<td ><small><font face='calibri'>$row[fullname]</font></small></td>
<td ><small><font face='calibri'>$row[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td>
<td ><small><font face='calibri'><center>$row[tgl_approve_koordinator]</center></font></small></td></tr>";
$no++;
} 
	if ($no_opl_temp == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data OPL yang mempunyai status selesai</font></center></td></tr>";
} else {echo"";}
?></tbody> 
			</table>
			
<!-- Pagination -->
<!--<a href="?page=<?php echo $page -1 ?>"> < </a>		-->	
<?php
echo"<center>";
for($x=1;$x<=$halaman;$x++){
	?>
	<b><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></b>
	<?php
}
?>
<!--<b><a href="?page=<?php echo $page +1 ?>"> Next ...</a></b><br/> -->
<?php
echo"</center>";
?>



		
</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>