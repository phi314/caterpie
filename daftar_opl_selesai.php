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
$querya1 = "SELECT count(opl.tema_opl) as b FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and (opl.status != 8 and opl.status !=7)";
$resulta1 = mysql_query($querya1) or die ('error, query failed.'.mysql_error());	
while ($rowa1=mysql_fetch_array($resulta1)) {
$jmla1=$rowa1['b'];
}
if ($jmla1 == NULL) {
		$jmla11=0;
} else {
	$jmla11=$jmla1;
}

$querya2 = "SELECT count(opl.tema_opl) as c FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and opl.status = 8";
$resulta2 = mysql_query($querya2) or die ('error, query failed.'.mysql_error());	
while ($rowa2=mysql_fetch_array($resulta2)) {
$jmla2=$rowa2['c'];
}
if ($jmla2 == NULL) {
		$jmla22=0;
} else {
	$jmla22=$jmla2;
}

$querya3 = "SELECT count(opl.tema_opl) as d FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where agreement_opl.user='$username' and (opl.status = '2' or opl.status = '4' or opl.status = '6')";
$resulta3 = mysql_query($querya3) or die ('error, query failed.'.mysql_error());	
while ($rowa3=mysql_fetch_array($resulta3)) {
$jmla3=$rowa3['d'];
}
if ($jmla3 == NULL) {
		$jmla33=0;
} else {
	$jmla33=$jmla3;
}

$querya4 = "select count(opl.no_opl_temp) as e from akses_opl
join opl on (opl.no_opl_temp=akses_opl.no_opl_temp)
where akses_opl.username='$username'";
$resulta4 = mysql_query($querya4) or die ('error, query failed.'.mysql_error());	
while ($rowa4=mysql_fetch_array($resulta4)) {
$jmla4=$rowa4['e'];
}
if ($jmla4 == NULL) {
		$jmla44=0;
} else {
	$jmla44=$jmla4;
}

$querya7 = "SELECT count(opl.tema_opl) as h FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and opl.status = 7";
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
	<li role="presentation" ><a href='index.php'><font face='calibri'><big>DASHBOARD OPL <small><small><span class='badge badge-success'><?php echo"$jmla11"; ?></span></small></small></big></font></a></li>
    <li role="presentation"><a href='daftar_opl_reject.php'><font face='calibri'><big>OPL REJECT <small><small><span class='badge badge-success'><?php echo"$jmla22"; ?></span></small></small></big></font></a></li>
	<li role="presentation" ><a href='daftar_opl_koreksi.php'><font face='calibri'><big>OPL KOREKSI <small><small><span class='badge badge-success'><?php echo"$jmla33"; ?></span></small></small></big></font></a></li>
	<li role="presentation" ><a href='daftar_opl_sharing.php'><font face='calibri'><big>SHARING OPL <small><small><span class='badge badge-success'><?php echo"$jmla44"; ?></span></small></small></big></font></a></li>
<li role="presentation"  class="active" ><a><font face='calibri'><big><big><big>OPL SELESAI <small><small><span class='badge badge-warning'><?php echo"$jmla77"; ?></span></small></small></big></big></big></font></a></li>
  </ul>
<form action='daftar_opl_selesai.php' method='post'>
<big><big><font face='calibri'> JENIS OPL &nbsp;</font></big></big><select name='jenis'>
<option value='All'>Semua
<option value='1'>Pengetahuan Dasar
<option value='2'>Troubleshooting
</select>
&nbsp;&nbsp;<input type='submit' class='btn btn-primary' value='Seleksi'>
</form>
  <?php
  $rowPerPage = 6;
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
where user.username='$username' and opl.status = '7' $jenis_opl_select
ORDER by user.id desc LIMIT $offset, $rowPerPage";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>	
			<table class="table table-hover table-condensed table-bordered">
				
				<?php echo "<tbody>
<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tema OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Jenis OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Status</b></center></font></small></td>
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
<td><small><center><font face='calibri'><a href='detail_opl_selesai.php?no_opl_temp=$row[no_opl_temp]'>$row[no_opl]</a></font></center></small></td>
<td ><small><font face='calibri'><center>$row[tgl_pembuatan]</center></font></small></td>
<td ><small><font face='calibri'>$row[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td>
<td ><small><font face='calibri'><center>$status<br/>($row[tgl_approve_koordinator])</center></font></small></td></tr>";
$no++;
} 
	if ($no_opl_temp == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data OPL yang mempunyai status selesai</font></center></td></tr>";
} else {echo"";}
?></tbody> 
			</table>
			
<?php
$query = "SELECT COUNT(opl.id) AS numrows FROM opl join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and opl.status = '8'";
$result = mysql_query($query) or die ('Error, query failed. ' .mysql_error());
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
$maxPage = ceil($numrows/$rowPerPage);
$nextLink = '&nbsp;';
if($maxPage > 1)
{
$nav .="<form id=\"FNav\" name=\"FNav\" method=\"get\" action=\"\" align=\"center\">";
$nav .="<br/>&nbsp;&nbsp;<select name=\"page\" id=\"page\">";
for ($page = 1; $page <= $maxPage; $page++)
{
if($pageNum==$page)
{
$nav .="<option selected>$page</option>";
}else
{
$nav .="<option>$page</option>";
}
}
$nav .= "</select>";
$nav .= " &nbsp;&nbsp;<input type=\"submit\"name=\"btn\" value=\"Proses\" class=\"btn btn-info\" />";
$nav .= "</form>";
}
echo '<p>'.$nav.'</p>';
mysql_free_result($result);
?>



		
</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>