<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Borrando Personal | OhMyBike! </title>
    </head>
    <body>
    		
    		<br><br><br>
			<?php   
				if (isset($_POST["rut_personal"]) and $_POST["rut_personal"] !=""){

				$rut_personal = $_POST["rut_personal"];
				$cantidad= -1;
				$consulta = pg_query("SELECT count(*) from personal where personal.rut_personal='$rut_personal';");
				$consulta2= pg_query("SELECT personal.vigente from personal where personal.rut_personal='$rut_personal';");
				$res= pg_fetch_array($consulta);
				$res2=pg_fetch_array($consulta2);
				
				if ($res["count"] == 1 and $res2["vigente"]==1)
				{
					pg_query("UPDATE personal SET vigente=$cantidad WHERE personal.rut_personal='$rut_personal';");
					echo "<center><td><h1> Se elimino a: $rut_personal <h1></td></center>";
				} 
				else if($res2==0)
				{
					echo "<center><p><h1>Usuario anteriormente borrado</p></center>";
					echo "<center><a class=\"btn btn-info\" href=\"personal.php\">Personal</a></center>";
				}
				else 
				{
					echo "<center><p><h1>No existe Personal</p></center>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el <a href=\"bpersonal.php\">formulario</a></p></center>";
			}
			echo "<center><a class=\"btn btn-info\" href=\"personal.php\">Personal</a></center>"; 
			echo "<br><br>";            
			?> 
    </body>
</html>

