<html>
    <head>
        <title> Prueba </title>
        
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    </head>
    <body>
        
        <center><img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xap1/t1.0-9/537138_251485084998111_1468033884_n.jpg" class="img-rounded"></center>
        <br><br><br>
        <form method="post" action="agregar.php">
        <fieldset>
        <legend> Ingrese Producto</legend>
        <p>
        <label> Nombre Producto:
        <input type="text" name="nombre" />
        </label>
        </p>
        <p>
        <label> Precio Producto
        <input type="text" name="precio" />
        </label>
        </p>
        <p>
        <label> Marca Producto
        <input name="marca" ></input>
        </label>
        </p>
        <p>
        <input type="submit" value="enviar"/>
        </p>
        </fieldset>
        </form> 
        <?php     
            
            
            
        ?> 
    </body>
</html>
