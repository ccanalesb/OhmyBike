<html>
	<link rel="shortcut icon" href="http://favicon-generator.org/favicons/2014-06-17/73652ad11738752e25fd83969daed401.ico"> 
	<br>     
	<center><img src="http://i1081.photobucket.com/albums/j345/dennis_yeah/aa_zps23932162.png~original" class="img-rounded"></center>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/datepicker.css">
    <!-- <body background="http://p1.pichost.me/i/45/1685509.jpg"> -->

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.Rut.js"></script> 
    <script type="text/javascript">
        // When the document is ready
        $(document).ready(function () {
            
            $('#fecha').datepicker({
                format: "mm/dd/yyyy"
            });  
            $('#rut').Rut({
				on_error: function(){ alert('Rut incorrecto');}
			});
            $('#rut2').Rut({
                on_error: function(){ alert('Rut incorrecto');}
            });
        });
    </script>
</html>
