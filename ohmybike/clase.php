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
                echo "<h1>[No Conectó] </h1>";
            else 
                echo "<h1> </h1>";
            $result = pg_query("select rut_persona,categoria from cliente;");
            echo "<a class=\"btn\" href=\"clase2.php\">Insertar Producto</a>";
            ?>
            <table class="table table-condensed">
            <tr class="success">                
            <?
                $i=1;
                while($row= pg_fetch_array($result)){
                    echo "<td>";
                    echo $i;
                    echo "</td>";
                    echo "<td>";
                    echo $row["rut_persona"];
                    echo "</td>";
                    echo "<td> ";
                    echo $row["categoria"];
                    echo "</td>";                   
                    echo "</tr>";
                    $i++;
                }    
            echo "</table>";                
            
            
        ?> 
    </body>
</html>
