<?php
include"koneksi.php";
error_reporting(0);
session_start();
$username=$_SESSION['username'];
$judul =mysql_real_escape_string($_POST['judul']);
$jenis_opl = $_POST['jenis_opl'];
$keterangan=$_POST['keterangan'];
date_default_timezone_set('Asia/Jakarta');
$tgl_pembuatan = date('Y-m-d H:i:s');
$status=1;
$no_opl_temp="$username/$tgl_pembuatan/$jenis_opl";
$t=0;
$f=1;

//$query="select * FROM opl where tema_opl='$judul'";
//$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
//$row=mysql_fetch_array($result);
//$judul2=$row['tema_opl'];

$query2 = "SELECT * FROM agreement_opl WHERE user='$username'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
while ($row2=mysql_fetch_array($result2)) {
    $id_agreement=$row2['id_agreement'];
}

//if ($judul2 != NULL) {
//echo "<script language=\"Javascript\">\n";
//echo "window.alert('Error, Tema OPL sudah tersedia di database, silakan ulangi proses!');";
//echo "</script>";
//echo "<script>javascript:history.back()</script>";
//}
if ($judul == NULL or $jenis_opl == 'kosong' or $keterangan == NULL) {
echo "<script language=\"Javascript\">\n";
echo "window.alert('Error, Terdapat kolom yang belum diisi, silakan ulangi proses!');";
echo "</script>";
echo "<script>javascript:history.back()</script>";
} else {
	mysql_query("insert into opl(no_opl_temp,tgl_pembuatan,jenis_opl,tema_opl,id_agreement,status) values 
	('$no_opl_temp','$tgl_pembuatan','$jenis_opl','$judul','$id_agreement',1)") or die(mysql_error());
    foreach($_FILES['foto_opl']['name'] as $key => $val){
        $name = $_FILES['foto_opl']['name'][$key];
        $source  = $_FILES['foto_opl']['tmp_name'][$key];		
        $direktori  = "foto_opl/$name";
		$b = $judul." ".$f;
        if(trim($name)!=''){
					move_uploaded_file($source,$direktori);	
	rename($direktori, "foto_opl/".$b.".jpg");
	$direktori=$b.".jpg";
                mysql_query("insert into detail_opl(no_step,no_opl_temp,gambar,keterangan) values 
				('$f','$no_opl_temp','$direktori','$keterangan[$t]')") or die(mysql_error());
//				echo 'Berhasil mengupload file '.$name.' '.$keterangan[$t].' '.$f.' ke Folder upload<br/>';
        }
		$t++;
		$f++;
    }
		echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Proses pembuatan OPL berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=setting_akses.php?no_opl_temp=$no_opl_temp'>";
}
?>
