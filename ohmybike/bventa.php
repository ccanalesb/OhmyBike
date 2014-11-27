<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Borrar Venta | OhMyBike! </title>
    </head>
    <body>
        
        
        <br><br><br>
        <?php
            
            $result = pg_query("select venta.id_venta, venta.rut_cliente, venta.fecha, venta.rut_personal, venta.abono, venta.p_pagar, venta_detalle.id_producto, venta_detalle.cantidad,venta.total,venta_detalle.nota,venta_detalle.estado from venta,venta_detalle where venta.id_venta=venta_detalle.id_venta order by venta.id_venta;");
            ?>
            <table class="table table-striped">
                         
            <thead>
                <tr>
                    <th>#</th> 
                    <th>ID Venta</th>
                    <th>Rut Cliente</th>
                    <th>Fecha</th>
                    <th>Hecha por</th>
                    <th>Abono</th>
                    <th>Por Pagar</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Notas</th>             
                    <th>Estado</th>
                </tr>
            </thead>
             
            <?
                $i=1;
                while($row= pg_fetch_array($result)){
                    if($row["estado"]=="PAGADO"){
                        echo "<tr class=\"success\">";
                    }
                    else 
                        echo "<tr class=\"danger\">";
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $row["id_venta"];
                    echo "</td>";
                    echo "<td>";
                    echo $row["rut_cliente"];
                    echo "</td>";
                    echo "<td>";
                    echo $row["fecha"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["rut_personal"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["abono"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["p_pagar"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["id_producto"];
                    echo "</td>";                    
                    echo "<td> ";
                    echo $row["cantidad"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["total"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["nota"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["estado"];
                    echo "</td>";                     
                    echo "</tr>";
                    $i++;
                    echo "</tr>";
                }    
            
            echo "</table>";
            ?> 
            <center>
            <form method="post" class="form-inline" role="form" action="fbventa.php">
            <legend> Ingrese ID Venta </legend>
                <p><input type="text" class="form-control" placeholder="ID Venta" name="id_venta" /></p>               
                <p><input class="btn btn-lg btn-success" type="submit" value="Enviar"/></p>
            </form>
            </center>
            <br><br>
            <center><a class="btn btn-info" href="ventas.php">Ventas</a></center>
        <br><br> 
    </body>
</html>