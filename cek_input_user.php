<?php
error_reporting(0);
require("koneksi.php");
$username=$_POST['username'];
$fullname=$_POST['fullname'];
$inisial=$_POST['inisial'];
$email=$_POST['email'];
$ext=$_POST['ext'];
$id_jabatan=$_POST['id_jabatan'];
$id_level=$_POST['id_level'];
$id_cg=$_POST['id_cg'];
$pemeriksa=$_POST['pemeriksa'];
$komite=$_POST['komite'];

$file_name = $_FILES['foto']['name'];
$size = $_FILES['foto']['size'];
$file_type = $_FILES['foto']['type'];
$source = $_FILES['foto']['tmp_name'];
$direktori = "foto/$file_name";

$query="select * FROM user where username='$username'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
$row=mysql_fetch_array($result);
$username2=$row[username];

$query2="select * FROM user where inisial='$inisial'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
$row2=mysql_fetch_array($result2);
$inisial2=$row2[inisial];

if ($username == NULL or $fullname == NULL or $inisial == NULL or $id_jabatan == 'kosong' or 
$id_level == 'kosong' or $id_cg == 'kosong' or $pemeriksa == 'kosong' or $komite == 'kosong') {
		echo "<script language=\"Javascript\">\n";
echo "window.alert('Error, Pastikan semua kolom terisi, silakan ulangi proses!');";
echo "</script>";
echo "<script>javascript:history.back()</script>";
} else if($username2 != NULL){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, NIK sudah tersedia di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
} else if($inisial2 != NULL){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Inisial sudah tersedia di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}
else {
if(empty($file_name)){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Foto belum diunggah, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}
else if(file_exists($direktori)){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Error, Foto yang anda unggah sudah ada di database, silakan ulangi proses!');";
	echo "</script>";
	echo "<script>javascript:history.back()</script>";
}
else {
	move_uploaded_file($source,$direktori);	
	rename($direktori, "foto/".$username.".jpg");
	$direktori=$username.".jpg";
	mysql_query("insert into user(username,password,fullname,inisial,id_level,id_cg,id_jabatan,email,ext,foto,status) values 
	('$username','$username','$fullname','$inisial','$id_level','$id_cg','$id_jabatan','$email','$ext','$direktori',1)") or die(mysql_error());	
	mysql_query("insert into agreement_opl(user,pemeriksa,komite) values 
	('$username','$pemeriksa','$komite')") or die(mysql_error());
			echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Proses tambah data user berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
}
}
?>