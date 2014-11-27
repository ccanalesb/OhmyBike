<?php
    include "conectar.php";
    $p = $_GET["id_producto"];
    $c = $_GET["cantidad"];
    $res = pg_query("select producto.total from producto where producto.id_producto = '$p';");
    $total= pg_fetch_array($res);
    $var = $c*$total["total"];
    echo "TOTAL $var CLP"
?>