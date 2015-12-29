<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
?>
<form action='hasil_cari_forum.php' method='GET'>
			<table>
			<tr>
				<td>
					<label for="search"></label>
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="search" id="search"/> 
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td>
					<input type='submit' class='btn btn-primary' value='Cari Data'>
				</td>
			</tr>
			</table>
</form>

<table class="table table-hover table-condensed table-bordered">				
<?php echo "<tbody>
<font face='calibri' color='grey'><big>PROBLEM</big></font><br/>
<tr class='warning'>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tema Problem</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Pembuat</b></center> </font></small></td>
  </tr>
";
$query ="SELECT * from problem JOIN user ON (user.username = problem.username)";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());

while ($row=mysql_fetch_array($result)) {
$tgl = $row['tgl_pembuatan'];
$tema_problem = $row['tema_problem'];
echo "
<tr class='info'>
	<td ><small><font face='calibri'>$row[tgl_pembuatan]</font></small></td>
	<td ><a href='detail_problem.php?tema_problem=$tema_problem'><small><font face='calibri'>$row[tema_problem]</font></small></a></td>
	<td ><small><font face='calibri'>$row[fullname]</font></small></td>
</tr>";
} 
if ($tgl == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data nilai</font></center></td></tr>";
} else {echo"";}
?></tbody>
</table>
<a href="forum_problem.php"><input type='button' class='btn btn-success' value='Ajukan Pertanyaan'></a>
<br/><br/>
<?php
	include "footer.php";
?>
</div>
</html>