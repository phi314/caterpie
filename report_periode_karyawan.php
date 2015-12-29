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
  <li role="presentation"><a href='daftar_opl_selesai_koordinator.php'><font face='calibri'><big>OPL SELESAI <small><small><span class='badge badge-success'><?php echo"$jmla77"; ?></span></small></small></big></font></a></li>
  <li role="presentation" ><a href='score_koordinator.php'><font face='calibri'><big>PENILAIAN </big></font></a></li>
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>LAPORAN OPL </big></big></big></font></a></li>
  </ul>
<marquee behavior="alternate" scrolldelay="100" onmouseover="this.stop();" onmouseout="this.start();"><font face='calibri'>Gunakan browser Google Chrome untuk penggunaan yang compatible</font></marquee>
<br/><br/><br/>

<ul>
	<a href='report_koordinator.php'><input type="button" class='btn btn-success' value="Colage Data"></a>
	<input type="button" class='btn btn-danger' value="Periode Karyawan"></a>
	<a href='report_periode_cg.php'><input type="button" class='btn btn-success' value="Periode CG"></a>
	<a href='report_periode_subdep.php'><input type="button" class='btn btn-success' value="Periode Sub Departmen"></a>
	<a href='report_periode_dep.php'><input type="button" class='btn btn-success' value="Periode Departmen"></a>
</ul>

<br/><br/>
<form action='export_periode_karyawan.php' method='post'>
<table align='center'>
<tr><td><font face='calibri'><b>Tanggal Awal&nbsp;&nbsp;</b></font></td>
<td><input type='date' name='a' required></td></tr>
<tr><td><font face='calibri'><b>Tanggal Akhir&nbsp;&nbsp;</b></font></td>
<td><input type='date' name='b' required></td></tr>
<tr>
<td></td>
<td><table>
				<tr>
					<td><input type='submit' class='btn btn-primary' name='simpan' value='Proses'></td>
					<td><input type='reset' class='btn btn-danger' name='simpan' value='Ulangi'></td>
				</tr>
			</table>

</td>
</tr>
</table>

</form>


</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>
