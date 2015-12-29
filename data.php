<?php
	mysql_connect("localhost","root","");
	mysql_select_db("opl");
	
	$term = trim(strip_tags($_GET['term']));
	
	$qstring = "SELECT * FROM opl WHERE tema_opl LIKE '%".$term."%' and status != 8";
	$result = mysql_query($qstring);
	
	while ($row = mysql_fetch_array($result))
	{
		$row['value']=htmlentities(stripslashes($row['tema_opl']));
		$row['id']=(int)$row['id'];
		$row_set[] = $row;
	}
	
	echo json_encode($row_set);
?>