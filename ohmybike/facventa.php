<!DOCTYPE HTML>
<html>
    <head>
    	<?php include "inc.php"; ?>
    	<?php include "conectar.php"; ?>
        <title> Actualizar Venta | OhMyBike! </title>
    </head>
    <body>
    		
			<br><br><br>
			<?php		
				
			if (isset($_POST["id_venta"],$_POST["abono"],$_POST["nota"]) and $_POST["id_venta"] !="" and $_POST["abono"]!="" and $_POST["nota"]!=""){

				$id_venta = $_POST["id_venta"];	
				$abono = $_POST["abono"];
				$nota = $_POST["nota"];			
				$consulta = pg_query("select count(*) from venta where venta.id_venta='$id_venta';");
				$res= pg_fetch_array($consulta);
				if ($res["count"] == 1)
				{
					$consulta_venta = pg_query("select venta.abono,venta.p_pagar from venta where venta.id_venta=$id_venta;");
					$row_venta = pg_fetch_array($consulta_venta);
					$abono_ = $row_venta["abono"];
					$p_pagar = $row_venta["p_pagar"];
					$nuevo_m = $abono_+$abono;
					$p_pagar2 = $p_pagar -$abono;
					if($abono<$p_pagar){
						if(pg_query("UPDATE venta SET abono=$nuevo_m,p_pagar=$p_pagar2 WHERE id_venta='$id_venta';"))
						{
							pg_query("UPDATE venta_detalle SET nota='$nota' WHERE id_venta='$id_venta';");
							echo "<p><center><h1>Se actualizo venta $id_venta</center></p>";
							echo "<p><center><h1>Se abono $abono a la venta</center></p>";
						}
						else {
							echo "<center><p><h1>Error</a></p></center>";
						}
					}
					else if($abono == $p_pagar){
						if(pg_query("UPDATE venta SET abono=$nuevo_m, p_pagar=$p_pagar2 WHERE id_venta='$id_venta';")){

								pg_query("UPDATE venta_detalle SET nota='$nota',estado='PAGADO' WHERE id_venta='$id_venta';");
								echo "<p><center><h1>Se actualizo venta $id_venta</center></p>";
							}

						else{
							echo "<center><p><h1>Error</a></p></center>";
						}

					}
					else{
						echo "<center><p><h1>Excede el maximo</a></p></center>";				
					}


				}			
				else {
					echo "<p><center><h1>No existe venta</center></p>";
				}
			    
			}
			else {
				echo "<center><p><h1>Por favor, complete el formulario</a></p></center>";
			}
			header("Location: home.php"); 
			?> 
    </body>
</html>
