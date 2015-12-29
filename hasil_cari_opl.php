<?php
$search=$_GET['search'];
if ($search== NULL){	
echo "<script language=\"Javascript\">\n";
		echo "window.alert('Error, Anda belum memasukkan kata kunci pencarian, silakan ulangi proses!');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";
} else {
?>

<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$username = $_SESSION['username'];

$query2 = "select count(tema_opl) as b FROM opl where opl.tema_opl like '%$search%'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
		$jmldata=$row2['b'];
}
if ($search == NULL || $search == "" || $search == " " || $search == "  ") {
	echo"<font face='calibri'>Anda belum memasukkan kata kunci pencarian</font>";
} else {
	echo"<font face='calibri'>Kata kunci pencarian : <b>$search</b><br/>
	<small>Terdapat <b>$jmldata</b> data ditemukan</small></font>";
}
echo"
<br/><br/>
<a href='index.php'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a><br/><br/>";

$query = "SELECT * FROM opl
	JOIN agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
where opl.tema_opl like '%$search%'  ";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>	
<table class="table table-hover table-condensed table-bordered">
				
				<?php echo "<tbody>
<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tema OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Jenis OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Pembuat</b></center></font></small></td>
  </tr>
";
while ($row=mysql_fetch_array($result)) {
$no_opl_temp=$row['no_opl_temp'];
$no_opl=$row['no_opl'];
$jenis_opl=$row['jenis_opl'];
$status_opl=$row['status'];
$user=$row['user'];
if ($jenis_opl == 1){
	$jenis='Pengetahuan Dasar';
} else if ($jenis_opl == 2){
	$jenis='Troubleshooting';
} else {
	$jenis ='Improvement';
}

$query2 = "SELECT * FROM user
where username = '$user'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
	$fullname=$row2['fullname'];
}

echo "
<tr class='info'>
<td><small><center><font face='calibri'>";

if($no_opl != NULL){
		echo"$no_opl";
	} else {
		echo"$row[no_opl_temp]";
	}
echo"</font></center></small></td>
<td ><small><font face='calibri'><center>$row[tgl_pembuatan]</center></font></small></td>
<td ><small><font face='calibri'>$row[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td>
<td ><small><font face='calibri'>$fullname</font></td></small></tr>";
$no++;
} 
	if ($no_opl_temp == NULL) {
	echo"<tr class='info'><td colspan='5'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
} else {echo"";}
?></tbody> 
			</table>
<br/>
</div>

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>
<?php
}
?>