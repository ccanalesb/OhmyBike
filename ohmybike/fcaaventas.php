<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Crear Venta | OhMyBike! </title>
    </head>
    <body>
    		
			<br><br><br>
			<?php     
				

			if (isset($_POST["rut_cliente"],$_POST["fecha"], $_POST["rut_personal"], $_POST["abono"], $_POST["id_producto"], $_POST["cantidad"],$_POST["nota"]) and $_POST["cantidad"]!="" and $_POST["id_producto"]!="" and $_POST["abono"] !=""and $_POST["rut_cliente"] !="" and $_POST["fecha"] !="" and $_POST["rut_personal"] != ""){

				$rut_cliente = $_POST["rut_cliente"];
                $fecha = $_POST["fecha"];
                $rut_personal = $_POST["rut_personal"];
                $abono = $_POST["abono"];
                $id_producto = $_POST["id_producto"];
                $cantidad = $_POST["cantidad"];
                $nota = $_POST["nota"];  

                $consulta_cliente = pg_query("SELECT count(*) from cliente where cliente.rut_cliente='$rut_cliente';");
                $res_cliente= pg_fetch_array($consulta_cliente);
                if ($res_cliente["count"] == 1 and $cantidad >= 0) {    

                    $consulta_personal = pg_query("SELECT count(*) from personal where personal.rut_personal='$rut_personal';");
                    $res_personal= pg_fetch_array($consulta_personal);
                    if ($res_personal["count"] == 1) {

                        $consulta_producto = pg_query("SELECT count(*) from producto where producto.id_producto='$id_producto';");
                        $res_producto= pg_fetch_array($consulta_producto);
                        if ($res_producto["count"] == 1) {
                            
                            $consulta = pg_query("select producto.total from producto where producto.id_producto='$id_producto';");
                            $total_ = pg_fetch_array($consulta);
                            $total = $total_["total"];

                            $p_pagar= ($total*$cantidad)-$abono;
                            $consulta2 = pg_query("select inventario.cantidad from inventario where inventario.id_producto='$id_producto';"); 
                            $stock_ = pg_fetch_array($consulta2);
                            $stock = $stock_["cantidad"];
                            if($stock>=$cantidad){
                                $consulta_venta = "INSERT INTO venta (rut_cliente,fecha,rut_personal,abono,p_pagar,total) VALUES ('$rut_cliente','$fecha','$rut_personal',$abono,$p_pagar,$total) RETURNING (id_venta);";
                                $val = pg_query($consulta_venta);
                                $id_venta_ = pg_fetch_array($val);
                                $id_venta= $id_venta_["id_venta"];
                                if ($p_pagar==0) {
                                    $consulta_venta_detalle = "INSERT INTO venta_detalle(id_venta,id_producto, cantidad, nota, estado) VALUES ('$id_venta','$id_producto',$cantidad,'$nota','PAGADO');";
                                }
                                else {
                                    $consulta_venta_detalle = "INSERT INTO venta_detalle(id_venta,id_producto, cantidad, nota, estado) VALUES ('$id_venta','$id_producto',$cantidad,'$nota','EN DEUDA');";
                                }                               
                               
                                $final=$stock-$cantidad;
                                if (pg_query("UPDATE inventario SET cantidad=$final WHERE id_producto='$id_producto';"))
                                {
                                    
                                    pg_query($consulta_venta_detalle); 
                                    echo "<center><p><h1>Venta agregada</a></p></center>";  
                                        
                                                                   
                                }
                                                
                            } 
                            else {
                                echo "<center><p><h1>No hay suficientes productos</a></p></center>";
                            }
                        }
                        else {

                            echo "<center><p><h1>No existe producto</a></p></center>";
                        } 
                    }
                    else {
                        echo "<center><p><h1>No existe personal</a></p></center>";
                    } 
                }
                else{
                    echo "<center><p><h1>No existe cliente</a></p></center>";
                }          		    

			}
			else {
				echo "<center><p><h1>Por favor, complete el  <a href=\"caaventa.php\">formulario</a></p></center>";
			}
			
			echo "<center><a class=\"btn btn-info\" href=\"ventas.php\">Home</a></center>";  	
            ?>	
            <br><br>            
			

    </body>
</html>