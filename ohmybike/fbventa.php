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
				
			if (isset($_POST["id_venta"]) and $_POST["id_venta"] !="" ){

				$id_venta = $_POST["id_venta"];				
				$consulta = pg_query("select count(*) from venta where venta.id_venta='$id_venta';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					$consulta_venta = pg_query("select venta_detalle.cantidad, venta_detalle.id_producto from venta_detalle where venta_detalle.id_venta=$id_venta;");
					$row_venta = pg_fetch_array($consulta_venta);
					$id_producto = $row_venta["id_producto"];
					$cantidad = $row_venta["cantidad"];
					$consulta_producto = pg_query("select inventario.cantidad from inventario where inventario.id_producto='$id_producto';");
					$row_producto = pg_fetch_array($consulta_producto);
					$cantidad_= $row_producto["cantidad"];	
					$cantidad_ = $cantidad_ + $cantidad;
					if(pg_query("UPDATE inventario SET cantidad=$cantidad_ WHERE id_producto='$id_producto';")){
						pg_query("DELETE from venta where venta.id_venta='$id_venta'");
						echo "<p><center><h1>Se anulo venta $id_venta</center></p>";
						echo "<p><center><h1>Se aumento en $cantidad el producto $id_producto </center></p>";
					}


				}			
				else {
					echo "<p><center><h1>No existe venta</center></p>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el formulario</a></p></center>";
			}    

			header("Location: home.php");        
			?> 
    </body>
</html>
