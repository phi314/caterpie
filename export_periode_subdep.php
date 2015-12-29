<?php
/**
 * update template 7 Mar 2014
 * @author Hendra Maulana
 * @copyright 2012
 */
error_reporting(0);
if( mysql_connect("localhost","root","") ){
mysql_select_db("opl");
}
//include PHPExcel library
require_once "Classes/PHPExcel.php";
require_once "Classes/PHPExcel/IOFactory.php";

$objTpl = PHPExcel_IOFactory::load("report_opl.xlsx");
$objTpl->setActiveSheetIndex(0);
$nama =$_POST['nama_subdep'];
$a=$_POST['a_subdep'];
$b=$_POST['b_subdep'];
$a2=date("d F Y", strtotime($a));
$b2=date("d F Y", strtotime($b));

$objTpl->getActiveSheet()->setCellValue('D3', stripslashes('PERIODE '.$a2.' - '.$b2)); //mengambil nik karyawan pada index 0
$objTpl->getActiveSheet()->setCellValue('D2', stripslashes('RECORD OPL SYSTEM / Sub Departmen ('.$nama.')'));
// Add some data
$sql = "SELECT * FROM opl 
JOIN agreement_opl ON (agreement_opl.id_agreement=opl.id_agreement)
JOIN USER ON (user.username=agreement_opl.user)
JOIN circle_group ON (circle_group.id_cg=user.id_cg)
JOIN sub_dep ON (sub_dep.id_sub_dep=circle_group.id_sub_dep)
JOIN departmen ON (departmen.id_dep=sub_dep.id_dep)
where opl.tgl_approve_koordinator>='$a' and  opl.tgl_approve_koordinator<='$b'
and opl.status = 7 and sub_dep.nama_sub_dep='$nama'";
$q   = mysql_query( $sql );
$no=1;
$no1=0;
$z=7;

while( $r=mysql_fetch_array( $q ) ){
	$tgl_buat=$r['tgl_pembuatan'];
	$tgl_approve=$r['tgl_approve_koordinator'];
	$jenis=$r['jenis_opl'];
	$tgl_buat_opl=date('d-m-Y H:i:s',strtotime($tgl_buat));
$tgl_approve_koordinator=date('d-m-Y H:i:s',strtotime($tgl_approve));
$v=$z+$no1;

if($jenis == 1){
	$jenisa = 'Pengetahuan Dasar';
}else if ($jenis == 2){
	$jenisa = 'Trouble Shooting';
}else{
	$jenisa = 'Improvement';
}

$querya7 = "SELECT count(opl.tema_opl) as h FROM opl 
join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
join user on (user.username=agreement_opl.user)
where opl.tgl_approve_koordinator>='$a' and  opl.tgl_approve_koordinator<='$b' and opl.status = 7";
$resulta7 = mysql_query($querya7) or die ('error, query failed.'.mysql_error());	
while ($rowa7=mysql_fetch_array($resulta7)) {
$jmla7=$rowa7['h'];
}
if ($jmla7 == NULL) {
		$jmla77=0;
} else {
	$jmla77=$jmla7;
}

$objTpl->getActiveSheet()->setCellValue('A'.$v.'', stripslashes(''.$no)); 
$objTpl->getActiveSheet()->setCellValue('B'.$v.'', stripslashes(''.$r['no_opl']));
$objTpl->getActiveSheet()->setCellValue('C'.$v.'', stripslashes(''.$tgl_buat_opl));
$objTpl->getActiveSheet()->setCellValue('D'.$v.'', stripslashes(''.$jenisa));
$objTpl->getActiveSheet()->setCellValue('E'.$v.'', stripslashes(''.$r['tema_opl']));
$objTpl->getActiveSheet()->setCellValue('F'.$v.'', stripslashes(''.$tgl_approve_koordinator));
$objTpl->getActiveSheet()->setCellValue('G'.$v.'', stripslashes(''.$r['fullname']));
$objTpl->getActiveSheet()->setCellValue('H'.$v.'', stripslashes(''.$r['nama_cg']));
$objTpl->getActiveSheet()->setCellValue('I'.$v.'', stripslashes(''.$r['nama_sub_dep']));
$objTpl->getActiveSheet()->setCellValue('J'.$v.'', stripslashes(''.$r['nama_dep']));

$no++;
$no1++;
}

//prepare downloadll
$filename=mt_rand(1,100000).'.xlsx'; //just some random filename
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objTpl,'Excel2007');  //downloadable file is in Excel 2003 format (.xls)
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('php://output');  //send it to user, of course you can save it to disk also!
 
exit; //done.. exiting
?>