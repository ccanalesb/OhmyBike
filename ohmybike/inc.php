<html>
	<link rel="shortcut icon" href="http://favicon-generator.org/favicons/2014-06-17/73652ad11738752e25fd83969daed401.ico"> 
	<br> 
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/vendor/modernizr.js"></script>
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
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.topbar.js"></script>
    <script>
        $(document).foundation();
    </script>
</html>
