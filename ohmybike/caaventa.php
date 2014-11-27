<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Actualizando Venta </title> 
    </head>
    <script>
    function funcion(){
        $.get( "inventario.php", { id_producto: document.metodoweon.id_producto.value, cantidad: document.metodoweon.cantidad.value } )
        .done(function( data ) {
            $("#imprimir").html(data);
        });        
    }
    </script>
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
        <center>
		<form method="post" class="form-inline" role="form" action="fcaaventas.php" name="metodoweon">
        <legend> Ingrese Venta </legend>
            <p><input type="text" class="form-control" placeholder="Rut Cliente" id="rut" name="rut_cliente" /></p>
            <p><input type="text" class="form-control" id="fecha" placeholder="Fecha" name="fecha" /></p>
            <p><input type="text" class="form-control" placeholder="Rut Personal" id="rut2" name="rut_personal" /></p>            
            <p><input type="text" class="form-control" placeholder="ID Producto" onchange="javascript:funcion();" name="id_producto" /></p>
            <p><input type="text" class="form-control" placeholder="Cantidad" onchange="javascript:funcion();" name="cantidad" /> <div id="imprimir"></div> </p>
            <p><input type="text" class="form-control" placeholder="Abono" name="abono" /></p>
            <p><textarea rows="4" class="form-control" type="text" placeholder="Notas" name="nota" ></textarea></p>
            <p><input class="btn btn-lg btn-success" type="submit" value="Enviar"/></p>
        </form>
        </center>
        <center><a class="btn btn-info" href="ventas.php">Ventas</a></center>
    <br><br> 
    </body>
</html>