<?php
include"koneksi.php";
error_reporting(0);
session_start();
$username=$_SESSION['username'];
$tema_problem=mysql_real_escape_string($_POST['judul']);
$isi_problem=$_POST['isi'];
date_default_timezone_set('Asia/Jakarta');
$tgl_pembuatan = date('Y-m-d H:i:s');
$t=0;
$f=1;

$query="select * FROM problem where tema_problem='$tema_problem'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
$row=mysql_fetch_array($result);
$judul2=$row['tema_problem'];

if ($judul2 != NULL) {
echo "<script language=\"Javascript\">\n";
echo "window.alert('Error, Tema problem sudah tersedia di database, silakan ulangi proses!');";
echo "</script>";
echo "<script>javascript:history.back()</script>";
}
else if ($tema_problem == NULL or $isi_problem == NULL) {
echo "<script language=\"Javascript\">\n";
echo "window.alert('Error, Terdapat kolom yang belum diisi, silakan ulangi proses!');";
echo "</script>";
echo "<script>javascript:history.back()</script>";
} else {
	mysql_query("insert into problem(tgl_pembuatan,tema_problem,isi_problem,username) values 
	('$tgl_pembuatan','$tema_problem','$isi_problem',$username)") or die(mysql_error());	
		echo "<script language=\"Javascript\">\n";
echo "window.alert('Sukses, Proses pengajuan pertanyaan berhasil');";
echo "</script>";
echo"<meta http-equiv='refresh' content='0;url=forum_opl.php'>";
}
?>
