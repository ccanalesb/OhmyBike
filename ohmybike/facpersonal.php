<html>
    <head>
	 	<?php include "inc.php"; ?>
	 	<?php include "conectar.php"; ?>
        <title> Actualizando Personal | OhMyBike! </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php

			if (isset($_POST["rut_personal"],$_POST["nombre"],$_POST["numero"],$_POST["correo"],$_POST["direccion"],$_POST["cargo"]) and $_POST["rut_personal"] !="" and $_POST["nombre"] !="" and $_POST["cargo"] !="" and $_POST["numero"] !="" and $_POST["correo"] !="" and $_POST["direccion"] != ""){

				$rut_personal = $_POST["rut_personal"];
				$nombre = $_POST["nombre"];
				$numero = $_POST["numero"];
				$correo = $_POST["correo"];
				$direccion = $_POST["direccion"];
				$cargo = $_POST["cargo"];
				$vigente = 1;
				
				$consulta = pg_query("SELECT count(*) from personal where personal.rut_personal='$rut_personal';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					pg_query("UPDATE personal SET nombre='$nombre', numero=$numero, correo='$correo', direccion='$direccion', cargo='$cargo', vigente=$vigente WHERE rut_personal='$rut_personal';");
					echo "<center><td><h1>Se actualizo el personal: $rut_personal</td></center>";
				} 
				else {
					echo "<center><p><h1>No existe Personal</p></center>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el <a href=\"acpersonal.php\">formulario</a></p></center>";
			}

			echo "<center><a class=\"btn btn-info\" href=\"personal.php\">Personal</a></center>";
			echo "<br><br>";
			?> 
    </body>
</html>
