<?php
include"koneksi.php";
error_reporting(0);
session_start();
$no_opl_temp = $_POST['no_opl_temp'];
$keterangan= $_POST['keterangan'];
$tema_opl = $_POST['tema_opl'];
$t=0;
$f=1;

$query1 = "SELECT MAX(no_step) AS a
FROM detail_opl WHERE no_opl_temp='$no_opl_temp'";
$result1 = mysql_query($query1) or die ('error, query failed.'.mysql_error());
while ($row1=mysql_fetch_array($result1)) {
	$no_step=$row1['a'];
	$no_step1=$no_step +1;
}

foreach($_FILES['foto_opl']['name'] as $key => $val){
		$no_step2=$no_step1+$t;
        $name = $_FILES['foto_opl']['name'][$key];
        $source  = $_FILES['foto_opl']['tmp_name'][$key];		
        $direktori  = "foto_opl/$name";
		$b = $tema_opl." ".$no_step2;
        if(trim($name)!=''){
					move_uploaded_file($source,$direktori);	
					rename($direktori, "foto_opl/".$b.".jpg");
					$direktori=$b.".jpg";
                mysql_query("insert into detail_opl(no_step,no_opl_temp,gambar,keterangan) values 
				('$no_step2','$no_opl_temp','$direktori','$keterangan[$t]')") or die(mysql_error());
//				echo 'Berhasil mengupload file '.$name.' '.$keterangan[$t].' '.$f.' ke Folder upload<br/>';
        }
		$t++;
		$f++;
    }
echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Proses tambah step OPL berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=detail_opl_koreksi.php?no_opl_temp=$no_opl_temp'>";
?>
