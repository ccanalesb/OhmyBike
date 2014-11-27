<html>
    <head>
        <title> Prueba </title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    </head>
    <body>
    		<img src="https://fbcdn-sphotos-b-a.akamaihd.net/hphotos-ak-xap1/t1.0-9/537138_251485084998111_1468033884_n.jpg" class="img-rounded">
			<br><br><br>
			<?php     
						$host="localhost";
	            		$user="b18665380_bdd";
	           			$pass="base2014";
	           			$bdname="b18665380_bdd";
			            $connect= pg_connect("host=$host user=$user password=$pass dbname=$bdname");
			            if(!$connect)
			                echo "<h1> No conectó </h1>";
			            else 
			                echo "";

			if (isset($_POST["nombre"], $_POST["precio"], $_POST["marca"]) and $_POST["nombre"] !="" and $_POST["precio"]!="" and $_POST["marca"]!="" ){

			$nombre = $_POST["nombre"];
			$precio = $_POST["precio"];
			$marca = $_POST["marca"];

			$consulta = "INSERT INTO producto (nombre,precio,marca) VALUES ('$nombre','$precio','$marca')";
			if (pg_query($consulta) ){
			echo "<p>Registro agregado.</p>";
			} else {
			echo "<p>No se agregó...</p>";
			}
			    
			}
			else {
			echo '<p>Por favor, complete el <a href="clase2.php">formulario</a></p>';
			}    
			echo "<a class=\"btn\" href=\"clase.php\">Home</a>";         

			            
			?> 
    </body>
</html>
