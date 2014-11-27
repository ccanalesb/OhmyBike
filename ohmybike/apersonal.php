<!DOCTYPE HTML>
<html>
    <head>
        <title>Agregar Personal | OhMyBike! </title>
        <?php include "inc.php"; ?>
    </head>
    <body>
        
        <br><br><br>
        <form method="post" class="form-inline" role="form" action="fapersonal.php">
            <center>
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


