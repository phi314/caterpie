<?php
error_reporting(0);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>HELPDESK</title>
<meta charset="UTF-8" />
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/structure.css">
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<script language="javascript" src="js/mask.js"></script>
</head>


<body>

<center><div id="hide">HELPDESK<br/><br/>PT KALBE MORINAGA INDONESIA</div></center>
<form class="box login" name=login action="ceklogin.php" method=POST>

	<fieldset class="boxBody">
	  <label>Nama</label>
	  <input type="text" tabindex="1" name=username  onkeypress="return runScript(event)" autofocus required>
	  <label><a href="#" class="rLink" tabindex="5"></a>Kata sandi</label>
	  <input type="password" name=password tabindex="2" onkeypress="return runScript(event)" autofocus  required>
	  
	</fieldset>
	<footer>

	  <input type="submit" class="btnLogin" value="Masuk" tabindex="4" >
	</footer>
	
</form>
<footer id="main">
  <a href="index.php">Copyright &copy;&nbsp; 2015 PT. Kalbe Morinaga Indonesia - All rights reserved</a> 
</footer>
</body>
</html>
