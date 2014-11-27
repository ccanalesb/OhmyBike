<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title>Actualizando Personal | OhMyBike! </title>
    </head>
    <body>
        <br><br><br>
         <?php            
            $result = pg_query("select * from personal where personal.vigente=1;");
            ?>
            <table class="table table-hover">
                         
           	<thead>
           		<tr>
           			<th>#</th>
           			<th>ID</th>
           			<th>Rut</th>
           			<th>Nombre</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th>
                    <th>Cargo</th>
          		</tr>
           	</thead> 
            <?
                $i=1;
                while($row=pg_fetch_array($result)){
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $row["id_personal"];
                    echo "</td>";
                    echo "<td>";
                    echo $row["rut_personal"];
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
                    echo "<td> ";
                    echo $row["cargo"];
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }    
            echo "</table>";
                             
        ?> 
        <center><form method="post" class="form-inline" role="form" action="facpersonal.php">
                <legend> Ingrese Personal</legend>
                <p><input type="text" class="form-control" placeholder="Rut:12345678-1" id="rut" name="rut_personal" /></p>
                <p><input type="text" class="form-control" placeholder="Nombre" name="nombre" /></p>
                <p><input type="text" class="form-control" placeholder="Numero Telefonico" name="numero" /></p>
                <p><input type="email" class="form-control" placeholder="test@ejemplo.com" name="correo" /></p>
                <p><input type="text" class="form-control" placeholder="Direccion" name="direccion" /></p>
                <p><input type="text" class="form-control" placeholder="Cargo" name="cargo" /></p>
                <p><input type="submit" class="btn btn-lg btn-success" value="Enviar"/></p>
        </form> 
        </center>
        <center><a class="btn btn-info" href="personal.php">Personal</a></center>
        <br><br>
    </body>
</html>


