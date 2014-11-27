<!DOCTYPE HTML>
<html>
    <head>
        <?php include "inc.php"; ?>
        <title>Agregar Cliente | OhMyBike! </title>
    </head>
    <body>
        <br><br><br>
        <center><form method="post" class="form-inline" role="form" action="faclientes.php">
                <legend> Ingrese Cliente</legend>
                <p><input type="text" class="form-control" placeholder="Rut" id="rut" name="rut_cliente"/></p>
                <p><input type="text" class="form-control" placeholder="Nombre" name="nombre" /></p>
                <p><input type="text" class="form-control" placeholder="Numero Telefonico" name="numero" /></p>
                <p><input type="email" class="form-control" placeholder="test@ejemplo.com" name="correo" /></p>
                <p><input type="text" class="form-control" placeholder="Direccion" name="direccion" /></p>
                <p><input type="submit" class="btn btn-lg btn-success" value="Enviar"/></p>
        </form></center>
        <center><a class="btn btn-info" href="clientes.php">Cliente</a></center>
        <br><br>
    </body>
</html>

