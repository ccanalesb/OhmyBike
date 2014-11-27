<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Mostrando Productos | OhMyBike! </title>
    </head>
    <body>        
        <br><br><br>
        <?php
            
            $result = pg_query("select producto.id_producto, producto.nombre, producto.marca, producto.importadora,producto.neto,producto.iva,producto.total,inventario.cantidad,producto.nota from producto,inventario where producto.id_producto=inventario.id_producto and NOT inventario.cantidad =0 order by producto.id_producto;");
            ?>
            <table class="table table-hover">
                         
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Importadora</th>
                    <th>Neto Unidad</th>
                    <th>Total Unidad</th>
                    <th>Cantidad</th>
                    <th>Total Neto</th>
                    <th>Total Iva</th>             
                    <th>Notas</th>
                </tr>
            </thead>
            <?
                $i=1;
                while($row= pg_fetch_array($result)){
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $row["id_producto"];
                    echo "</td>";
                    echo "<td>";
                    echo $row["nombre"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["marca"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["importadora"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["neto"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["neto"]+$row["iva"];
                    echo "</td>";                    
                    echo "<td> ";
                    echo $row["cantidad"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["neto"]*$row["cantidad"];
                    echo "</td>";
                    echo "<td> ";
                    echo ($row["neto"]+$row["iva"])*$row["cantidad"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["nota"];
                    echo "</td>";                     
                    echo "</tr>";
                    $i++;
                }    
            echo "</table>";
            ?>
            <center><a class="btn btn-info" href="productos.php">Producto</a></center>
        <br><br> 
    </body>
</html>
