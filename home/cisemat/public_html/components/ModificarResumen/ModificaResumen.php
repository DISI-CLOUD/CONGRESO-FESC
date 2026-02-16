<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == null) {
    print "<script>alert(\"Acceso invalido!\");window.location='../../components/inicioSesion/sesion.php';</script>";
}

require "../../modelo/conexion.php";
require "../../modelo/traerCongresoActual.php";
$id = $_SESSION['id'];
$idPonencia = $_GET['id'];

$consComprobarPonencia = "SELECT id_ponencia FROM ponencia WHERE id_usuario_registra='$id' AND  id_ponencia='$idPonencia' AND id_congreso='$idCongreso';";
//echo "</p> Comprobar ponencia ModificaResumen.php".$consComprobarPonencia."</p>";
$resComprobarPonencia = mysqli_query($conexion, $consComprobarPonencia);


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
    <link rel="stylesheet" href="../../Layouts/ModificarResumen/modificar.css">
    <script language="JavaScript" src="../../librerias/analitics_congreso.js"> </script>


</head>

<body>
    <header>
        <?php
        require_once('../../Layouts/nav.php');
        ?>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-1 d-sm-block background-lateral">
                <?php
                require_once('../../Layouts/sidebar.php');
                ?>

            </div>
            <div class="col-xl-9 col-lg-9 col-md-11 col-sm-12">
                <div class="container">
                    <h2 class="mt-5 mb-3">Modificar Resumen</h2>
                    <?php

                    if (mysqli_num_rows($resComprobarPonencia) > 0) {
                        //echo "</p> 3. Entre en ModificaResumen.php </p>";
                        require_once('../../Layouts/ModificarResumen/modificar.php');
                
                    } else {
                    ?>
                        <!--------------ESTE CONTENEDOR SE MUESTRA CUANDO EL USUARIO NO TIENE PONENCIAS ASIGNADAS--------->
                        <div class=" containerSinR mt-3 mb-5" id="containerSinR">
                            <h3 class="mt-5 display-4">No tienes acceso a esta ponencia.</h3>
                            <p class="mb-3 lead">Lo sentimos, la ponencia que accediste no la puedes editar, bien porque no te pertenece o es una ponencia de un congreso anterior.</p>
                        </div>
                    <?php
                    }

                    ?>
                </div>
            </div><!--col-10-->
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
    <script src="modificaResumen.js"></script>
</body>

</html>
