<html lang="en">
<head>
	<meta http-equiv=refresh content=60>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="js/jquery-ui.css" />
	<script src="js/jquery-1.8.3.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/load-metro.js"></script>
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/tables.js"></script>
	<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
	<script>
		$(function(){
			$( "#search" ).autocomplete({
				source: "data.php",
				minLength:1,
			});
		});
	</script>
	
	<script>
		$(function(){
			$( "#searchnk" ).autocomplete({
				source: "datank.php",
				minLength:1,
			});
		});
	</script>
</head>
<?php
error_reporting(0);
if (!isset($_SESSION['username'])){
//---------------------------------------------------------------------------GUEST---------------------------
include"koneksi.php";

//pagination ini salah tidak dihapus karena jika dihapus bermasalah
$per_hal = 2000000000;
$queryCount = "SELECT COUNT(opl.id) AS numrows FROM opl join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status != 7 and opl.status != 8";
$resultCount = mysql_query($queryCount) or die ('error, query failed.'.mysql_error());
$rowCount=mysql_fetch_array($resultCount);
$jum=$rowCount['numrow'];
$halaman=ceil($ju/$per_hal);
$page = (isset($_GET['page']))?(int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
//echo "Jumlah record :".$jum."<br/>";
//echo "Jumlah halaman :".$halaman."<br/>";

//Creator Status 
$queryjml = "SELECT count(opl.tema_opl) as jml FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status != 7 and opl.status != 8";
$resultjml = mysql_query($queryjml) or die ('error, query failed.'.mysql_error());
while ($rowjml=mysql_fetch_array($resultjml)) {
$jml=$rowjml['jml'];
}
if ($jml == NULL) {
		$jml2=0;
} else {
	$jml2=$jml;
}

$queryjml2 = "SELECT count(opl.tema_opl) as jml2 FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status = 8";
$resultjml2 = mysql_query($queryjml2) or die ('error, query failed.'.mysql_error());
while ($rowjml2=mysql_fetch_array($resultjml2)) {
$jml22=$rowjml2['jml2'];
}
if ($jml22 == NULL) {
		$jml222=0;
} else {
	$jml222=$jml22;
}



$query = "SELECT * FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where (opl.status != 7 and opl.status != 8)
ORDER by opl.id desc LIMIT $start, $per_hal";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>	

<ul class="nav nav-pills">
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>DASHBOARD OPL <small><small><span class='badge badge-warning'><?php echo"$jml2"; ?></span></small></small></big></big></big></font></a></li>
  <li role="presentation"><a href='dashboard_reject.php'><font face='calibri'><big>OPL REJECT <small><small><span class='badge badge-success'><?php echo"$jml222"; ?></span></small></small></big></font></a></li>
   </ul>
			<table id="tampilpembuat" class="table table-hover table-condensed table-bordered">
				<?php echo "<thead>
<tr bgcolor='Ivory'>
					<td><small><font face='calibri'><center><b>Pembuat</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tema OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Jenis OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Status</b></center></font></small></td>
  </tr></thead><tbody>
";

while ($row=mysql_fetch_array($result)) {
$no_opl_temp=$row['no_opl_temp'];
$jenis_opl=$row['jenis_opl'];
$status_opl=$row['status'];
if ($jenis_opl == 1){
	$jenis='Pengetahuan Dasar';
} else if ($jenis_opl == 2){
	$jenis='Troubleshooting';
} else {
	$jenis ='Improvement';
}

if ($status_opl == 1){
	$status='Menunggu Atasan';
} else if ($status_opl == 2){
	$status='Koreksi Atasan';
} else if ($status_opl==3){
	$status='Menunggu Komite';
} else if ($status_opl==4){
	$status='Koreksi Komite';
} else if ($status_opl==5){
	$status='Menunggu Koordinator';
} else if ($status_opl==6){
	$status='Koreksi Koordinator';
} else if ($status_opl==7){
	$status='Selesai';
} else {
	$status='Reject';
}
echo "
<tr class='info'>
<td><center><img src='foto/$row[foto]' width='40px'><br/><small><font face='calibri'>$row[fullname]</font></small></center></td>
<td><small><center><font face='calibri'>$row[no_opl_temp]</font></center></small></td>
<td ><small><font face='calibri'><center>$row[tgl_pembuatan]</center></font></small></td>
<td ><small><font face='calibri'>$row[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td>
<td ><small><font face='calibri'>$status</font></td></small></tr>";
$no++;
} 
	if ($no_opl_temp == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
} else {echo"";}
?>
</tbody>
</table>

<!-- Pagination -->
<!--<a href="?page=<?php echo $page -1 ?>"> < </a>		-->	
<?php
echo"<center>";
for($x=1;$x<=$halama;$x++){
	?>
	<b><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></b>
	<?php
}
?>

<?php
echo"</center><br><br><br><hr>";
?>
<!-- --------------------------------------SCORE KARYAWAN------------------------------------------ -->
<?php
$no=1;
$tgl_skrg = date('Y-m-d H:i:s');
	$query = "SELECT user.fullname,circle_group.nama_cg, COUNT(user.fullname) AS jumlah FROM OPL 
	join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
	join user on (user.username=agreement_opl.user)
	join circle_group on (user.id_cg = circle_group.id_cg)
	where opl.status = 7 and opl.tgl_approve_koordinator <= '$tgl_skrg'
	GROUP BY user.fullname 
	ORDER BY jumlah DESC";
	$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>

<table id="tampiluser" class="table table-hover table-condensed table-bordered">				
<?php echo "<thead>
<font face='calibri' color='grey'><big>NILAI KARYAWAN</big></font><br/>
<tr bgcolor='Ivory'>
					<td><small><font face='calibri'><center><b>Nomor</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nama Karyawan</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nama Circle Group</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nilai</b></center> </font></small></td>
  </tr></thead>
";
while ($row=mysql_fetch_array($result)) {
$nama_karyawan=$row['fullname'];

echo "
<tr class='info'>
	<td ><small><font face='calibri'>$no</font></small></td>
	<td ><small><font face='calibri'>$row[fullname]</font></small></td>
	<td ><small><font face='calibri'>$row[nama_cg]</font></small></td>
	<td ><small><font face='calibri'>$row[jumlah]</font></small></td>
</tr>";
$no++;
} 
if ($nama_karyawan == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data nilai</font></center></td></tr>";
} else {echo"";}
?>
</table>
<?php
echo"<br/><br/></center>";
//---------------------------------------------------------------------------CREATOR----------------------------
} else  if (($_SESSION['id_level'])==1){ 
require("koneksi.php");
$username=$_SESSION['username'];
$userquery = "
select * from user where username='$username'";
$userresult = mysql_query($userquery) or die ('error, query failed.'.mysql_error());
while ($userrow=mysql_fetch_array($userresult)) {  
$fullname=$userrow['fullname'];
$foto=$userrow['foto'];
}
		$queryA = "select Count(no_opl_temp) as A from opl 
		join agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
		join user on (user.username=agreement_opl.user)
		where opl.jenis_opl=1 and agreement_opl.user='$username' and opl.status='7'";
		$resultA = mysql_query($queryA) or die ('error, query failed.'.mysql_error());
		while ($rowA=mysql_fetch_array($resultA)) {  
			$A=$rowA['A'];
		}
		$queryB = "select Count(no_opl_temp) as B from opl 
		join agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
		join user on (user.username=agreement_opl.user)
		where opl.jenis_opl=2 and agreement_opl.user='$username' and opl.status='7'";
		$resultB = mysql_query($queryB) or die ('error, query failed.'.mysql_error());
		while ($rowB=mysql_fetch_array($resultB)) {  
			$B=$rowB['B'];
		}
		$queryC = "select Count(no_opl_temp) as C from opl 
		join agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
		join user on (user.username=agreement_opl.user)
		where opl.jenis_opl=3 and agreement_opl.user='$username' and opl.status='7'";
		$resultC = mysql_query($queryC) or die ('error, query failed.'.mysql_error());
		while ($rowC=mysql_fetch_array($resultC)) {  
			$C=$rowC['C'];
		}
		$queryD = "SELECT pemeriksa, komite FROM agreement_opl WHERE user='$username'";
		$resultD = mysql_query($queryD) or die ('error, query failed.'.mysql_error());
		while ($rowD=mysql_fetch_array($resultD)) {
			$pemeriksa=$rowD['pemeriksa'];
			$komite=$rowD['komite'];
		}
		$queryZ = "SELECT fullname FROM user WHERE username='$pemeriksa'";
		$resultZ = mysql_query($queryZ) or die ('error, query failed.'.mysql_error());
		while ($rowZ=mysql_fetch_array($resultZ)) {
			$fullname_pemeriksa=$rowZ['fullname'];
		}
		$queryY = "SELECT fullname FROM user WHERE username='$komite'";
		$resultY = mysql_query($queryY) or die ('error, query failed.'.mysql_error());
		while ($rowY=mysql_fetch_array($resultY)) {
			$fullname_komite=$rowY['fullname'];
		}

?>
<div class="row">
<div class="span3">
<center><img src='foto/<?php echo"$foto";?>' width='190px'><br/><br/>
<a href='ganti_foto.php'><input type='submit' class='btn btn-small btn-info' value='Ubah Foto Profil'></a></center><br/>
			<ul class="nav nav-list well">
				<li class="nav-header">
					<font face='calibri'><big>Dashboard OPL</big></font> 
				</li>
				<li>
					<table  class="table table-hover table-condensed table-bordered">
						<tr class='success'>
							<td><font face='calibri'><b>Pengetahuan Dasar</b></font> </td><td> <?php echo"<a href='detail_jumlah.php?stat=1'><b>$A</b></a>"; ?> </td>
						</tr>
						<tr class='success'>
							<td><font face='calibri'><b>Troubleshooting</b></font> </td><td> <?php echo"<a href='detail_jumlah.php?stat=2'><b>$B</b></a>"; ?></td>
						</tr>
						<!--<tr class='success'>
							<td><font face='calibri'><b>Improvement</b></font> </td><td> <?php echo"<a href='detail_jumlah.php?stat=3'><b>$C</b></a>"; ?></td>
						</tr>-->
					</table>
				</li>
				<?php 
				if ($fullname_pemeriksa == NULL or $fullname_komite == NULL) {
					$fullname_pemeriksa2="Belum di setting";
					$fullname_komite2="Belum di setting";
				} else {
					$fullname_pemeriksa2=$fullname_pemeriksa;
					$fullname_komite2=$fullname_komite;
				}
				?>
				<li>
					<font face='calibri'>Atasan &nbsp;:&nbsp; <?php echo"<b>$fullname_pemeriksa2</b>"; ?></font>
				</li>
				<li>
					<font face='calibri'>Komite &nbsp;:&nbsp; <?php echo"<b>$fullname_komite2</b>"; ?></font>
				</li>
				<li class="nav-header">
					<font face='calibri'><big>Pengaturan</big></font>
				</li>
				<li>
					<a href="edit_password.php"><font face='calibri'>Ubah Kata Sandi</font></a>
				</li>
				<li class="nav-header" >
				<?php
				include "cu.php";
				?>
			</ul>
</div>
<div class="span9">

		<form action='hasil_cari_opl.php' method='GET'>
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
		
			
			<?php
			$queryjml = "
select count(*) as jml from akses_opl where username='$username' and nilai=0";
$jmlresult = mysql_query($queryjml) or die ('error, query failed.'.mysql_error());
while ($rowjml=mysql_fetch_array($jmlresult)) {  
$jml=$rowjml['jml'];
}
$wsquery = "select * from akses_opl where username='$username' and nilai=0";
$wsresult = mysql_query($wsquery) or die ('error, query failed.'.mysql_error());
while ($wsrow=mysql_fetch_array($wsresult)) {  
$wstn=$wsrow['username'];
}
if ($wstn==NULL) {echo"";} else {ECHO"
		<div class='alert alert-success'>
				<h4>
					Pemberitahuan
				</h4><small>Anda mendapat $jml sharingan OPL, klik <a href='sharing_opl.php'>disini</a> untuk detail OPL.</small>
			</div>";}
			
$querya1 = "SELECT count(opl.tema_opl) as b FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and (opl.status != 8 and opl.status !=7)";
$resulta1 = mysql_query($querya1) or die ('error, query failed.'.mysql_error());	
while ($rowa1=mysql_fetch_array($resulta1)) {
$jmla1=$rowa1['b'];
}
if ($jmla1 == NULL) {
		$jmla11=0;
} else {
	$jmla11=$jmla1;
}

$querya2 = "SELECT count(opl.tema_opl) as c FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and opl.status = 8";
$resulta2 = mysql_query($querya2) or die ('error, query failed.'.mysql_error());	
while ($rowa2=mysql_fetch_array($resulta2)) {
$jmla2=$rowa2['c'];
}
if ($jmla2 == NULL) {
		$jmla22=0;
} else {
	$jmla22=$jmla2;
}

$querya3 = "SELECT count(opl.tema_opl) as d FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where agreement_opl.user='$username' and (opl.status = '2' or opl.status = '4' or opl.status = '6')";
$resulta3 = mysql_query($querya3) or die ('error, query failed.'.mysql_error());	
while ($rowa3=mysql_fetch_array($resulta3)) {
$jmla3=$rowa3['d'];
}
if ($jmla3 == NULL) {
		$jmla33=0;
} else {
	$jmla33=$jmla3;
}

$querya4 = "select count(opl.no_opl_temp) as e from akses_opl
join opl on (opl.no_opl_temp=akses_opl.no_opl_temp)
where akses_opl.username='$username'";
$resulta4 = mysql_query($querya4) or die ('error, query failed.'.mysql_error());	
while ($rowa4=mysql_fetch_array($resulta4)) {
$jmla4=$rowa4['e'];
}
if ($jmla4 == NULL) {
		$jmla44=0;
} else {
	$jmla44=$jmla4;
}
$querya7 = "SELECT count(opl.tema_opl) as h FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and opl.status = 7";
$resulta7 = mysql_query($querya7) or die ('error, query failed.'.mysql_error());	
while ($rowa7=mysql_fetch_array($resulta7)) {
$jmla7=$rowa7['h'];
}
if ($jmla7 == NULL) {
		$jmla77=0;
} else {
	$jmla77=$jmla7;
}
?>
			
			<ul class="nav nav-pills">
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>DASHBOARD OPL <small><small><span class='badge badge-warning'><?php echo"$jmla11"; ?></span></small></small></big></big></big></font></a></li>
    <li role="presentation" ><a href="daftar_opl_reject.php"><font face='calibri'><big>OPL REJECT <small><small><span class='badge badge-success'><?php echo"$jmla22"; ?></span></small></small></big></font></a></li>
	<li role="presentation" ><a href="daftar_opl_koreksi.php"><font face='calibri'><big>OPL KOREKSI <small><small><span class='badge badge-success'><?php echo"$jmla33"; ?></span></small></small></big></font></a></li>
	<li role="presentation" ><a href="daftar_opl_sharing.php"><font face='calibri'><big>SHARING OPL <small><small><span class='badge badge-success'><?php echo"$jmla44"; ?></span></small></small></big></font></a></li>
  <li role="presentation" ><a href='daftar_opl_selesai.php'><font face='calibri'><big>OPL SELESAI <small><small><span class='badge badge-success'><?php echo"$jmla77"; ?></span></small></small></big></font></a></li>
	</ul>
  <?php
  $rowPerPage = 6;
$pageNum = 1;
if(!empty($_GET['page']))
{
$pageNum = $_GET['page'];
}
$offset = ( $pageNum - 1) * $rowPerPage;
//Creator Status 
$query = "SELECT * FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and (opl.status != 8 and opl.status !=7)
ORDER by opl.id desc LIMIT $offset, $rowPerPage";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());
?>	
			<table class="table table-hover table-condensed table-bordered">
				
				<?php echo "<tbody>
<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tema OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Jenis OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Status</b></center></font></small></td>
  </tr>
";
while ($row=mysql_fetch_array($result)) {
$no_opl_temp=$row['no_opl_temp'];
$jenis_opl=$row['jenis_opl'];
$status_opl=$row['status'];
if ($jenis_opl == 1){
	$jenis='Pengetahuan Dasar';
} else if ($jenis_opl == 2){
	$jenis='Troubleshooting';
} else {
	$jenis ='Improvement';
}

if ($status_opl == 1){
	$status='Menunggu Atasan';
} else if ($status_opl == 2){
	$status='Koreksi Atasan';
} else if ($status_opl==3){
	$status='Menunggu Komite';
} else if ($status_opl==4){
	$status='Koreksi Komite';
} else if ($status_opl==5){
	$status='Menunggu Koordinator';
} else if ($status_opl==6){
	$status='Koreksi Koordinator';
} else if ($status_opl==7){
	$status='Selesai';
} else {
	$status='Reject';
}
echo "
<tr class='info'>
<td><small><center><font face='calibri'><a href='detail_opl.php?no_opl_temp=$row[no_opl_temp]'>$row[no_opl_temp]</a></font></center></small></td>
<td ><small><font face='calibri'><center>$row[tgl_pembuatan]</center></font></small></td>
<td ><small><font face='calibri'>$row[tema_opl]</font></small></td>
<td ><small><font face='calibri'>$jenis</font></small></td>
<td ><small><font face='calibri'>$status</font></td></small></tr>";
$no++;
} 
	if ($no_opl_temp == NULL) {
	echo"<tr class='info'><td colspan='6'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
} else {echo"";}
?></tbody> 
			</table>
			
<?php
$query = "SELECT count(opl.no_opl_temp) AS numrows FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where user.username='$username' and (opl.status != 8 and opl.status !=7)";
$result = mysql_query($query) or die ('Error, query failed. ' .mysql_error());
$row = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
$maxPage = ceil($numrows/$rowPerPage);
$nextLink = '&nbsp;';
if($maxPage > 1)
{
$nav .="<form id=\"FNav\" name=\"FNav\" method=\"get\" action=\"\" align=\"center\">";
$nav .="<br/>&nbsp;&nbsp;<select name=\"page\" id=\"page\">";
for ($page = 1; $page <= $maxPage; $page++)
{
if($pageNum==$page)
{
$nav .="<option selected>$page</option>";
}else
{
$nav .="<option>$page</option>";
}
}
$nav .= "</select>";
$nav .= " &nbsp;&nbsp;<input type=\"submit\"name=\"btn\" value=\"Proses\" class=\"btn btn-info\" />";
$nav .= "</form>";
}
echo '<p>'.$nav.'</p>';
mysql_free_result($result);
?>



		
<?php
//------------------------------------------------------------------------Pemeriksa-------------------------------------------------
$queryG1 = "SELECT * FROM agreement_opl WHERE pemeriksa='$username'";
$resultG1 = mysql_query($queryG1) or die ('error, query failed.'.mysql_error());	
while ($rowG1=mysql_fetch_array($resultG1)) 
	{	
		$user11=$rowG1['user'];
	}
if($user11 == NULL)
{
echo"";			
} else	{
	
$querya5 = "select count(opl.no_opl_temp) as f from agreement_opl
join opl on (opl.id_agreement=agreement_opl.id_agreement)
where agreement_opl.pemeriksa='$username' and opl.status=1";
$resulta5 = mysql_query($querya5) or die ('error, query failed.'.mysql_error());	
while ($rowa5=mysql_fetch_array($resulta5)) {
$jmla5=$rowa5['f'];
}
if ($jmla5 == NULL) {
		$jmla55=0;
} else {
	$jmla55=$jmla5;
}
	
$queryG = "SELECT * FROM agreement_opl WHERE pemeriksa='$username'";
$resultG = mysql_query($queryG) or die ('error, query failed.'.mysql_error());	
?>
	<ul class="nav nav-pills">
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>DASHBOARD ATASAN <small><small><span class='badge badge-warning'><?php echo"$jmla55"; ?></span></small></small></big></big></big></font></a></li>
     </ul>
	<table class="table table-hover table-condensed table-bordered">
		<?php 
	
	echo"<tr class='warning'>
					<td><small><font face='calibri'><center><b>Pembuat</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tema</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Menu</b></center></font></small></td>
		</tr>";	
	while ($rowG=mysql_fetch_array($resultG)) 
	{	
		$user=$rowG['user'];
		
		$queryH = "SELECT fullname FROM user WHERE username='$user'";
		$resultH = mysql_query($queryH) or die ('error, query failed.'.mysql_error());
		while ($rowH=mysql_fetch_array($resultH)) 
		{
			$user1=$rowH['fullname'];
			
			$query1 = "SELECT * FROM agreement_opl WHERE user='$user'";
			$result1 = mysql_query($query1) or die ('error, query failed.'.mysql_error());
		while ($row1=mysql_fetch_array($result1)) 
		{
			$id_agreement=$row1['id_agreement'];
			$query2 = "SELECT * FROM opl WHERE id_agreement='$id_agreement' AND status=1 order by id desc";
			$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());
		while ($row2=mysql_fetch_array($result2)) 
		{
			$no_opl_temp2323=$row2['no_opl_temp'];
			$tema_opl=$row2['tema_opl'];
			echo"
		<tr class='info'>
					<td><small><font face='calibri'><center>$user1</center></font></small></td>
					<td><small><font face='calibri'><center>$no_opl_temp2323</center></font></small></td>
					<td><small><font face='calibri'><center>$tema_opl</center></font></small></td>
					<td><center><a href='detail_opl_pemeriksa.php?no_opl_temp=$no_opl_temp2323'><span class='badge badge-info'>Lihat</span></a></center></td>
		</tr>
		";
		
		}
		}
		}	
	}
	if ($no_opl_temp2323 == NULL) 
	{
		echo"<tr class='info'><td colspan='4'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
	} else 
	{
		echo"";
	}
		
		?>
	</table>	
<?php
}


//-------------------------------------------------------------------------komite--------------------------------------------------------
$queryI2 = "SELECT * FROM agreement_opl WHERE komite='$username'";
$resultI2 = mysql_query($queryI2) or die ('error, query failed.'.mysql_error());	
while ($rowI2=mysql_fetch_array($resultI2)) 
	{	
		$userI2=$rowI2['user'];
	}
if($userI2 == NULL)
{
echo"";			
} else	{

$querya6 = "select count(opl.no_opl_temp) as g from agreement_opl
join opl on (opl.id_agreement=agreement_opl.id_agreement)
where agreement_opl.komite='$username' and opl.status=3";
$resulta6 = mysql_query($querya6) or die ('error, query failed.'.mysql_error());	
while ($rowa6=mysql_fetch_array($resulta6)) {
$jmla6=$rowa6['g'];
}
if ($jmla6 == NULL) {
		$jmla66=0;
} else {
	$jmla66=$jmla6;
}

$queryI = "SELECT * FROM agreement_opl WHERE komite='$username'";
$resultI = mysql_query($queryI) or die ('error, query failed.'.mysql_error());	
?>
<ul class="nav nav-pills">
  <li role="presentation" class="active"><a><font face='calibri'><big><big><big>DASHBOARD KOMITE <small><small><span class='badge badge-warning'><?php echo"$jmla66"; ?></span></small></small></big></big></big></font></a></li>
     </ul>
	<table class="table table-hover table-condensed table-bordered">
		<?php
		echo"<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nama</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tema</b></center></font></small></td>
					<td><center>Menu</center></td>
		</tr>";
		
	while ($rowI=mysql_fetch_array($resultI)) 
	{
		$userr=$rowI['user'];
		
		$queryJ = "SELECT fullname FROM user WHERE username='$userr'";
		$resultJ = mysql_query($queryJ) or die ('error, query failed.'.mysql_error());
		while ($rowJ=mysql_fetch_array($resultJ)) 
		{
			$userr1=$rowJ['fullname'];
			
			$query3 = "SELECT * FROM agreement_opl WHERE user='$userr'";
			$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());
		while ($row3=mysql_fetch_array($result3)) 
		{
			$id_agreement=$row3['id_agreement'];
			$query4 = "SELECT * FROM opl WHERE id_agreement=$id_agreement AND status=3";
			$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());
		while ($row4=mysql_fetch_array($result4)) 
		{
			$no_opl_temp2=$row4['no_opl_temp'];
			$tema_opl2=$row4['tema_opl'];
			echo"
		<tr class='info'>
					<td><small><font face='calibri'><center>$userr1</center></font></small></td>
					<td><small><font face='calibri'><center>$no_opl_temp2</center></font></small></td>
					<td><small><font face='calibri'><center>$tema_opl2</center></font></small></td>
					<td><center><a href='detail_opl_komite.php?no_opl_temp=$no_opl_temp2'><span class='badge badge-info'>Lihat</span></a></center></td>
		</tr>
		";
		}
		}
		}
	}
	if ($no_opl_temp2 == NULL) 
	{
		echo"<tr class='info'><td colspan='4'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
	} else 
	{
		echo"";
	}
		
		?>
	</table>
<?php
}
?>

	</div>
</div>

<?php
echo"<br/>";
}
//---------------------------------------------------------------------------KOORDINATOR---------------------------
else if (($_SESSION['id_level'])==2) {
require("koneksi.php");	
include"action_opl_koordinator.php";	
}
//---------------------------------------------------------------------------ADMIN-------------------------
else  if (($_SESSION['id_level'])==3) {
include"koneksi.php";
include"kelola_user.php";
}
?>