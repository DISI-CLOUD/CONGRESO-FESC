<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["id"]==null){
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
		require_once('../../Layouts/iconoCongresoLink.php');
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../Layouts/DetalleResumen/detalle.css">
    
</head>
<body>
    <header> 
        <?php 
    		require_once('../../Layouts/nav.php');
    	?>
    </header>

<div class="container-fluid mb-5 pb-5">
    <div class="row pb-2">
        <div class="col-2 background-lateral">
            <?php 
		    require_once('../../Layouts/sidebar.php');
            ?>
        </div>
        <div class="col-10">
            <!--------DETALLES DEL RESUMEN--->
            <?php 
		    require_once('../../Layouts/DetalleResumen/detalleResumen.php');
            
            ?>
        </div>
    </div>
</div>
<footer>
<?php 
	require_once('../../Layouts/footer.php');
	            ?>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c7b1d2a865.js" crossorigin="anonymous"></script>
    </body>
</html>
