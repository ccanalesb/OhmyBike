<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
    <title>OhMySugoi!</title>
    <link rel="shortcut icon" href="http://favicon-generator.org/favicons/2014-06-17/73652ad11738752e25fd83969daed401.ico">  
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.Rut.js"></script> 
</head>
<body>
<div class="fixed">	
	<nav class="top-bar" data-topbar role="navigation">
	  	<ul class="title-area">
	    	<li class="name">
	      		<h1><a href="#">OhMySugoi!</a></h1>
	    	</li>
	  	</ul>

	  	<section class="top-bar-section">
	    	<ul class="right">
	      		<li>
	      			<a href="#" data-reveal-id="consultas">Consultas</a>

	      			<div id="consultas" class="reveal-modal" data-reveal>
	      		        <h3> Productos que no han sido vendidos </h3>
	      		            <?php
	      		                $consulta_no_vendido=pg_query("select nombre 
	      		                        from producto
	      		                        where id_producto not in(select producto.id_producto 
	      		                                                from producto, venta_detalle
	      		                                                where producto.id_producto = venta_detalle.id_producto
	      		                                                group by producto.id_producto)");
	      		                
	      		                while($row = pg_fetch_array($consulta_no_vendido)){
	      		                    echo "<td>";
	      		                    echo "<h4>";
	      		                    echo $row["nombre"];
	      		                    echo "</td>";
	      		                    echo "<br>";
	      		                }
	      		            ?>
	      		            <br>
	      		        <h3> Producto mas vendido</h3>
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
	      		                echo "<h4>El producto $nombre es el mas vendido";  
	      		                echo "<br><br><br>";
	      		            ?>
	      		        <h3> Producto menos vendido</h3>
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
	      		                echo "<h4>El producto $nombre es el menos vendido";  
	      		                echo "<br><br><br>";
	      		            ?>
	      		        <h3> Producto con mas stock</h3>
	      		            <?php
	      		                $consulta_mas_stock=pg_query("select producto.nombre,maximo.maxi
	      		                                            from producto,inventario,(select max(inventario.cantidad)as maxi from inventario) as maximo
	      		                                            where inventario.cantidad=(select max(inventario.cantidad) from inventario)
	      		                                            and producto.id_producto=inventario.id_producto;");
	      		                $row = pg_fetch_array($consulta_mas_stock);
	      		                $nombre = strtoupper($row["nombre"]);
	      		                $cantidad = $row["maxi"];                
	      		                echo "<h4>El producto $nombre con $cantidad unidad(es)";  
	      		                echo "<br><br><br>";
	      		            ?>
	      		        <h3> Producto con mas valor</h3>
	      		            <?php
	      		                $consulta_mas_valor=pg_query("select producto.nombre,max(producto.total) as cantidad from producto group by producto.nombre;");
	      		                $row = pg_fetch_array($consulta_mas_valor);
	      		                $nombre = strtoupper($row["nombre"]);
	      		                $cantidad = $row["cantidad"];                
	      		                echo "<h4>El producto $nombre con valor $cantidad CLP es el mas costoso";  
	      		                echo "<br><br><br>";
	      		            ?>
	      		        
	      		        <h3> Cliente con mas compras</h3>
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
	      		                echo "<h4>El cliente $nombre con $cantidad compra(as)";  
	      		                echo "<br><br><br>";
	      		            ?>
	      		        <h3> La mejor venta </h3>
	      		            <?php
	      		                $consulta_mas_venta=pg_query("select max(venta.total), personal.nombre 
	      		                                                from venta,personal
	      		                                                where venta.rut_personal=personal.rut_personal
	      		                                                group by personal.nombre");
	      		                $row = pg_fetch_array($consulta_mas_venta);
	      		                $max = $row["max"];
	      		                $nombre = strtoupper($row["nombre"]);
	      		                                
	      		                echo "<h4>El vendedor $nombre con el monto $max";  
	      		                echo "<br><br><br>";
	      		            ?>
	      		        <h3> Personal con mas ventas </h3>   
	      		            <?php
	      		                $consulta_mas_venta_p=pg_query("select personal.nombre,count(*) as cantidad from personal, venta where venta.rut_personal=personal.rut_personal group by personal.nombre;");
	      		                $row = pg_fetch_array($consulta_mas_venta_p);
	      		                $nombre = strtoupper($row["nombre"]);
	      		                $cantidad = $row["cantidad"];                
	      		                echo "<h4>El Personal $nombre con $cantidad venta(as)";  
	      		                echo "<br><br><br>";
	      		            ?>
	      			</div>
	      		</li>
	      		<li>
	      			<a href="#" data-reveal-id="modelo">Modelo</a>

	      			<div id="modelo" class="reveal-modal" data-reveal>
	      				<h3>Modelo Entidad-Relación</h3>
	      				<img src="http://i1081.photobucket.com/albums/j345/dennis_yeah/Diagram1_zps08d21250.png~original" border="0" alt=" photo Diagram1_zps08d21250.png"/>
	      			</div>
	      		</li>
	    	</ul>

	    	<ul class="left" class="tabs" data-tab>
     		 	<li class="active"><a href="#productos">Productos</a></li>
			  	<li><a href="#ventas">Ventas</a></li>
				<li><a href="#clientes">Clientes</a></li>
			  	<li><a href="#personal">Personal</a></li>
    		</ul>
	  	</section>
	</nav>	
</div>
	<div class="row">
		<div class="tabs-content">
			<div class="content active" id="productos">
			  	<div class="row">
			  		<dl class="tabs" data-tab>
			  		  	<dd class="active"><a href="#aproductos">Agregar producto</a></dd>
			  		  	<dd><a href="#bproductos">Borrar producto</a></dd>
			  		  	<dd><a href="#lproductos">Listar productos</a></dd>
			  		  	<dd><a href="#mproducto">Modificar productos</a></dd>
			  		</dl>
			  		<div class="tabs-content">
			  			<div class="content active" id="aproductos">
			  		   		<div class="row">
			  		   			<?php
			  		   				$productos = pg_query("select producto.id_producto, producto.nombre, producto.marca, producto.importadora,producto.neto,producto.iva,producto.total,producto.nota from producto, inventario where producto.id_producto=inventario.id_producto order by producto.id_producto;");
			  		   			?>
		  		                <table>        
		  		                <thead>
		  		                    <tr>
		  		                        <th>#</th>
		  		                        <th>ID</th>
		  		                        <th>Nombre</th>
		  		                        <th>Marca</th>
		  		                        <th>Importadora</th>
		  		                        <th>Precio Neto Unidad</th>
		  		                        <th>Precio Total Unidad</th>
		  		                        <th>Notas</th>
		  		                    </tr>
		  		                </thead>  
		  		                <tbody>
		  		                <?
		  		                    $i=1;
		  		                    while($row= pg_fetch_array($productos)){
		  		                        echo "<tr><td>".$i."</td>";
		  		                        echo "<td>".$row["id_producto"]."</td>";
		  		                        echo "<td>".$row["nombre"]."</td>";
		  		                        echo "<td>".$row["marca"]."</td>";
		  		                        echo "<td>".$row["importadora"]."</td>";
		  		                        echo "<td>".$row["neto"]."</td>";
		  		                        echo "<td>".$row["neto"]+$row["iva"]."</td>";                    
		  		                        echo "<td> ".$row["nota"]."</td></tr>";
		  		                        $i++;
		  		                    }    
		  		                ?>
		  		            	</tbody>
		  		            	</table> 
			  		   			<center>
			  		   			<div class="row">
		    		    			<div class="large-6 large-centered columns">
					  		   			<form method="post" class="form-inline" role="form" action="faproductos.php">
					  		   			    <h3> Ingrese Producto</h3>
					  		   			    <p><input type="text" class="form-control" placeholder="Codigo Producto" name="id_producto" /></p>
					  		   			    <p><input type="text" class="form-control" placeholder="Nombre Producto" name="nombre" /></p>
					  		   			    <p><input type="text" class="form-control" placeholder="Marca Producto" name="marca" ></input></p>
					  		   			    <p><input type="text" class="form-control" placeholder="Importadora" name="importadora" ></input></p>
					  		   			    <p><input type="text" class="form-control" placeholder="Precio Neto" name="neto" ></input></p>
					  		   			    <p><input type="text" class="form-control" placeholder="Cantidad" name="cantidad" ></input></p>
					  		   			    <p><textarea rows="4" class="form-control" type="text" placeholder="Notas" name="nota" ></textarea></p>
					  		   			    <p><input type="submit" class="button" value="Enviar"/></p>
					  		   			</form> 
					  		   		</div>
					  		   	</div>
			  		   		</div>
			  		  	</div>
			  		  	<div class="content" id="bproductos">
			  		    	<div class="row">
		  		                <table>        
		  		                <thead>
		  		                    <tr>
		  		                        <th>#</th>
		  		                        <th>ID</th>
		  		                        <th>Nombre</th>
		  		                        <th>Marca</th>
		  		                        <th>Importadora</th>
		  		                        <th>Precio Neto Unidad</th>
		  		                        <th>Precio Total Unidad</th>
		  		                        <th>Notas</th>
		  		                    </tr>
		  		                </thead>  
		  		                <tbody>
		  		                <?
		  		                    $i=1;
		  		                    while($row= pg_fetch_array($productos)){
		  		                        echo "<tr><td>".$i."</td>";
		  		                        echo "<td>".$row["id_producto"]."</td>";
		  		                        echo "<td>".$row["nombre"]."</td>";
		  		                        echo "<td>".$row["marca"]."</td>";
		  		                        echo "<td>".$row["importadora"]."</td>";
		  		                        echo "<td>".$row["neto"]."</td>";
		  		                        echo "<td>".$row["neto"]+$row["iva"]."</td>";                    
		  		                        echo "<td> ".$row["nota"]."</td></tr>";
		  		                        $i++;
		  		                    }    
		  		                ?>
		  		            	</tbody>
		  		            	</table> 
		  		            	<div class="row">
		    		    			<div class="large-6 large-centered columns">
					  		    		<form method="post" class="form-inline" role="form" action="fbproductos.php">
						  		    		<h3> Ingrese ID Producto</h3>
						  		    		<p><input type="text" class="form-control" placeholder="ID Producto" name="id_producto" /></p>
						  		    		<p><input type="text" class="form-control" placeholder="Cantidad" name="cantidad" /></p>
						  		    		<p><input type="submit" class="button" value="Enviar"/></p>
					  		    		</form>
					  		    	</div>
					  		    </div> 
			  		    	</div>
			  		  	</div>
			  		  	<div class="content" id="lproductos">
		  		  			<div class="row">
		  		                <table>        
		  		                <thead>
		  		                    <tr>
		  		                        <th>#</th>
		  		                        <th>ID</th>
		  		                        <th>Nombre</th>
		  		                        <th>Marca</th>
		  		                        <th>Importadora</th>
		  		                        <th>Precio Neto Unidad</th>
		  		                        <th>Precio Total Unidad</th>
		  		                        <th>Notas</th>
		  		                    </tr>
		  		                </thead>  
		  		                <tbody>
		  		                <?
		  		                    $i=1;
		  		                    while($row= pg_fetch_array($productos)){
		  		                        echo "<tr><td>".$i."</td>";
		  		                        echo "<td>".$row["id_producto"]."</td>";
		  		                        echo "<td>".$row["nombre"]."</td>";
		  		                        echo "<td>".$row["marca"]."</td>";
		  		                        echo "<td>".$row["importadora"]."</td>";
		  		                        echo "<td>".$row["neto"]."</td>";
		  		                        echo "<td>".$row["neto"]+$row["iva"]."</td>";                    
		  		                        echo "<td> ".$row["nota"]."</td></tr>";
		  		                        $i++;
		  		                    }    
		  		                ?>
		  		            	</tbody>
		  		            	</table> 
		  		  			</div>
			  		  	</div>
			  		  	<div class="content" id="mproducto">
			  		    	<div class="row">
		  		                <table>        
		  		                <thead>
		  		                    <tr>
		  		                        <th>#</th>
		  		                        <th>ID</th>
		  		                        <th>Nombre</th>
		  		                        <th>Marca</th>
		  		                        <th>Importadora</th>
		  		                        <th>Precio Neto Unidad</th>
		  		                        <th>Precio Total Unidad</th>
		  		                        <th>Notas</th>
		  		                    </tr>
		  		                </thead>  
		  		                <tbody>
		  		                <?
		  		                    $i=1;
		  		                    while($row= pg_fetch_array($productos)){
		  		                        echo "<tr><td>".$i."</td>";
		  		                        echo "<td>".$row["id_producto"]."</td>";
		  		                        echo "<td>".$row["nombre"]."</td>";
		  		                        echo "<td>".$row["marca"]."</td>";
		  		                        echo "<td>".$row["importadora"]."</td>";
		  		                        echo "<td>".$row["neto"]."</td>";
		  		                        echo "<td>".$row["neto"]+$row["iva"]."</td>";                    
		  		                        echo "<td> ".$row["nota"]."</td></tr>";
		  		                        $i++;
		  		                    }    
		  		                ?>
		  		            	</tbody>
		  		            	</table>
		  		            	<div class="row">
		    		    			<div class="large-6 large-centered columns">
		  		    		            <form method="post" class="form-inline" role="form" action="facproductos.php">
		  		    			            <h3> Ingrese Producto</h3>
			  		    			            <p><input type="text" class="form-control" placeholder="ID Producto" name="id_producto" /></p>
			  		    			            <p><input type="text" class="form-control" placeholder="Nombre Producto" name="nombre" /></p>
			  		    			            <p><input type="text" class="form-control" placeholder="Marca Producto" name="marca" ></input></p>
			  		    			            <p><input type="text" class="form-control" placeholder="Importadora" name="importadora" ></input></p>
			  		    			            <p><input type="text" class="form-control" placeholder="Precio Neto" name="neto" ></input></p>
			  		    			            <p><textarea rows="4" class="form-control" type="text" placeholder="Notas" name="nota" ></textarea></p>
		  		    			            <p><input type="submit" class="button" value="Enviar"/></p>
		  		    			        </form>
		  		    			    </div>
		  		    			</div> 
			  		    	</div>
			  		  	</div>
			  		</div>
			  	</div>
			</div>
			<div class="content" id="ventas">
			  	<div class="row">
			  		<dl class="tabs" data-tab>
			  		  	<dd class="active"><a href="#cventa">Crear venta</a></dd>
			  		  	<dd><a href="#bventa">Borrar venta</a></dd>
			  		  	<dd><a href="#acventa">Actualizar una venta</a></dd>
			  		  	<dd><a href="#vventa">Ver ventas</a></dd>
			  		</dl>
			  		<div class="tabs-content">
			  			<div class="content active" id="cventa">
			  		    	<div class="row">
			  		            <?php
			  		            	$venta = pg_query("select producto.id_producto, producto.nombre, producto.marca, producto.importadora,producto.neto,producto.iva,producto.total,inventario.cantidad,producto.nota from producto,inventario where producto.id_producto=inventario.id_producto and NOT inventario.cantidad =0 order by producto.id_producto;");
			  		            ?>
		  		                <table>        
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
		  		                <tbody>
		  		                <?
		  		                    $i=1;
		  		                    while($row= pg_fetch_array($venta)){
		  		                        echo "<tr><td>".$i."</td>";
		  		                        echo "<td>".$row["id_producto"]."</td>";
		  		                        echo "<td>".$row["nombre"]."</td>";
		  		                        echo "<td>".$row["marca"]."</td>";
		  		                        echo "<td>".$row["importadora"]."</td>";
		  		                        echo "<td>".$row["neto"]."</td>";
		  		                        echo "<td>".$row["neto"]+$row["iva"]."</td>";                    
		  		                        echo "<td>".$row["cantidad"]."</td>";
		  		                        echo "<td>".$row["neto"]*$row["cantidad"]."</td>";
		  		                        echo "<td>".($row["neto"]+$row["iva"])*$row["cantidad"]."</td>";
		  		                        echo "<td>".$row["nota"]."</td></tr>";
		  		                        $i++;
		  		                    } 
		  		                ?>
		  		                </tbody>
		  		                </table>
		  		                <div class="row">
		  		                	<div class="large-6 large-centered columns">
					  		    		<form method="post" class="form-inline" role="form" action="fcaaventas.php" name="metodoweon">
					  		            <h3> Ingrese Venta </h3>
					  		                <p><input type="text" class="form-control" placeholder="Rut Cliente" id="rut" name="rut_cliente" /></p>
					  		                <p><input type="text" class="form-control" id="fecha" placeholder="Fecha" name="fecha" /></p>
					  		                <p><input type="text" class="form-control" placeholder="Rut Personal" id="rut2" name="rut_personal" /></p>            
					  		                <p><input type="text" class="form-control" placeholder="ID Producto" onchange="javascript:funcion();" name="id_producto" /></p>
					  		                <p><input type="text" class="form-control" placeholder="Cantidad" onchange="javascript:funcion();" name="cantidad" /> <div id="imprimir"></div> </p>
					  		                <p><input type="text" class="form-control" placeholder="Abono" name="abono" /></p>
					  		                <p><textarea rows="4" class="form-control" type="text" placeholder="Notas" name="nota" ></textarea></p>
					  		                <p><input class="button" type="submit" value="Enviar"/></p>
					  		            </form>
			  		    			</div>
			  		    		</div>
			  		    	</div>
			  		  	</div>
			  		  	<div class="content" id="bventa">
			  		    	<div class="row">
			  		    		<table>        
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
		  		                <tbody>
		  		                <?
		  		                    $i=1;
		  		                    while($row= pg_fetch_array($venta)){
		  		                        echo "<tr><td>".$i."</td>";
		  		                        echo "<td>".$row["id_producto"]."</td>";
		  		                        echo "<td>".$row["nombre"]."</td>";
		  		                        echo "<td>".$row["marca"]."</td>";
		  		                        echo "<td>".$row["importadora"]."</td>";
		  		                        echo "<td>".$row["neto"]."</td>";
		  		                        echo "<td>".$row["neto"]+$row["iva"]."</td>";                    
		  		                        echo "<td>".$row["cantidad"]."</td>";
		  		                        echo "<td>".$row["neto"]*$row["cantidad"]."</td>";
		  		                        echo "<td>".($row["neto"]+$row["iva"])*$row["cantidad"]."</td>";
		  		                        echo "<td>".$row["nota"]."</td></tr>";
		  		                        $i++;
		  		                    } 
		  		                ?>
		  		                </tbody>
		  		                </table>
			  		    		<div class="large-6 large-centered columns">
			  		    			<form method="post" class="form-inline" role="form" action="fbventa.php">
			  		    			<h3> Ingrese ID Venta </h3>
			  		    			    <p><input type="text" class="form-control" placeholder="ID Venta" name="id_venta" /></p>               
			  		    			    <p><input class="button" type="submit" value="Enviar"/></p>
			  		    			</form>
			  		    		</div>	
			  		    	</div>
			  		  	</div>
			  		  	<div class="content" id="acventa">
			  		  		<div class="row">
			  		    		<?php
	            					$acventa = pg_query("select venta.id_venta, venta.rut_cliente, venta.fecha, venta.rut_personal, venta.abono, venta.p_pagar, venta_detalle.id_producto, venta_detalle.cantidad,venta.total,venta_detalle.nota,venta_detalle.estado from venta,venta_detalle where venta.id_venta=venta_detalle.id_venta and not venta_detalle.estado='PAGADO' order by venta.id_venta;");
					            ?>
					            <table>       
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
					            <tbody>
					            <?
					                $i=1;
					                while($row= pg_fetch_array($acventa)){
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
					            ?>
					            </tbody>
								</table> 
					            <div class="large-6 large-centered columns">
						            <form method="post" class="form-inline" role="form" action="facventa.php">
						            <h3> Ingrese ID Venta </h3>
						                <p><input type="text" class="form-control" placeholder="ID Venta" name="id_venta" /></p>
						                <p><input type="text" class="form-control" placeholder="Abono" name="abono" /></p>                              
						                <p><textarea rows="4" class="form-control" type="text" placeholder="Notas" name="nota" ></textarea></p>
						                <p><input class="button" type="submit" value="Enviar"/></p>
						            </form>
					        	</div>
				  		    </div>
			  		  	</div>
			  		  	<div class="content" id="vventa">
			  		    	<div class="row">
			  		    		<?php
			  		    			$vventas = pg_query("select venta.rut_cliente, venta.fecha, personal.nombre, venta.abono, venta.p_pagar, producto.nombre as pnombre, venta_detalle.cantidad,venta.total,venta_detalle.nota,venta_detalle.estado from venta,venta_detalle,personal,producto where producto.id_producto = venta_detalle.id_producto and venta.rut_personal=personal.rut_personal and venta.id_venta=venta_detalle.id_venta order by venta.fecha;");
			  		    		?>
		  		    		    <table>
		  		    		                 
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
		  		    		    <tbody>
		  		    		        <?
		  		    		            $i=1;
		  		    		            while($row= pg_fetch_array($vventas)){
		  		    		                if($row["estado"]=="PAGADO"){
		  		    		                    echo "<tr class=\"success\">";
		  		    		                }
		  		    		                else 
		  		    		                    echo "<tr class=\"danger\">";         

		  		    		                echo "<tr><td>";
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
		  		    		        ?>
		  		    		    </tbody>
		  		    		    </table>
			  		    	</div>
			  		  	</div>
			  		</div>
			  	</div>
			</div>
		  	<div class="content" id="clientes">
		    	<div class="row">
		    		<dl class="tabs" data-tab>
		    		  	<dd class="active"><a href="#aclientes">Agregar cliente</a></dd>
		    		  	<dd><a href="#bclientes">Borrar cliente</a></dd>
		    		  	<dd><a href="#lclientes">Listar clientes</a></dd>
		    		  	<dd><a href="#mcliente">Modificar clientes</a></dd>
		    		</dl>
		    		<div class="tabs-content">
		    			<div class="content active" id="aclientes">
	    					<div class="large-6 large-centered columns">
			    		    	<form method="post" class="form-inline" role="form" action="faclientes.php">
		    		    	        <h3> Ingrese Cliente</h3>
		    		    	        <p><input type="text" class="form-control" placeholder="Rut" id="rut" name="rut_cliente"/></p>
		    		    	        <p><input type="text" class="form-control" placeholder="Nombre" name="nombre" /></p>
		    		    	        <p><input type="text" class="form-control" placeholder="Numero Telefonico" name="numero" /></p>
		    		    	        <p><input type="email" class="form-control" placeholder="test@ejemplo.com" name="correo" /></p>
		    		    	        <p><input type="text" class="form-control" placeholder="Direccion" name="direccion" /></p>
		    		    	        <p><input type="submit" class="button" value="Enviar"/></p>
			    		    	</form>
			    		    </div>
		    		  	</div>
		    		  	<div class="content" id="bclientes">
		    		  		<div class="row">
			    		    	<?php
			    		    	    
			    		    	    $clientes = pg_query("select * from cliente where cliente.activo=1 order by rut_cliente;");
			    		    	?>
		    		    	    <table>
		    		    	    <thead>
		    		    	        <tr>
		    		    	            <th>#</th>
		    		    	            <th>ID</th>
		    		    	            <th>Rut</th>
		    		    	            <th>Nombre</th>
		    		    	            <th>Telefono</th>
		    		    	            <th>Correo</th>
		    		    	            <th>Direccion</th>
		    		    	        </tr>
		    		    	    </thead> 
		    		    	    <tbody>
		    		    	    <?
		    		    	        $i=1;
		    		    	        while($row= pg_fetch_array($clientes)){
		    		    	            echo "<tr><td>".$i."</td>";
		    		    	            echo "<td>".$row["id_cliente"]."</td>";
		    		    	            echo "<td>".$row["rut_cliente"]."</td>";
		    		    	            echo "<td>".$row["nombre"]."</td>";
		    		    	            echo "<td> ".$row["numero"]."</td>";
		    		    	            echo "<td> ".$row["correo"]."</td>";
		    		    	            echo "<td> ".$row["direccion"]."</td></tr>";
		    		    	            $i++;
		    		    	        }
		    		    	    ?>
		    		    	    </tbody>    
		    		    	    </table>
		    		    		<div class="large-6 large-centered columns">
				    		    	<form method="post" class="form-inline" role="form" action="fbclientes.php">
				    		    	    <h3> Ingrese Rut Cliente</h3>
				    		    	    <p><input type="text" class="form-control" placeholder="Rut:12345678-1"  id="rut"  name="rut_cliente" /></p>
				    		    	    <p><input type="submit" class="button" value="Enviar"/></p>
				    		    	</form>
	    		    			</div>
		    		  		</div>
		    		  	</div>
		    		  	<div class="content" id="lclientes">
		    		    	<div class="row">
		    		    	<table>
		    		    	    <thead>
		    		    	        <tr>
		    		    	            <th>#</th>
		    		    	            <th>ID</th>
		    		    	            <th>Rut</th>
		    		    	            <th>Nombre</th>
		    		    	            <th>Telefono</th>
		    		    	            <th>Correo</th>
		    		    	            <th>Direccion</th>
		    		    	        </tr>
		    		    	    </thead> 
		    		    	    <tbody>
		    		    	    <?
		    		    	        $i=1;
		    		    	        while($row= pg_fetch_array($clientes)){
		    		    	            echo "<tr><td>".$i."</td>";
		    		    	            echo "<td>".$row["id_cliente"]."</td>";
		    		    	            echo "<td>".$row["rut_cliente"]."</td>";
		    		    	            echo "<td>".$row["nombre"]."</td>";
		    		    	            echo "<td> ".$row["numero"]."</td>";
		    		    	            echo "<td> ".$row["correo"]."</td>";
		    		    	            echo "<td> ".$row["direccion"]."</td></tr>";
		    		    	            $i++;
		    		    	        }
		    		    	    ?>
		    		    	    </tbody>    
		    		    	</table>
		    		    	</div>
		    		  	</div>
		    		  	<div class="content" id="mcliente">
		    		  		<div class="row">
		    		    	  	<table>            
		    		    	   	<thead>
		    		    	   		<tr>
		    		    	   			<th>#</th>
		    		    	   			<th>Id</th>
		    		    	   			<th>Rut</th>
		    		    	   			<th>Nombre</th>
		    		    	            <th>Telefono</th>
		    		    	            <th>Correo</th>
		    		    	            <th>Direccion</th>
		    		    	  		</tr>
		    		    	   	</thead> 
		    		    	    <tbody>
		    		    	    <?
		    		    	        $i=1;
		    		    	        while($row= pg_fetch_array($clientes)){
		    		    	            echo "<tr><td>".$i."</td>";
		    		    	            echo "<td>".$row["id_cliente"]."</td>";
		    		    	            echo "<td>".$row["rut_cliente"]."</td>";
		    		    	            echo "<td>".$row["nombre"]."</td>";
		    		    	            echo "<td> ".$row["numero"]."</td>";
		    		    	            echo "<td> ".$row["correo"]."</td>";
		    		    	            echo "<td> ".$row["direccion"]."</td></tr>";
		    		    	            $i++;
		    		    	        }
		    		    	    ?>
		    		    	    </tbody>    
			    		    	</table>
			    		    	<div class="large-6 large-centered columns">
		    		    	        <form method="post" class="form-inline" role="form" action="faccliente.php">
		    		    	            <h3> Ingrese Cliente a Actualizar</h3>
		    		    	            <p><input type="text" class="form-control" placeholder="Rut Cliente(obligatorio)" id="rut" name="rut_cliente" /></p>
		    		    	            <p><input type="text" class="form-control" placeholder="Nombre cliente(obligatorio)" name="nombre" ></input></p>
		    		    	            <p><input type="text" class="form-control" placeholder="Telefono(obligatorio)" name="numero" ></input></p>
		    		    	            <p><input type="email" class="form-control" placeholder="Correo(obligatorio)" name="correo" ></input></p>
		    		    	            <p><input type="text" class="form-control" placeholder="direccion(obligatorio)" name="direccion" ></input></p>
		    		    	            <p><input type="submit" class="button" value="Enviar"/></p>
		    		    	        </form>
	    		    	    	</div>
		    		  		</div>
		    			</div>
		  			</div>
		  		</div>
		  	</div>
		  	<div class="content" id="personal">
		    	<div class="row">
		    		<dl class="tabs" data-tab>
		    		  	<dd class="active"><a href="#apersonal">Agregar personal</a></dd>
		    		  	<dd><a href="#bpersonal">Borrar personal</a></dd>
		    		  	<dd><a href="#lpersonal">Listar personal</a></dd>
		    		  	<dd><a href="#mpersonal">Modificar personal</a></dd>
		    		</dl>
		    		<div class="tabs-content">
		    			<div class="content active" id="apersonal">
	    		    		<div class="large-6 large-centered columns">
		    		    		<form method="post" class="form-inline" role="form" action="fapersonal.php">
	    		    		    	<h3> Ingrese Personal</h3>
	    		    		        <p><input type="text" class="form-control" placeholder="Rut:12345678-1" id="rut" name="rut_personal" /></p>
	    		    		        <p><input type="text" class="form-control" placeholder="Nombre" name="nombre" /></p>
	    		    		        <p><input type="text" class="form-control" placeholder="Numero Telefonico" name="numero" /></p>
	    		    		        <p><input type="email" class="form-control" placeholder="test@ejemplo.com" name="correo" /></p>
	    		    		        <p><input type="text" class="form-control" placeholder="Direccion" name="direccion" /></p>
	    		    		        <p><input type="text" class="form-control" placeholder="Cargo" name="cargo" /></p>
	    		    		        <p><input type="submit" class="button" value="Enviar"/></p>
		    		    		</form>
		    		    	</div> 
		    		  	</div>
		    		  	<div class="content" id="bpersonal">
		    		    	<div class="row">
		    		    		<?php
		    		    		    $personal = pg_query("select * from personal where personal.vigente=1;");
		    		    		?>
	    		    		    <table>
	    		    		                 
	    		    		    <thead>
	    		    		        <tr>
	    		    		            <th>#</th>
	    		    		            <th>ID</th>
	    		    		            <th>Rut</th>
	    		    		            <th>Nombre</th>
	    		    		            <th>Telefono</th>
	    		    		            <th>Correo</th>
	    		    		            <th>Direccion</th>
	    		    		            <th>Cargo</th>
	    		    		        </tr>
	    		    		    </thead> 
	    		    		    <tbody>
	    		    		    <?
	    		    		        $i=1;
	    		    		        while($row= pg_fetch_array($personal)){
	    		    		            echo "<tr><td>".$i."</td>";
	    		    		            echo "<td>".$row["id_personal"]."</td>";
	    		    		            echo "<td>".$row["rut_personal"]."</td>";
	    		    		            echo "<td> ".$row["nombre"]."</td>";
	    		    		            echo "<td> ".$row["numero"]."</td>";
	    		    		            echo "<td> ".$row["correo"]."</td>";
	    		    		            echo "<td> ".$row["direccion"]."</td>";
	    		    		            echo "<td> ".$row["cargo"]."</td></tr>";
	    		    		            $i++;
	    		    		        }  
	    		    		    ?> 
	    		    		    </tbody> 
	    		    		    </table>
	    		    			<div class="large-6 large-centered columns">
		    		    			<form method="post" class="form-inline" role="form" action="fbpersonal.php">
		    		    		    <h3> Ingrese Rut Personal</h3>
		    		    		    <p><input type="text" class="form-control" placeholder="Rut:12345678-1" id="rut"  name="rut_personal" /></p>
		    		    		    <p><input type="submit" class="button" value="Enviar"/></p>
	    		    				</form> 
	    		    			</div>
		    		  		</div>
		    		  	</div>
		    		  	<div class="content" id="lpersonal">
		    		    	<div class="row">
		    		    		<table>
		    		    		<thead>
		    		    		    <tr>
		    		    		        <th>#</th>
		    		    		        <th>ID</th>
		    		    		        <th>Rut</th>
		    		    		        <th>Nombre</th>
		    		    		        <th>Telefono</th>
		    		    		        <th>Correo</th>
		    		    		        <th>Direccion</th>
		    		    		        <th>Cargo</th>
		    		    		    </tr>
		    		    		</thead> 
		    		    		<tbody>
		    		    		<?
		    		    		    $i=1;
		    		    		    while($row= pg_fetch_array($personal)){
		    		    		        echo "<tr><td>".$i."</td>";
		    		    		        echo "<td>".$row["id_personal"]."</td>";
		    		    		        echo "<td>".$row["rut_personal"]."</td>";
		    		    		        echo "<td> ".$row["nombre"]."</td>";
		    		    		        echo "<td> ".$row["numero"]."</td>";
		    		    		        echo "<td> ".$row["correo"]."</td>";
		    		    		        echo "<td> ".$row["direccion"]."</td>";
		    		    		        echo "<td> ".$row["cargo"]."</td></tr>";
		    		    		        $i++;
		    		    		    }  
		    		    		?> 
		    		    		</tbody> 
		    		    		</table>
		    		    	</div>
		    		  	</div>
		    		  	<div class="content" id="mpersonal">
		    		    	<div class="row">
	    		    		    <table>        
	    		    		   	<thead>
	    		    		   		<tr>
	    		    		   			<th>#</th>
	    		    		   			<th>ID</th>
	    		    		   			<th>Rut</th>
	    		    		   			<th>Nombre</th>
	    		    		            <th>Telefono</th>
	    		    		            <th>Correo</th>
	    		    		            <th>Direccion</th>
	    		    		            <th>Cargo</th>
	    		    		  		</tr>
	    		    		   	</thead> 
	    		    		    <tbody>
		    		    		<?
		    		    		    $i=1;
		    		    		    while($row= pg_fetch_array($personal)){
		    		    		        echo "<tr><td>".$i."</td>";
		    		    		        echo "<td>".$row["id_personal"]."</td>";
		    		    		        echo "<td>".$row["rut_personal"]."</td>";
		    		    		        echo "<td> ".$row["nombre"]."</td>";
		    		    		        echo "<td> ".$row["numero"]."</td>";
		    		    		        echo "<td> ".$row["correo"]."</td>";
		    		    		        echo "<td> ".$row["direccion"]."</td>";
		    		    		        echo "<td> ".$row["cargo"]."</td></tr>";
		    		    		        $i++;
		    		    		    }  
		    		    		?> 
		    		    		</tbody> 
		    		    		</table>
		    		    		<div class="row">
		    		    			<div class="large-6 large-centered columns">
		    		    				<form method="post" class="form-inline" role="form" action="facpersonal.php">
			    		    		        <h3> Ingrese Personal</h3>
			    		    		        <p><input type="text" class="form-control" placeholder="Rut:12345678-1" id="rut" name="rut_personal" /></p>
			    		    		        <p><input type="text" class="form-control" placeholder="Nombre" name="nombre" /></p>
			    		    		        <p><input type="text" class="form-control" placeholder="Numero Telefonico" name="numero" /></p>
			    		    		        <p><input type="email" class="form-control" placeholder="test@ejemplo.com" name="correo" /></p>
			    		    		        <p><input type="text" class="form-control" placeholder="Direccion" name="direccion" /></p>
			    		    		        <p><input type="text" class="form-control" placeholder="Cargo" name="cargo" /></p>
			    		    		        <p><input type="submit" class="button" value="Enviar"/></p>
		    		    				</form> 
		    		    			</div>
		    		    		</div>
		    		    	</div>
		    		  	</div>
		    		</div>
		    	</div>
		  	</div>
		</div>
	</div>


	<footer class="row">
		<hr>
		<div class="right">
		    <p>© Copyright too Sugoi | 2014</p>
		</div> 
	</footer>

    <script type="text/javascript">
        // When the document is ready
        $(document).ready(function () {
            
            $('#fecha').datepicker({
                format: "mm/dd/yyyy"
            });  
            $('#rut').Rut({
				on_error: function(){ alert('Rut incorrecto');}
			});
            $('#rut2').Rut({
                on_error: function(){ alert('Rut incorrecto');}
            });
        });
    </script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.topbar.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    <script src="js/foundation/foundation.tab.js"></script>
    <script>
  		$(document).foundation({
    		tab: {
      			callback : function (tab) {
        		console.log(tab);
      			}
    		}
  		});
	</script>
</body>
</html>
