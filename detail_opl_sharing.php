<!DOCTYPE html>
<html lang="en">
<div class="container">
<?php
//error_reporting(0);
session_start();
include"koneksi.php";
include"header.php";
include"setting_level.php";
$username=$_SESSION['username'];
?>
<?php
$no_opl_temp=$_GET['no_opl_temp'];
$query22 = "SELECT * FROM akses_opl 
where username='$username' and nilai!=0 and no_opl_temp='$no_opl_temp'";
$result22 = mysql_query($query22) or die ('error, query failed.'.mysql_error());
while ($row22=mysql_fetch_array($result22)) {
	$no_opl_temp2=$row22['no_opl_temp'];
}
echo"	<a href='index.php'><input type='submit' class='btn btn-info btn-small' value='Kembali'></a>";
if ($no_opl_temp2!=NULL){
	echo"";
} else {
	echo"

<form method='POST' action='action_nilai_opl_sharing.php'>
	<table align='center'>
		<tr>
			<td><font face='calibri'><b>Penilaian</b></font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>
			<select name='nilai'>
			<option value='kosong'>
			<option value='1'>Tahap Belajar
			<option value='2'>Mengerti tapi belum dapat melakukannya
			<option value='3'>Dapat melakukan dengan bantuan
			<option value='4'>Dapat melakukan
			</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type='hidden' name='no_opl_temp' value='$no_opl_temp'></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='submit' class='btn btn-primary' value='Simpan Penilaian'></td>
		</tr>
		
	</table>
		
</form>
<hr/>";
}
echo"<center><font face='calibri'><b>ONE POINT LESSON</b></font></center><br/>";

$query = "SELECT * FROM opl
	JOIN agreement_opl on (agreement_opl.id_agreement=opl.id_agreement)
where opl.no_opl_temp='$no_opl_temp'";
$result = mysql_query($query) or die ('error, query failed.'.mysql_error());

$tema_opl = '';
while ($row=mysql_fetch_array($result)) {
$pembuat=$row['user'];
$pemeriksa=$row['pemeriksa'];
$komite=$row['komite'];
$status_opl=$row['status'];
$no_opl=$row['no_opl'];

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


$query1 = "SELECT * FROM user
where username='$pembuat'";
$result1 = mysql_query($query1) or die ('error, query failed.'.mysql_error());
$query2 = "SELECT * FROM user
where username='$pemeriksa'";
$result2 = mysql_query($query2) or die ('error, query failed.'.mysql_error());

$query3 = "SELECT * FROM user
where username='$komite'";
$result3 = mysql_query($query3) or die ('error, query failed.'.mysql_error());

$query4 = "SELECT * FROM detail_opl
where no_opl_temp='$no_opl_temp'";
$result4 = mysql_query($query4) or die ('error, query failed.'.mysql_error());

$jenis_opl=$row['jenis_opl'];
if ($jenis_opl==1){
	$jenis='Pengetahuan Dasar';
} else if ($jenis_opl==2){
	$jenis='Troubleshooting';
} else {
	$jenis='Improvement';
}
echo"
<table align='left'>
<tr>
	<td><font face='calibri'>Nomor OPL</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>";
	if($no_opl !=NULL){
		echo"$no_opl";
	} else {
	echo"$row[no_opl_temp]";
        $tema_opl = $row['tema_opl'];
	}

	echo"</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Tanggal Pembuatan</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row[tgl_pembuatan]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Jenis OPL</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$jenis</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Tema OPL</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row[tema_opl]</b></font></td>
</tr>
<tr>
	<td><font face='calibri'>Status</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$status</b></font></td>
</tr>";
while ($row1=mysql_fetch_array($result1)) {
echo"<tr>
	<td><font face='calibri'>Pembuat</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row1[fullname]</b></font></td>
</tr>";	
}
while ($row2=mysql_fetch_array($result2)) {
echo"<tr>
	<td><font face='calibri'>Atasan</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row2[fullname]</b></font></td>
</tr>";	
}
while ($row3=mysql_fetch_array($result3)) {
echo"<tr>
	<td><font face='calibri'>Komite</font></td>
	<td>&nbsp;:&nbsp;</td>
	<td><font face='calibri'><b>$row3[fullname]</b></font></td>
</tr>";	
}

$opl_baru = "";
while ($row4=mysql_fetch_array($result4)) {
    $opl_baru .= $row4['keterangan'];
echo"<tr>
	<td><font face='calibri'></font></td>
	<td>&nbsp;&nbsp;</td>
	<td><font face='calibri'>Step ke $row4[no_step]</font><br/><img src='foto_opl/$row4[gambar]' width='250px'><br/>
	<font face='calibri'>Keterangan : <b>$row4[keterangan]</b></font><br/><br/></td>
</tr>";	
}
echo"</table>
";
}
?>
<br/>

<!--    <a href="detail_opl_sharing.php?no_opl_temp=--><?php //echo $no_opl_temp; ?><!--&similiarity=true" class="btn btn-small btn-success">Hitung Similaritas</a>-->
<!--    <br>-->
<!--    <br>-->
<!--</div>-->
<!---->
<?php //if(!empty($_GET['similiarity'])): ;?>
<!--<div class="container">-->
<!--    --><?php
//        $q = mysql_query("SELECT * FROM opl WHERE tema_opl='$tema_opl' AND no_opl_temp != '$no_opl_temp'");
//        $array_no_opl = [];
//        while($data = mysql_fetch_object($q))
//        {
//            $q_agreement = mysql_query("SELECT * FROM agreement_opl WHERE id_agreement='$data->id_agreement'");
//            $d_agreement = mysql_fetch_object($q_agreement);
//            $q_user = mysql_query("SELECT * FROM user WHERE username='$d_agreement->user'");
//            $d_user = mysql_fetch_object($q_user);
//            $array = [];
//            $no_opl = $data->no_opl_temp;
//            $nama_user = $d_user->fullname;
//
//            $array = [
//                'no_opl'    => $no_opl,
//                'nama'      => $nama_user
//            ];
//
//            $array_no_opl[] = $array;
//            $q_d = mysql_query("SELECT * FROM detail_opl WHERE no_opl_temp='$no_opl'");
//
//            $opl = "";
//            while($data_q = mysql_fetch_object($q_d))
//            {
//                $opl .= "|".$data_q->keterangan;
//            }
//
//            $opl_lama[] = $opl;
//
//        }
//
//        include "Classes/Similiatiry.php";
//        $similiarity = new Similiatiry($opl_baru, $opl_lama);
//        $similiarity->run();
//
//        $persentase = $similiarity->pembobotan['similaritas'];
//    ?>
<!--    <table>-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>No. OPL</th>-->
<!--            <th>Nama</th>-->
<!--            <th>Opl Sebelumnya</th>-->
<!--            <th>Persentase Similaritas</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--            --><?php //foreach($opl_lama as $key => $opl_lama_row): $d = $key+1; ?>
<!--            <tr>-->
<!--                <td>--><?php //echo $array_no_opl[$key]['no_opl']; ?><!--</td>-->
<!--                <td>--><?php //echo $array_no_opl[$key]['nama']; ?><!--</td>-->
<!--                <td>--><?php //echo $similiarity->tokenization($opl_lama_row); ?><!--</td>-->
<!--                <td>--><?php //echo $persentase['persentase_d'.$d]; ?><!--%</td>-->
<!--            </tr>-->
<!--            --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->
<!---->
<?php //endif; ?>
<!---->
<!--</div>-->
	<?php
	include "footer.php";
?>
</div>
</html>
</div>