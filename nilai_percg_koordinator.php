<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$a=$_POST['a'];
$b=$_POST['b'];
$c=$_POST['nama_cg'];
$tempA=$a;
$tempB=$b;
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
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>PENILAIAN </big></big></big></font></a></li>
  <li role="presentation" ><a href='report_koordinator.php'><font face='calibri'><big>LAPORAN OPL </big></font></a></li>
</ul>	
<marquee behavior="alternate" scrolldelay="100" onmouseover="this.stop();" onmouseout="this.start();"><font face='calibri'>Gunakan browser Google Chrome untuk penggunaan yang compatible</font></marquee>
<br/><br/>

<form action='nilai_percg_koordinator.php' method='post'>
<table>
<tr>
		<td><font face='calibri'><b> Pilih Circle Group</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td>
			<select class="form-control" name="nama_cg" required>
			<option value=''> </option>
                <?php
                    $query2 = "SELECT id_cg,nama_cg FROM circle_group";
                    $result2 = mysql_query($query2);
                    while($row2=mysql_fetch_array($result2))
                    {

                        echo"<option value='$row2[nama_cg]'>$row2[nama_cg]</option>";
                    }
                ?>
            </select></td>
	</tr>
<tr>
<tr>
	<td></td>
	<td><table>
				<tr>
					<td><input type='submit' class='btn btn-primary' name='simpan' value='Tampil'></td>
					<td><input type='reset' class='btn btn-danger' name='simpan' value='Ulangi'></td>
				</tr>
			</table>

	</td>
</tr>
</table>
</form>
<br/>
<!-- --------------------------------------Nilai Circle Group------------------------------------------ -->
<?php
	$query3 = "SELECT COUNT(opl.tema_opl) AS total FROM OPL 
	join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
	join user on (user.username=agreement_opl.user)
	join circle_group on (user.id_cg = circle_group.id_cg)
	where opl.status = 7 and opl.tgl_approve_koordinator>='$tempA' and  opl.tgl_approve_koordinator<='$tempB' and circle_group.nama_cg='$c'";
	$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());
	$row3 = mysql_fetch_array($result3);

	$query = "SELECT user.fullname,circle_group.nama_cg, COUNT(user.fullname) AS jumlah FROM OPL 
	join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
	join user on (user.username=agreement_opl.user)
	join circle_group on (user.id_cg = circle_group.id_cg)
	where opl.status = 7 and opl.tgl_approve_koordinator>='$tempA' and  opl.tgl_approve_koordinator<='$tempB' and circle_group.nama_cg='$c'
	GROUP BY user.fullname 
	ORDER BY jumlah DESC";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>
<table color="grey" width="25%" class="table-condensed table-bordered">				
<?php echo "<tbody>
<font face='calibri' color='grey'><big>NILAI CIRCLE GROUP</big></font><br/>
<tr bgcolor='Ivory'>
	<td colspan=2><small><font face='calibri'><center><b>$c</b></center></font></small></td>
</tr>
<tr bgcolor='Ivory'>
		<td><small><font face='calibri'><center><b>Nama Karyawan</b></center></font></small></td>
		<td><small><font face='calibri'><center><b>Nilai</b></center> </font></small></td>
</tr>
";
while ($row=mysql_fetch_array($result)) {
$nama_karyawan=$row['fullname'];

echo "
<tr bgcolor='#AFEEEE'>
	<td ><small><font face='calibri'>$row[fullname]</font></small></td>
	<td ><small><font face='calibri'>$row[jumlah]</font></small></td>
</tr>";
} 
echo"
<tr bgcolor='pink'>
		<td><small><font face='calibri'><center><b>Total</b></center> </font></small></td>
		<td><small><font face='calibri'>$row3[total]</font></small></td>
</tr>";
if ($nama_karyawan == NULL) {
	echo"<tr bgcolor='#AFEEEE'><td colspan='6'><center><font face='calibri'>Tidak ada data Score</font></center></td></tr>";
} else {echo"";}
?></tbody> 
</table>
<br/><br/>
<!-- --------------------------------------SCORE KARYAWAN------------------------------------------ -->
<?php
	$query = "SELECT user.fullname,circle_group.nama_cg, COUNT(user.fullname) AS jumlah FROM OPL 
	join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
	join user on (user.username=agreement_opl.user)
	join circle_group on (user.id_cg = circle_group.id_cg)
	where opl.status = 7 and opl.tgl_approve_koordinator>='$tempA' and  opl.tgl_approve_koordinator<='$tempB' 
	GROUP BY user.fullname 
	ORDER BY jumlah DESC";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>
<table class="table table-hover table-condensed table-bordered">				
<?php echo "<tbody>
<font face='calibri' color='grey'><big>NILAI KARYAWAN</big></font><br/>
<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nama Karyawan</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nama Circle Group</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nilai</b></center> </font></small></td>
  </tr>
";
while ($row=mysql_fetch_array($result)) {
$nama_karyawan=$row['fullname'];

echo "
<tr class='info'>
	<td ><small><font face='calibri'>$row[fullname]</font></small></td>
	<td ><small><font face='calibri'>$row[nama_cg]</font></small></td>
	<td ><small><font face='calibri'>$row[jumlah]</font></small></td>
</tr>";
} 
if ($nama_karyawan == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data Score</font></center></td></tr>";
} else {echo"";}
?></tbody> 
</table>
		
<?php
	include "footer.php";
?>
</div>
</html>