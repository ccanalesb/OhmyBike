<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Borrando Producto | OhMyBike! </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php     
				

			if (isset($_POST["id_producto"],$_POST["cantidad"]) and $_POST["id_producto"] !=""){

				$id_producto = $_POST["id_producto"];
				$cantidad= $_POST["cantidad"];
				$consulta = pg_query("SELECT count(*) from producto where producto.id_producto='$id_producto';");
				$consulta2= pg_query("SELECT cantidad from inventario where inventario.id_producto='$id_producto';");
				$res= pg_fetch_array($consulta);
				$res2=pg_fetch_array($consulta2);
				$res3=$res2["cantidad"]-$cantidad;
				if($cantidad<=0){
					echo " <center><td><p><h1> Parametro invalido </h1></p></td></center> ";
				}
				else if ($res["count"] == 1 and $res3>=0 and $cantidad>=0)
				{
					pg_query("UPDATE inventario SET cantidad=$res3 WHERE id_producto='$id_producto';");
					echo "<center><td><h1> Se elimino del producto: $id_producto $cantidad unidad(es)<h1></td></center>";
				} 
				else if($res3<0 and $cantidad>=0)
				{
					echo "<center><p><h1>Sobrepaso cantidad</p></center>";
				}
				else 
				{
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
