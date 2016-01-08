<?php
$Tahun=date('Y');
$server = "localhost";
$username = "root";
$password = "";
$database = "caterpie_opl";
// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Conection to database is not succes");
mysql_select_db($database) or die("Database could not be found");

if(!function_exists("dump"))
{
    function dump($string)
    {
        echo "<pre>";
        var_dump($string);
        echo "</pre>";
    }
}


?>