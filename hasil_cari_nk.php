<?php
$search=$_GET['searchnk'];
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
$tgl_skrg = date('Y-m-d H:i:s');

$query2 = "select count(fullname) as b FROM user where user.fullname like '%$search%'";
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

$query = "SELECT user.fullname,circle_group.nama_cg, COUNT(user.fullname) AS jumlah FROM OPL 
	join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
	join user on (user.username=agreement_opl.user)
	join circle_group on (user.id_cg = circle_group.id_cg)
	where user.fullname like '%$search%' and opl.status = 7 and opl.tgl_approve_koordinator <= '$tgl_skrg'
	";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>	
<table class="table table-hover table-condensed table-bordered">
				
<?php echo "<tbody>
				<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nama Karyawan</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nama Circle Group</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nilai</b></center> </font></small></td>
				</tr>
";
while ($row=mysql_fetch_array($result)) {

echo"
	<tr class='info'>
	<td ><small><font face='calibri'>$row[fullname]</font></small></td>
	<td ><small><font face='calibri'>$row[nama_cg]</font></small></td>
	<td ><small><font face='calibri'>$row[jumlah]</font></small></td>
</tr>";

} 

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