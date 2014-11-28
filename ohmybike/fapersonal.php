<!DOCTYPE HTML>
<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Agregando Personal | OhMyBike! </title>
    </head>
    <body>
    		
			<br><br><br>

			<?php		
				
			if (isset($_POST["rut_personal"], $_POST["nombre"], $_POST["numero"], $_POST["correo"], $_POST["direccion"], $_POST["cargo"]) and $_POST["rut_personal"] !="" and $_POST["nombre"]!="" and $_POST["numero"]!="" and $_POST["direccion"]!="" and $_POST["cargo"]){

				$rut_personal = $_POST["rut_personal"];
				$nombre = $_POST["nombre"];
				$numero = $_POST["numero"];
				$correo = $_POST["correo"];			
				$direccion = $_POST["direccion"];
				$cargo = $_POST["cargo"];
				$vigente = 1;

				$consulta = "INSERT INTO personal (rut_personal,nombre,numero,correo,direccion,cargo,vigente) VALUES ('$rut_personal','$nombre','$numero','$correo','$direccion','$cargo',$vigente)";

				if (pg_query($consulta))
				{
					echo "<p><center><h1>Registro agregado</center></p>";
				} 
				else {
					echo "<p><center><h1>No se agrego</center></p>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el formulario</a></p></center>";
			}

			header("Location: home.php");	            
			?> 
    </body>
</html>

