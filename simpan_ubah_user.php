<?php
error_reporting(0);
require("koneksi.php");
$username=$_POST['username'];
$password=$_POST['password'];
$fullname=$_POST['fullname'];
$inisial=$_POST['inisial'];
$email=$_POST['email'];
$ext=$_POST['ext'];
$id_jabatan=$_POST['id_jabatan'];
$id_level=$_POST['id_level'];
$id_cg=$_POST['id_cg'];
$id=$_POST['id'];
$pemeriksa=$_POST['pemeriksa'];
$komite=$_POST['komite'];

$file_name = $_FILES['foto']['name'];
$size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$source = $_FILES['foto']['tmp_name'];
$direktori = "foto/$file_name";
$direktori=str_replace("","_",$direktori);	
if ($username == NULL or $fullname == NULL or $inisial == NULL or $id_jabatan == 'kosong' or $id_level == 'kosong' or 
$id_cg == 'kosong' or $pemeriksa == 'kosong' or $komite == 'kosong') {
		echo "<script language=\"Javascript\">\n";
echo "window.alert('Error, Pastikan semua kolom terisi, silakan ulangi proses!');";
echo "</script>";
echo "<script>javascript:history.back()</script>";
} 
else {
	move_uploaded_file($source,$direktori);	
	rename($direktori, "foto/".$username.".jpg");
	$direktori=$username.".jpg";
	 	mysql_query("update user set username='$username',password='$password',fullname='$fullname',inisial='$inisial',id_level='$id_level',
		id_cg='$id_cg',id_jabatan='$id_jabatan',email='$email',ext='$ext',foto='$direktori' where id='$id'") or die(mysql_error());
		
	$query = "SELECT * FROM agreement_opl where user='$username'";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
	
	while ($row=mysql_fetch_array($result)) {
	$id_agreement=$row['id_agreement'];
	}
		mysql_query("update agreement_opl set pemeriksa='$pemeriksa',komite='$komite' where id_agreement='$id_agreement'") or die(mysql_error());
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Proses ubah data user berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}
?>