<?php
error_reporting(0);
include"koneksi.php";
$no_opl_temp=$_GET['no_opl_temp'];
$query = "select * from detail_opl where no_opl_temp='$no_opl_temp'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
while ($row=mysql_fetch_array($result)){ //untuk menghapus foto di dalam folder
$folder="foto_opl/$row[gambar]";
unlink($folder);
}
mysql_query("delete from detail_opl where no_opl_temp='$no_opl_temp'");
mysql_query("delete from opl where no_opl_temp='$no_opl_temp'")
		or die(mysql_error());
		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Sukses, OPL reject berhasil dihapus');";
		echo "</script>";
		echo"<meta http-equiv='refresh' content='0;url=daftar_opl_reject.php'>";

?>