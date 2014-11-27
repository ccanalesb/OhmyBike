 <!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Mostrando Clientes a Actualizar</title>
    </head>
    <body>
        <br><br><br>
        <?php
            $result = pg_query("select * from cliente where cliente.activo=1;");
        ?>
            <table class="table table-hover">            
           	<thead>
           		<tr>
           			<th>#</th>
           			<th>Rut</th>
           			<th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th>
          		</tr>
           	</thead> 
            <?
                $i=1;
                while($row= pg_fetch_array($result)){
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $row["rut_cliente"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["nombre"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["numero"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["correo"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["direccion"];
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }    
                echo "</table>";           
        	?>
                <center>
                <form method="post" class="form-inline" role="form" action="faccliente.php">
                    <legend> Ingrese Cliente a Actualizar</legend>
                    <p><input type="text" class="form-control" placeholder="Rut Cliente(obligatorio)" id="rut" name="rut_cliente" /></p>
                    <p><input type="text" class="form-control" placeholder="Nombre cliente(obligatorio)" name="nombre" ></input></p>
                    <p><input type="text" class="form-control" placeholder="Telefono(obligatorio)" name="numero" ></input></p>
                    <p><input type="email" class="form-control" placeholder="Correo(obligatorio)" name="correo" ></input></p>
                    <p><input type="text" class="form-control" placeholder="direccion(obligatorio)" name="direccion" ></input></p>
                    <p><input type="submit" class="btn btn-lg btn-success" value="Enviar"/></p>
                </form> 
                </center> 

                <center><a class="btn btn-info" href="clientes.php">Clientes</a></center> 
                <br><br>  
    </body>
</html>