<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Mostrando Ventas | OhMyBike! </title>
    </head>
    <body>
        
        
        <br><br><br>
        <?php
            
            $result = pg_query("select venta.rut_cliente, venta.fecha, personal.nombre, venta.abono, venta.p_pagar, producto.nombre as pnombre, venta_detalle.cantidad,venta.total,venta_detalle.nota,venta_detalle.estado from venta,venta_detalle,personal,producto where producto.id_producto = venta_detalle.id_producto and venta.rut_personal=personal.rut_personal and venta.id_venta=venta_detalle.id_venta order by venta.fecha;");
            ?>
            <table class="table table-hover">
                         
            <thead>
                <tr>
                    <th>#</th>
                    <th>Rut Cliente</th>
                    <th>Fecha</th>
                    <th>Hecha por</th>
                    <th>Abono</th>
                    <th>Por Pagar</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    
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
                    echo $row["rut_cliente"];
                    echo "</td>";
                    echo "<td>";
                    echo $row["fecha"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["nombre"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["abono"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["p_pagar"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["pnombre"];
                    echo "</td>";                    
                    echo "<td> ";
                    echo $row["cantidad"];
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
            <center><a class="btn btn-info" href="ventas.php">Ventas</a></center>
        <br><br> 
    </body>
</html>