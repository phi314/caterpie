<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);
session_start();
$no_opl_temp=$_GET['no_opl_temp'];
$username2=$_SESSION['username'];
?>
<head>
<script language="JavaScript" type="text/JavaScript">
	function hps(x)
	{
		 z = x ;
		document.getElementById("tes"+z).innerHTML = "";
	}
</script>
<script language="JavaScript" type="text/JavaScript">
	counter = 0;
	function tambah()
	{
		counterNext = counter + 1;
		counterId = counter + 1;
		document.getElementById("input"+counter).innerHTML = 
		"<div id=\"tes"+counterNext+"\"><table align='center'><tr><td></td><td align='right'><input type='button' onClick='hps(0)' value='x' class='btn btn-danger btn-small'></td></tr><tr><td><font face='calibri'><b>Karyawan</b></font>&nbsp;&nbsp;&nbsp;</td><td><select name='user[]'><?php include"koneksi.php"; $query23 = "SELECT * FROM user WHERE NOT EXISTS (SELECT * FROM akses_opl WHERE user.username = akses_opl.username and akses_opl.no_opl_temp='$no_opl_temp')  and user.id_level=1 and user.username != '$username2'"; $result23 = mysql_query($query23); while($row23=mysql_fetch_array($result23)){  echo"<option value='$row23[username]'>$row23[fullname]</option>"; }?></select></td></tr></table></div><div id=\"input"+counterNext+"\"></div>";
		counter++;
	}
</script>
</head>
<div class="container">
<?php
error_reporting(0);
include"koneksi.php";
include"header.php";
include"setting_level.php";
?>

<a href='detail_opl.php?no_opl_temp=<?php echo"$no_opl_temp"; ?>'><input type='submit' value='Kembali' class='btn btn-info btn-small'></a>
<?php
echo"
<center><font face='calibri'><b>SETTING HAK AKSES OPL</b></font></center><br/>
<form action='cek_setting_akses.php' method='POST' enctype='multipart/form-data'>
<div id='tes0'>
<table align='center'> 
<tr>
		<td></td>
		<td align='right'><input type='button' onClick='hps(0)' value='x' class='btn btn-danger btn-small'></td>
	</tr>
<tr>
		<td><font face='calibri'><b>Karyawan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><select name='user[]'>";
                    $query22 = "SELECT * FROM user WHERE NOT EXISTS (SELECT * FROM akses_opl 
					WHERE user.username = akses_opl.username and akses_opl.no_opl_temp='$no_opl_temp')  
					and user.id_level=1 and user.username != '$username2'";
                    $result22 = mysql_query($query22);
                    while($row22=mysql_fetch_array($result22))
                    {

                        echo"<option value='$row22[username]'>$row22[fullname]</option>";
                    }
               
		echo"</select></td>
	</tr>
	<tr><td></td><td><input type='hidden' name='no_opl_temp' value='$no_opl_temp'></td></tr>
</table>";?>
</div>
<div id="input0">
</div>

	<center><input onClick="tambah()" value="+ Tambah User" class='btn btn-success btn-small' type="button" ><br/><br/><br/>
	<input type='submit' value='Simpan Konfigurasi' class='btn btn-primary btn-small'></center><br/>
	
<?php
echo"
</form>";
?>
<hr/>

<table class="table table-hover table-condensed table-bordered">
	<tbody>
		<tr class='warning'>
			<td><center><small><font face='calibri'><b>Nama</b></font></small></center></td>
			<td><center><small><font face='calibri'><b>Circle Group / Departmen</b></font></small></center></td>
			<td colspan="2"><small><center><font face='calibri'><b>Menu</b></font></center></small></td>
		</tr>
	<?php
	$query = "SELECT * FROM akses_opl
join user on (user.username=akses_opl.username)	
join circle_group on (circle_group.id_cg=user.id_cg)
join sub_dep on (sub_dep.id_sub_dep=circle_group.id_sub_dep)
join departmen on (departmen.id_dep=sub_dep.id_dep)
where akses_opl.no_opl_temp='$no_opl_temp' order by user.fullname asc";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());

	while ($row=mysql_fetch_array($result)) {
	$nama=$row['fullname'];
	echo"
	<tr class='info'>
		<td><font face='calibri'>$row[fullname]</font></td>
		<td><font face='calibri'>$row[nama_cg] / $row[nama_dep]</font></td>
		<td><center><font face='calibri'><a href='hapus_setting_akses.php?no_opl_temp=$row[no_opl_temp]&username=$row[username]'><span class='badge badge-important'>Hapus</span></a></font></center></td>
	</tr>
	";
	} 
	if ($nama == NULL) {
		echo"<tr class='info'><td colspan='11'><center><font face='calibri'>Anda belum mengatur hak akses pada opl</font></center></td></tr>";
	} else {
		echo"";
	}
	?>
	</tbody>
</table>
</div>
	</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>