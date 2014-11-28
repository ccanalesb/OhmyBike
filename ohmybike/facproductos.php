<html>
    <head>
	 	<?php include "inc.php"; ?>
	 	<?php include "conectar.php"; ?>
        <title> Actualizando Producto | OhMyBike! </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php     
				
			if(isset($_POST["id_producto"],$_POST["nombre"], $_POST["marca"], $_POST["importadora"], $_POST["neto"], $_POST["nota"]) and $_POST["nombre"] !="" and $_POST["neto"]!="" and $_POST["marca"]!="" and $_POST["importadora"]!="" and $_POST["id_producto"]!=""){

				$id_producto = $_POST["id_producto"];
				$nombre = $_POST["nombre"];
				$marca = $_POST["marca"];
				$importadora = $_POST["importadora"];
				$neto = $_POST["neto"];
				$nota = $_POST["nota"];
				$iva = $neto*0.19;
				$total= $iva+$neto;
				$consulta = pg_query("SELECT count(*) from producto where producto.id_producto='$id_producto';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					pg_query("UPDATE producto SET nombre='$nombre', marca='$marca', importadora='$importadora', neto=$neto, nota='$nota', iva=$iva, total=$total WHERE id_producto='$id_producto';");
					echo "<center><td><h1>Se actualizo el producto: $id_producto</td></center>";
				} 
				else {
					echo "<center><p><h1>No existe Producto</p></center>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el formulario</a></p></center>";
			}

			header("Location: home.php");
			            
			?> 
    </body>
</html>
