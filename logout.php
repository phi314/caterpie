<?php
session_start();
error_reporting(0);
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['id_level']);
echo"<meta http-equiv='refresh' content='0;url=index.php'>";
?>