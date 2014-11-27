<!DOCTYPE HTML>
<html>
    <head>
        <title> Agregar Producto | OhMyBike! </title>
        <?php include "inc.php"; ?>
        <?php include "conectar.php" ?>
    </head>
    <body>
         <br><br><br>
        <?php
            $result = pg_query("select producto.id_producto, producto.nombre, producto.marca, producto.importadora,producto.neto,producto.iva,producto.total,producto.nota from producto, inventario where producto.id_producto=inventario.id_producto order by producto.id_producto;");
            ?>
            <table class="table table-hover">
                         
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Importadora</th>
                    <th>Precio Neto Unidad</th>
                    <th>Precio Total Unidad</th>
                    <!-- <th>Cantidad</th>
                    <th>Precio Total Neto</th>
                    <th>Precio Total Iva</th>              -->
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
                    // echo "<td> ";
                    // echo $row["cantidad"];
                    // echo "</td>";
                    // echo "<td> ";
                    // echo $row["neto"]*$row["cantidad"];
                    // echo "</td>";
                    // echo "<td> ";
                    // echo ($row["neto"]+$row["iva"])*$row["cantidad"];
                    // echo "</td>";
                    echo "<td> ";
                    echo $row["nota"];
                    echo "</td>";                     
                    echo "</tr>";
                    $i++;
                } 
                echo "</table>";
            ?> 
        <center>
        <form method="post" class="form-inline" role="form" action="faproductos.php">
            <legend> Ingrese Producto</legend>
            <p><input type="text" class="form-control" placeholder="Codigo Producto" name="id_producto" /></p>
            <p><input type="text" class="form-control" placeholder="Nombre Producto" name="nombre" /></p>
            <p><input type="text" class="form-control" placeholder="Marca Producto" name="marca" ></input></p>
            <p><input type="text" class="form-control" placeholder="Importadora" name="importadora" ></input></p>
            <p><input type="text" class="form-control" placeholder="Precio Neto" name="neto" ></input></p>
            <p><input type="text" class="form-control" placeholder="Cantidad" name="cantidad" ></input></p>
            <p><textarea rows="4" class="form-control" type="text" placeholder="Notas" name="nota" ></textarea></p>
            <p><input type="submit" class="btn btn-lg btn-success" value="Enviar"/></p>
        </form> 
        </center>
        <center><a class="btn btn-info" href="productos.php">Productos</a></center>
        <br><br>   
    </body>
</html>
