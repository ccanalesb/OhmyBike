<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Borrando Producto | OhMyBike! </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php     
				

			if (isset($_POST["id_producto"]) and $_POST["id_producto"] !=""){

				$id_producto = $_POST["id_producto"];
				$consulta = pg_query("SELECT count(*) from producto where producto.id_producto='$id_producto';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					pg_query("DELETE FROM producto WHERE id_producto='$id_producto';");
					echo "<center><td><h1> Se Anulo del producto: $id_producto </td></center>";
				} 
				else 
				{
					echo "<center><p><h1>No existe Producto</p></center>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el  <a href=\"bproductos.php\">formulario</a></p></center>";
			}
			echo "<br><br>";
			echo "<center><a class=\"btn btn-info\" href=\"productos.php\">Producto</a></center>";            
			?> 
    </body>
</html>
