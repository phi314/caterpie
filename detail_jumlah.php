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
$stat=$_GET['stat'];
if ($stat == 1){
	$status="PENGETAHUAN DASAR";
} else if ($stat == 2){
	$status="TROUBLESHOOTING";
} else {
	$status="IMPROVEMENT";
}
?>
<ul class="nav nav-pills">
  <li role="presentation" ><a href='index.php'><font face='calibri'><big>KEMBALI</big></font></a></li>
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>OPL <?php echo"$status"; ?></big></big></big></font></a></li>
</ul>

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
where user.username='$username' and opl.jenis_opl='$stat' and opl.status = 7
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
$no_opl=$row['no_opl'];
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
<td><small><center><font face='calibri'><a href='detail_opl_jumlah.php?no_opl_temp=$row[no_opl_temp]&stat=$stat'>";
if ($no_opl != NULL){
	echo"$no_opl";
} else {
echo"$row[no_opl_temp]";
}
echo"</a></font></center></small></td>
<td ><small><font face='calibri'><center>$row[tgl_pembuatan]</center></font></small></td>
<td ><small><font face='calibri'>$row[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td>
<td ><small><font face='calibri'><center>$status<br/>( $row[tgl_approve_koordinator] )</center></font></td></small></tr>";
$no++;
} 
	if ($no_opl_temp == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
} else {echo"";}
?></tbody> 
			</table>
			
<?php
$query = "SELECT COUNT(opl.id) AS numrows FROM opl join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and opl.jenis_opl='$stat' and opl.status = 7";
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