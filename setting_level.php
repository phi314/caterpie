<?php
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
?>