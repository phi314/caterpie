<script language="Javascript1.2">
  <!--
  function printpage() {
  window.print();
  }
  //-->
</script>
<?php 
error_reporting(0);
require("koneksi.php");
session_start();
$no_opl_temp=$_GET['no_opl_temp'];

$query21 = "SELECT * FROM opl
join agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
join user on (user.username=agreement_opl.user) 
where opl.no_opl_temp='$no_opl_temp'";
$result21 = mysql_query($query21) or die ('error, query failed.'.mysql_error());
while ($row21=mysql_fetch_array($result21)) {
$username=$row21['username'];
}

$query = "SELECT * FROM OPL 
where no_opl_temp='$no_opl_temp'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());

$query2 = "SELECT * FROM user
join agreement_opl on (agreement_opl.user=user.username)
where user.username='$username'";

$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());

echo"<body onload='printpage()'>
<table align='center' border='1' width='1000'>
	<tr>
		<td width='220px'>
			<table border='0' align='center'>
				<tr>
					<td><center><img src='img/logokalbe.png' width='200px'></center></td>
				</tr>
				<tr>
					<td><center>PT. Kalbe Morinaga Indonesia</center></td>
				</tr>
			</table>
		</td>
		<td>
			<table border='0' align='center'>
				<tr>
					<td><center>FORM</center></td>
				</tr>
				<tr>
					<td>ONE POINT LESSON</td>
				</tr>
			</table>
		</td>
		<td>
			<table border='0'>
				<tr>
					<td>
						<table border='0'>
							<tr>
								<td>No Dok : FR/BPS/OPL/025</td>
							</tr>
							<tr>
								<td>No Rev : 00</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table border='0'>
							<tr>
								<td>Tgl Berlaku : 1 Maret 2014</td>
							</tr>
							<tr>
								<td>Halaman : 1 dari 1</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			";
			while ($row=mysql_fetch_array($result)) {
			$jenis_opl=$row['jenis_opl'];
			if ($jenis_opl==1){
				$jenis_opl_2="Pengetahuan Dasar";
			} else if ($jenis_opl==2){
				$jenis_opl_2="Troubleshooting";
			} else {
				$jenis_opl_2="Improvement";
			}
			echo"
			Nomor OPL : $row[no_opl]<br/>
			Tanggal OPL : $row[tgl_pembuatan]<br/>
			Tema : $row[tema_opl]<br/>
			Jenis OPL : $jenis_opl_2
			"; 
			
		echo"</td>
		<td>
			<table border='1' align='center' width='80%'>
				<tr>
					<td><center>Dibuat</center></td>
					<td><center>Diperiksa</center></td>
					<td><center>Disetujui</center></td>
				</tr>
				<tr>";
				while ($row2=mysql_fetch_array($result2)) {
				$pemeriksa=$row2['pemeriksa'];
				$komite=$row2['komite'];
				$query3 = "SELECT * FROM user
				where username='$pemeriksa'";
				$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());
				$query4 = "SELECT * FROM user
				where username='$komite'";
				$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());
				echo"<td><center>$row2[inisial]</center></td>";
				while ($row3=mysql_fetch_array($result3)) {
				echo"<td><center>$row3[inisial]</center></td>";
				}
				
				while ($row4=mysql_fetch_array($result4)) {
				echo"<td><center>$row4[inisial]</center></td>";
				}
				
				}
					
					echo"
				</tr>
			</table>
		</td>
	</tr>";
$query5 = "SELECT * FROM detail_opl 
where no_opl_temp='$no_opl_temp' order by no_step asc";
$result5 = mysql_query($query5) or die ('error, query failed.'.mysql_error());
while ($row5=mysql_fetch_array($result5)) {
echo"
<tr><td><img src='foto_opl/$row5[gambar]' width='90%'></td><td colspan='2'>$row5[keterangan]</td></tr>";	
}
echo"";
$query6 = "SELECT * FROM akses_opl 
join user on (user.username=akses_opl.username)
where akses_opl.no_opl_temp='$no_opl_temp' order by akses_opl.username asc";
$result6 = mysql_query($query6) or die ('error, query failed.'.mysql_error());
while ($row6=mysql_fetch_array($result6)) {
	$nilai=$row6['nilai'];
	if ($nilai==1){
		$nilai_fix="<img src='img/1.jpg'>";
	} else if ($nilai==2){
		$nilai_fix="<img src='img/2.jpg'>";
	} else if ($nilai==3){
		$nilai_fix="<img src='img/3.jpg'>";
	} else if ($nilai==4 ){
		$nilai_fix="<img src='img/4.jpg'>";
	} else {
		$nilai_fix="";
	}
if($nilai == 0){
	echo"";
}else {
echo"<tr><td colspan='3'>
<table border='1' width='100%'>
<tr>
<td><center>Realisasi</center></td>
<td><center>$row6[inisial]</center></td>
<td><center>$nilai_fix</center></td>
<td><center>$row6[tgl_penilaian]</center></td>
</td></tr>
</table></td>
</tr>";
}
}
	}
echo"
<tr><td colspan='3'>
<table border='0' width='100%'>
<tr>
<td><center><b>Tahap belajar</b></td><td><img src='img/1.jpg'></center></td>
<td><center><b>Dapat melakukan dengan bantuan</b></td><td><img src='img/2.jpg'></center></td>
</td></tr>
<tr>
<td><center><b>Mengerti tetapi belum dapat melakukannya</b></td><td><img src='img/3.jpg'></center></td>
<td><center><b>Dapat melakukan</b></td><td><img src='img/4.jpg'></center></td>
</td></tr>
</table></td>
</tr>
</table>
";?>