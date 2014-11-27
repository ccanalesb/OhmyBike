<!DOCTYPE HTML>
<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Actualizando Cliente </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php   
				
			if (isset($_POST["rut_cliente"], $_POST["nombre"], $_POST["numero"], $_POST["correo"], $_POST["direccion"]) and $_POST["rut_cliente"] !="" and $_POST["nombre"]!="" and $_POST["numero"] !="" and $_POST["correo"]!="" and $_POST["direccion"] !=""){

				$rut_cliente = $_POST["rut_cliente"];
				$nombre = $_POST["nombre"];
				$numero = $_POST["numero"];
				$correo = $_POST["correo"];
				$direccion = $_POST["direccion"];
				
				$consulta = pg_query("SELECT count(*) from cliente where cliente.rut_cliente='$rut_cliente';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					pg_query("UPDATE cliente SET nombre='$nombre', numero=$numero, correo='$correo', direccion='$direccion' WHERE rut_cliente='$rut_cliente';");
					echo "<center><td><h1>Se actualizo el cliente: $rut_cliente</td></center>";
				} 
				else {
					echo "<center><p><h1>No existe Cliente</p></center>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el  <a href=\"accliente.php\">formulario</a></p></center>";
			}

			     
			?> 
			<center><a class="btn btn-info" href="clientes.php">Cliente</a></center>
    </body>
</html>
