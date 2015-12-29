<?php
	mysql_connect("localhost","root","");
	mysql_select_db("opl");
	
	$term = trim(strip_tags($_GET['term']));
	
	$qstring = "SELECT * FROM user WHERE fullname LIKE '%".$term."%'";
	$result = mysql_query($qstring);
	
	while ($row = mysql_fetch_array($result))
	{
		$row['value']=htmlentities(stripslashes($row['fullname']));
		$row['username']=(int)$row['username'];
		$row_set[] = $row;
	}
	
	echo json_encode($row_set);
?>