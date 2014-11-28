<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Borrando Cliente | OhMyBike! </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php     
				

			if (isset($_POST["rut_cliente"]) and $_POST["rut_cliente"] !=""){

				$rut_cliente = $_POST["rut_cliente"];
				$activo = 0;
				$consulta = pg_query("select count(*) from cliente where cliente.rut_cliente='$rut_cliente';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					pg_query("UPDATE cliente SET activo=$activo WHERE rut_cliente='$rut_cliente';");
					echo "<center><td><h1> Se elimino al Cliente rut: $rut_cliente</td></center>";
				} 
				else {
					echo "<center><p><h1>No existe Cliente</p></center>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el formulario</a></p></center>";
			}
  
			header("Location: home.php");            
			?> 
    </body>
</html>
