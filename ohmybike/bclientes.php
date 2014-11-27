<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <?php include "conectar.php"; ?>
        <title> Borrando Cliente | OhMyBike! </title>
    </head>
    <body>
        
        <br><br><br>
        <?php
            
            $result = pg_query("select * from cliente where cliente.activo=1 order by rut_cliente;");
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
                </tr>
            </thead> 
            <?
                $i=1;
                while($row= pg_fetch_array($result)){
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $row["id_cliente"];
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
            <form method="post" class="form-inline" role="form" action="fbclientes.php">
            <legend> Ingrese Rut Cliente</legend>
            <p><input type="text" class="form-control" placeholder="Rut:12345678-1"  id="rut"  name="rut_cliente" /></p>
            <p><input type="submit" class="btn btn-lg btn-success" value="Enviar"/></p>
        </form> 
        </center>
        <center><a class="btn btn-info" href="clientes.php">Cliente</a></center>
        <br><br>
    </body>
</html>

