<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$tema_problem=$_GET['tema_problem'];

$query = "SELECT * FROM problem JOIN user ON (user.username = problem.username)
where problem.tema_problem='$tema_problem'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
while($row = mysql_fetch_array($result)){
	$id_problem=$row['id_problem'];
	$fullname=$row['fullname'];
	$isi_problem=$row['isi_problem'];
}

$query2 = "SELECT * FROM komentar JOIN user ON (user.username = komentar.username)
JOIN problem ON (komentar.id_problem = problem.id_problem)
where problem.tema_problem='$tema_problem'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());


echo"
<center><font face='calibri'><b>DETAIL PROBLEM</b></font></center>
<center><font face='calibri'><b>$tema_problem</b></font></center><hr/>
<table>
<tr>
	<td>
		<font face='calibri'><b>$fullname</b>&nbsp&nbsp&nbsp</font>
	</td>
	<td>
		<font face='calibri'>:&nbsp</font>
	</td>
	<td>
		<font face='calibri'>$isi_problem</font>
	</td>
</tr>
</table>
<hr/>
";
while($row2 = mysql_fetch_array($result2)){
echo"
<table>
<tr>
	<td>
		<font face='calibri'><b>$row2[fullname]</b>&nbsp&nbsp&nbsp</font>
	</td>
	<td>
		<font face='calibri'>:&nbsp</font>
	</td>
	<td>
		<font face='calibri'>$row[isi_komentar]</font>
	</td>
</tr>
</table>
";
}
?>
<form action='cek_input_komentar.php?id_problem=$id_problem' method='POST' enctype='multipart/form-data'>
<table> 
	<tr>
		<td><font face='calibri' color='grey'><big>Komentar :</big></font><br/></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td><textarea name='komentar' required></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan' class='btn btn-primary btn-small'></td>
	</tr>
</table>
</form>

<?php
	include "footer.php";
?>
</div>
</html>