<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php"
?>
<form action='cek_input_problem.php' method='POST' enctype='multipart/form-data'>
<table align='center'> 
	<tr>
		<td><font face='calibri'><b>Tema</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><input type='text' name='judul' required></td>
	</tr>
	<tr>
		<td><font face='calibri'><b>Pertanyaan</b></font>&nbsp;&nbsp;&nbsp;</td>
		<td><textarea name='isi' required></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='submit' value='Simpan' class='btn btn-primary btn-small'>
		<input type='reset' value='Ulangi' class='btn btn-danger btn-small'></td>
	</tr>
</table>
</form>

</div>

</div>
	<?php
	include "footer.php";
?>
</div>
</html>
</div>