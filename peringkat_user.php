<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$queryjml = "SELECT count(opl.tema_opl) as jml FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status != 7 and opl.status != 8";
$resultjml = mysql_query($queryjml) or die ('error, query failed.'.mysql_error());
while ($rowjml=mysql_fetch_array($resultjml)) {
$jml=$rowjml['jml'];
}
if ($jml == NULL) {
		$jml2=0;
} else {
	$jml2=$jml;
}

$queryjml2 = "SELECT count(opl.tema_opl) as jml2 FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status = 8";
$resultjml2 = mysql_query($queryjml2) or die ('error, query failed.'.mysql_error());
while ($rowjml2=mysql_fetch_array($resultjml2)) {
$jml22=$rowjml2['jml2'];
}
if ($jml22 == NULL) {
		$jml222=0;
} else {
	$jml222=$jml22;
}
?>
<ul class="nav nav-pills">
  <li role="presentation"><a href='index.php'><font face='calibri'><big>DASHBOARD OPL <small><small><span class='badge badge-success'><?php echo"$jml2"; ?></span></small></small></big></font></a></li>
  <li role="presentation"><a href='dashboard_reject.php'><font face='calibri'><big>OPL REJECT <small><small><span class='badge badge-success'><?php echo"$jml222"; ?></span></small></small></big></font></a></li>
   <li role="presentation" class="active"><a><font face='calibri'><big><big><big>DASHBOARD USER </big></big></big></font></a></li>
   </ul>
<div 
</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>