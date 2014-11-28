<?php
$host="localhost";
$user="b18612358_ohmybike";
$pass="base2014";
$bdname="b18612358_ohmybike";
$connect= pg_connect("host=$host user=$user password=$pass dbname=$bdname");
if(!$connect)
   echo "<h4>Error de conexion</h4>";
else 
    echo "";
?>

