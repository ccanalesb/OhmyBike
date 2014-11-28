<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Agregando Productos | OhMyBike! </title>
    </head>
    <body>
    		
			<br><br><br>
			<?php  

			$entro = false;

			if(isset($_POST["id_producto"], $_POST["cantidad"]) and $_POST["id_producto"] != "" and $_POST["cantidad"] != ""){
				$id_producto =$_POST["id_producto"];
				$cantidad = $_POST["cantidad"];
				$consulta = pg_query("SELECT count(*) from producto where producto.id_producto='$id_producto';");
				$res= pg_fetch_array($consulta);
				$consulta2= pg_query("SELECT cantidad from inventario where inventario.id_producto='$id_producto';");
				$res2=pg_fetch_array($consulta2);
				$res3=$res2["cantidad"]+$cantidad;
				if ($res["count"] == 1) {
					if(pg_query("UPDATE inventario SET cantidad=$res3 WHERE id_producto='$id_producto';")){
						echo "<center><td><h1> Se agrego al producto: $id_producto $cantidad unidades <h1></td></center>";
						$entro = true;
					}
					else{
						echo "<p><center><h1>No se agrego</center></p>";
					}
				}
			} 

			if(isset($_POST["id_producto"],$_POST["nombre"], $_POST["marca"], $_POST["importadora"], $_POST["neto"],$_POST["cantidad"], $_POST["nota"]) and $_POST["nombre"] !="" and $_POST["neto"]!="" and $_POST["marca"]!="" and $_POST["importadora"]!="" and $_POST["id_producto"]!=""and $entro == false){
				$id_producto =$_POST["id_producto"];
				$nombre = $_POST["nombre"];
				$marca = $_POST["marca"];
				$importadora = $_POST["importadora"];
				$neto = $_POST["neto"];
				$cantidad = $_POST["cantidad"];
				$nota = $_POST["nota"];
				$iva = round($neto*0.19);
				$total= $iva+$neto;

				// $consulta = pg_query("SELECT count(*) from producto where producto.id_producto='$id_producto';");
				// $res= pg_fetch_array($consulta);
				// $consulta2= pg_query("SELECT cantidad from inventario where inventario.id_producto='$id_producto';");
				$consulta3 = "INSERT INTO producto (id_producto,nombre,marca,importadora,nota,neto,iva,total) VALUES ('$id_producto', '$nombre','$marca','$importadora','$nota','$neto','$iva','$total')";
				// $res2=pg_fetch_array($consulta2);
				// $res3=$res2["cantidad"]+$cantidad;
				// if ($res["count"] == 1) {
				// 	pg_query("UPDATE inventario SET cantidad=$res3 WHERE id_producto='$id_producto';");
				// 	echo "<center><td><h1> Se agrego al producto: $id_producto $cantidad unidades <h1></td></center>";
				// }
				if ($cantidad>0)
				{	
					if(pg_query($consulta3))
					{
						pg_query("INSERT INTO inventario (id_producto,cantidad) values ('$id_producto', $cantidad);");
						echo "<p><center><h1>Registro agregado</center></p>";
					}
				} 
				else if ($cantidad==0)
				{	
					if(pg_query($consulta3))
					{
						pg_query("INSERT INTO inventario (id_producto,cantidad) values ('$id_producto', 0);");
						echo "<p><center><h1>Registro agregado</center></p>";
					}
				} 
				else{
					echo "<p><center><h1>No se agrego</center></p>";
				}
						    
			    
			}

			else if ($entro == false){
				echo "<center><p><h1>Por favor, complete el formulario</a></p></center>";
			}
			
			header("Location: home.php");		            
			?> 

    </body>
</html>
