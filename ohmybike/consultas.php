<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Mostrando Ventas | OhMyBike! </title>
    </head>
    <body>
        <br><br><br>
        
        <center>
        <legend> Productos que no han sido vendidos </legend>
            <?php
                $consulta_no_vendido=pg_query("select nombre 
                        from producto
                        where id_producto not in(select producto.id_producto 
                                                from producto, venta_detalle
                                                where producto.id_producto = venta_detalle.id_producto
                                                group by producto.id_producto)");
                
                while($row = pg_fetch_array($consulta_no_vendido)){
                    echo "<td>";
                    echo "<h3>";
                    echo $row["nombre"];
                    echo "</td>";
                    echo "<br>";
                }
            ?>
            <br>
        <legend> Producto mas vendido</legend>
            <?php
                 $consulta_mas_stock=pg_query("select producto.nombre
                                            from producto, (select venta_detalle.id_producto, sum(venta_detalle.cantidad) as total 
                                                            from venta_detalle, producto                
                                                            where producto.id_producto=venta_detalle.id_producto 
                                                            group by venta_detalle.id_producto) as tp 
                                            where tp.total=(select max(tp.total) as total 
                                            from (select venta_detalle.id_producto, sum(venta_detalle.cantidad) as total 
                                                    from venta_detalle, producto                  
                                                    where producto.id_producto=venta_detalle.id_producto 
                                                    group by venta_detalle.id_producto) as tp) 
                                            and producto.id_producto=tp.id_producto;");
                $row = pg_fetch_array($consulta_mas_stock);
                $nombre = strtoupper($row["nombre"]);                                
                echo "<h3>El producto $nombre es el mas vendido";  
                echo "<br><br><br>";
            ?>
        <legend> Producto menos vendido</legend>
            <?php
                 $consulta_mas_stock=pg_query("select producto.nombre
        from producto, (select venta_detalle.id_producto, sum(venta_detalle.cantidad) as total 
                  from venta_detalle, producto                
                  where producto.id_producto=venta_detalle.id_producto 
                  group by venta_detalle.id_producto) as tp 
where tp.total=(select min(tp.total) as total 
                from (select venta_detalle.id_producto, sum(venta_detalle.cantidad) as total 
                        from venta_detalle, producto                  
                        where producto.id_producto=venta_detalle.id_producto 
                        group by venta_detalle.id_producto) as tp) 
and producto.id_producto=tp.id_producto;");
                $row = pg_fetch_array($consulta_mas_stock);
                $nombre = strtoupper($row["nombre"]);                                
                echo "<h3>El producto $nombre es el menos vendido";  
                echo "<br><br><br>";
            ?>
        <legend> Producto con mas stock</legend>
            <?php
                $consulta_mas_stock=pg_query("select producto.nombre,maximo.maxi
                                            from producto,inventario,(select max(inventario.cantidad)as maxi from inventario) as maximo
                                            where inventario.cantidad=(select max(inventario.cantidad) from inventario)
                                            and producto.id_producto=inventario.id_producto;");
                $row = pg_fetch_array($consulta_mas_stock);
                $nombre = strtoupper($row["nombre"]);
                $cantidad = $row["maxi"];                
                echo "<h3>El producto $nombre con $cantidad unidad(es)";  
                echo "<br><br><br>";
            ?>
        <legend> Producto con mas valor</legend>
            <?php
                $consulta_mas_valor=pg_query("select producto.nombre,max(producto.total) as cantidad from producto group by producto.nombre;");
                $row = pg_fetch_array($consulta_mas_valor);
                $nombre = strtoupper($row["nombre"]);
                $cantidad = $row["cantidad"];                
                echo "<h3>El producto $nombre con valor $cantidad CLP es el mas costoso";  
                echo "<br><br><br>";
            ?>
        
        <legend> Cliente con mas compras</legend>
            <?php
                $consulta_mas_compra=pg_query("select cliente.nombre, tabla.cantidad
                                            from cliente, (select venta.rut_cliente, count(*) as cantidad
                                                            from venta
                                                            group by venta.rut_cliente) as tabla
                                            where tabla.cantidad=(select max(tabla.cantidad)
                                                                        from (select venta.rut_cliente, count(*) as cantidad
                                                            from venta
                                                            group by venta.rut_cliente) as tabla)

                                            and cliente.rut_cliente=tabla.rut_cliente
                                            group by cliente.nombre,tabla.cantidad;");
                $row = pg_fetch_array($consulta_mas_compra);
                $nombre = strtoupper($row["nombre"]);
                $cantidad = $row["cantidad"];                
                echo "<h3>El cliente $nombre con $cantidad compra(as)";  
                echo "<br><br><br>";
            ?>
        <legend> La mejor venta </legend>
            <?php
                $consulta_mas_venta=pg_query("select max(venta.total), personal.nombre 
                                                from venta,personal
                                                where venta.rut_personal=personal.rut_personal
                                                group by personal.nombre");
                $row = pg_fetch_array($consulta_mas_venta);
                $max = $row["max"];
                $nombre = strtoupper($row["nombre"]);
                                
                echo "<h3>El vendedor $nombre con el monto $max";  
                echo "<br><br><br>";
            ?>
        <legend> Personal con mas ventas </legend>   
            <?php
                $consulta_mas_venta_p=pg_query("select personal.nombre,count(*) as cantidad from personal, venta where venta.rut_personal=personal.rut_personal group by personal.nombre;");
                $row = pg_fetch_array($consulta_mas_venta_p);
                $nombre = strtoupper($row["nombre"]);
                $cantidad = $row["cantidad"];                
                echo "<h3>El Personal $nombre con $cantidad venta(as)";  
                echo "<br><br><br>";
            ?>
        </center>
        <center><a class="btn btn-info" href="home.php">Home</a></center>
        <br><br> 
    </body>
</html>