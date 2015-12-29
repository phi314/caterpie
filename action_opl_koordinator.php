<?php
$querya6 = "SELECT count(no_opl_temp) as c FROM opl 
		JOIN agreement_opl
		ON (opl.id_agreement=agreement_opl.id_agreement) where opl.status='5'";
$resulta6 = mysql_query($querya6) or die ('error, query failed.'.mysql_error());	
while ($rowa6=mysql_fetch_array($resulta6)) {
$jmla6=$rowa6['c'];
}
if ($jmla6 == NULL) {
		$jmla66=0;
} else {
	$jmla66=$jmla6;
}

$querya7 = "SELECT count(opl.tema_opl) as h FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.status = '7'";
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
 <li role="presentation" class="active"><a><font face='calibri'><big><big><big>DASHBOARD OPL <small><small><span class='badge badge-warning'><?php echo"$jmla66"; ?></span></small></small></big></big></big></font></a></li>
 <li role="presentation" ><a href='daftar_opl_selesai_koordinator.php'><font face='calibri'><big>OPL SELESAI <small><small><span class='badge badge-success'><?php echo"$jmla77"; ?></span></small></small></big></font></a></li>
 <li role="presentation" ><a href='score_koordinator.php'><font face='calibri'><big>PENILAIAN </big></font></a></li>
 <li role="presentation" ><a href='report_koordinator.php'><font face='calibri'><big>LAPORAN OPL </big></font></a></li>
</ul>	
	<?php
		$queryX="SELECT * FROM opl 
		JOIN agreement_opl
		ON (opl.id_agreement=agreement_opl.id_agreement) where opl.status='5'";
		$resultX = mysql_query($queryX) or die ('error, query failed.'.mysql_error());
	?>
		<table class="table table-hover table-condensed table-bordered">
			<?php echo "<tbody>
				<tr class='warning'>
					<td><small><font face='calibri'><center><b>Nomor OPL</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Nama Pembuat</b></center> </font></small></td>
					<td><small><font face='calibri'><center><b>Tanggal Pembuatan</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Tema</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Status</b></center></font></small></td>
					<td><small><font face='calibri'><center><b>Menu</b></center></font></small></td>
				</tr>
				";
					while ($rowX=mysql_fetch_array($resultX)) 
					{
						$no_opl_tempX=$rowX['no_opl_temp'];
						$userX=$rowX['user'];
						$tgl_pembuatanX=$rowX['tgl_pembuatan'];
						$status_oplX=$rowX['status'];
						$tema_opl=$rowX['tema_opl'];
						$tgl_koreksi_pemeriksa=$rowX['tgl_koreksi_pemeriksa'];
						$tgl_koreksi_komite=$rowX['tgl_koreksi_komite'];
						$tgl_koreksi_koordinator=$rowX['tgl_koreksi_koordinator'];
						
						$queryR="SELECT fullname FROM user where username='$userX'";
						$resultR = mysql_query($queryR) or die ('error, query failed.'.mysql_error());
						$rowR=mysql_fetch_array($resultR);
						$fullname_pembuatX = $rowR['fullname'];
							
							if($tgl_koreksi_pemeriksa != NULL){
								$tgl_koreksi=$tgl_koreksi_pemeriksa;
							}else if ($tgl_koreksi_komite != NULL){
								$tgl_koreksi=$tgl_koreksi_komite;
							}else if ($tgl_koreksi_koordinator != NULL){
								$tgl_koreksi=$tgl_koreksi_koordinator;
							}else{
								$tgl_koreksi='';
							}

							if ($status_oplX == 1){
								$statusX='Menunggu Atasan';
							} else if ($status_oplX == 2){
								$statusX='Koreksi Atasan';
							} else if ($status_oplX==3){
								$statusX='Menunggu Komite';
							} else if ($status_oplX==4){
								$statusX='Koreksi Komite';
							} else if ($status_oplX==5){
								$statusX='Menunggu Koordinator';
							} else if ($status_oplX==6){
								$statusX='Koreksi Koordinator';
							} else if ($status_oplX==7){
								$statusX='Selesai';
							} else {
								$statusX='Reject';
							}
						echo "
						<tr class='info'>
							<td><small><center><font face='calibri'>$no_opl_tempX</font></center></small></td>
							<td ><small><font face='calibri'><center>$fullname_pembuatX</center></font></small></td>
							<td ><small><font face='calibri'><center>$tgl_pembuatanX</center></font></small></td>
							<td ><small><font face='calibri'><center>$tema_opl</center></font></small></td>
							<td ><small><font face='calibri'><center>$statusX</center></font></td></small></td>
							<td><center><a href='detail_opl_koordinator.php?no_opl_temp=$no_opl_tempX'><span class='badge badge-info'>Lihat</span></a></center></td>
						</tr>";
						$no++;
					}
		if ($no_opl_tempX == NULL) {
		echo"<tr class='info'><td colspan='11'><center><font face='calibri'>Tidak ada data OPL yang ditampilkan</font></center></td></tr>";
	} else {
		echo"";
	}			
		
			?></table>
