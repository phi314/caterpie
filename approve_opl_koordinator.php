<?php
require("koneksi.php");	
$no_opl_temp=$_GET['no_opl_temp'];
date_default_timezone_set('Asia/Jakarta');
$tgl_approve_pemeriksa = date('Y-m-d H:i:s');
$fullname=$_GET['fullname'];
$tahun = date('Y');

$query = "SELECT * FROM user
JOIN circle_group on (user.id_cg=circle_group.id_cg)
JOIN sub_dep on (circle_group.id_sub_dep=sub_dep.id_sub_dep)
JOIN departmen on (departmen.id_dep=sub_dep.id_dep)
WHERE user.username='$fullname'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
$row=mysql_fetch_array($result);

$query2 = "SELECT id_agreement FROM agreement_opl WHERE user='$fullname'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
$row2=mysql_fetch_array($result2);

$query3 = "SELECT * FROM opl WHERE no_opl_temp='$no_opl_temp'";
$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());
$row3=mysql_fetch_array($result3);

$nama_cg=$row['nama_cg'];
$nama_dep=$row['nama_dep'];
$id_agreement=$row2['id_agreement'];
$jenis_opl=$row3['jenis_opl'];
	if ($jenis_opl == 1){
			$jenis='K';
		} else if ($jenis_opl == 2){
			$jenis='T';
		} else {
			$jenis ='I';
		}
$query4="SELECT MAX(SUBSTRING_INDEX(SUBSTRING_INDEX(no_opl,'/',-2),'/',1)) AS a
FROM opl WHERE STATUS=7 AND
SUBSTRING_INDEX(SUBSTRING_INDEX(no_opl,'/',-3),'/',1)='$nama_cg' AND
SUBSTRING_INDEX(SUBSTRING_INDEX(no_opl,'/',-4),'/',1)='$nama_dep' AND
SUBSTRING_INDEX(SUBSTRING_INDEX(no_opl,'/',-5),'/',1)='$jenis' AND
SUBSTRING_INDEX(SUBSTRING_INDEX(no_opl,'/',-1),'/',1)='$tahun'";

$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());
while ($row4=mysql_fetch_array($result4))
{
	$no_opl=$row4['a'];
	$no_opl1 = $no_opl+1;
}
$no_opla='OPL/'.$jenis.'/'.$nama_dep.'/'.$nama_cg.'/'.$no_opl1.'/'.$tahun.'';

mysql_query("update opl set no_opl='$no_opla'
 WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
mysql_query("update opl set status=7, tgl_approve_koordinator='$tgl_approve_pemeriksa' WHERE no_opl_temp='$no_opl_temp';")
		or die(mysql_error());
				echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, Proses approve OPL berhasil');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=index.php'>";
?>