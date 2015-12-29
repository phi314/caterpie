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

$objTpl = PHPExcel_IOFactory::load("report_opl_2.xlsx");
$objTpl->setActiveSheetIndex(0);
$a=$_POST['a'];
$b=$_POST['b'];
$a2=date("d F Y", strtotime($a));
$b2=date("d F Y", strtotime($b));

$objTpl->getActiveSheet()->setCellValue('C3', stripslashes('PERIODE '.$a2.' - '.$b2)); //mengambil nik karyawan pada index 0
$objTpl->getActiveSheet()->setCellValue('C2', stripslashes('RECORD OPL SYSTEM KARYAWAN'));
// Add some data
$sql = "SELECT user.fullname,circle_group.nama_cg, COUNT(user.fullname) AS jumlah FROM OPL 
	join agreement_opl on (opl.id_agreement=agreement_opl.id_agreement)
	join user on (user.username=agreement_opl.user)
	join circle_group on (user.id_cg = circle_group.id_cg)
	where opl.status = 7 and opl.tgl_approve_koordinator>='$a' and  opl.tgl_approve_koordinator<='$b' 
	GROUP BY user.fullname 
	ORDER BY jumlah DESC";
$q   = mysql_query( $sql );
$no=1;
$no1=0;
$z=7;

while( $r=mysql_fetch_array( $q ) ){
$v=$z+$no1;

$objTpl->getActiveSheet()->setCellValue('A'.$v.'', stripslashes(''.$no)); 
$objTpl->getActiveSheet()->setCellValue('B'.$v.'', stripslashes(''.$r['fullname']));
$objTpl->getActiveSheet()->setCellValue('C'.$v.'', stripslashes(''.$r['nama_cg']));
$objTpl->getActiveSheet()->setCellValue('D'.$v.'', stripslashes(''.$r['jumlah']));

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