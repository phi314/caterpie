<?php
   error_reporting(0);
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  

</head>

<div class="container">
<?php
error_reporting(0);
include "header.php";

if ($_SESSION['id_level']==1)
{
include "nav_creator.php"; }
else if ($_SESSION['id_level']==2)
{
include "nav_koordinator.php";
} else if ($_SESSION['id_level']==3)
{ 
include "nav_admin.php"; 
} else {
include "nav.php";
}
 
include "home.php"; 

include "footer.php";
?>
</div>
</body>
</html>
