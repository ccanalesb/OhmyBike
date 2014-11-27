<!DOCTYPE HTML>
<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Agregar Cliente </title>
    </head>
    <body>
    		
			<br><br><br>
			<?php		
				
			if (isset($_POST["rut_cliente"], $_POST["nombre"], $_POST["numero"], $_POST["correo"], $_POST["direccion"]) and $_POST["rut_cliente"] !="" and $_POST["nombre"]!="" and $_POST["numero"] !="" and $_POST["correo"] !="" and $_POST["direccion"] !=""){

				$rut_cliente = $_POST["rut_cliente"];
				$nombre = $_POST["nombre"];
				$numero = $_POST["numero"];
				$correo = $_POST["correo"];			
				$direccion = $_POST["direccion"];
				$activo = 1;
				$consulta = "INSERT INTO cliente (rut_cliente,nombre,numero,correo,direccion,activo) VALUES ('$rut_cliente','$nombre',$numero,'$correo ','$direccion','$activo')";
				$consulta1 = pg_query("select count(*) from cliente where cliente.rut_cliente='$rut_cliente';");
				$res= pg_fetch_array($consulta1);
				if ($res["count"] == 1)
				{
					pg_query("UPDATE cliente SET activo=$activo WHERE rut_cliente='$rut_cliente';");
					echo "<center><td><h1> Se reactivo al Cliente rut: $rut_cliente <p> Se conservaron los datos</p></td></center>";
				} 		
				else if (pg_query($consulta))
				{
					echo "<p><center><h1>Registro agregado</center></p>";
				} 
				else {
					echo "<p><center><h1>No se agrego</center></p>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el  <a href=\"aclientes.php\">formulario</a></p></center>";
			}

			echo "<center><a class=\"btn btn-info\" href=\"clientes.php\">Cliente</a></center>";         

			            
			?> 
    </body>
</html>
